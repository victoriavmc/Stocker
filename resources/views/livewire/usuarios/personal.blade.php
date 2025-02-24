<div>
    <div class="w-full py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="flex items-center justify-end gap-2 mb-4">
                <x-mary-input class="px-4 py-2 w-96" label="Buscar..." wire:model.live="search" icon="o-magnifying-glass"
                    clearable inline />

                <x-primary-btn label="Agregar Personal" icon="o-plus" spinner wire:click="create()" />
            </div>

            {{-- Tabla de usuarios --}}
            <x-table>
                <x-slot name="header">
                    <th>#</th>
                    <th class="text-base text-base-content">Perfil</th>
                    <th class="text-base text-base-content">Nombre Completo</th>
                    <th class="text-base text-base-content">Estado en la Empresa</th>
                    <th class="text-base text-base-content">Fecha Agregado al Sistema</th>
                    <th class="text-base text-base-content">Acciones</th>
                </x-slot>

                <x-slot name="body">
                    @if ($personas->count() > 0)
                        @foreach ($personas as $persona)
                            <tr>
                                <th>{{ $persona->idPerson }}</th>
                                @if ($persona->user->profile_photo_path)
                                    <td>
                                        <button id="avatar-button" class="avatar-button">
                                            <img src="{{ asset('storage/' . str_replace('storage/', '', $persona->user->profile_photo_path)) }}"
                                                alt="{{ $persona->user->name }}" class="w-12 h-12 rounded-full">
                                        </button>
                                    </td>

                                    <div id="image-modal" class="fixed inset-0 z-50 hidden">
                                        <div class="absolute inset-0 bg-black bg-opacity-75"></div>
                                        <div class="flex items-center justify-center min-h-screen">
                                            <div class="relative">
                                                <img id="modal-image"
                                                    src="{{ asset('storage/' . str_replace('storage/', '', $persona->user->profile_photo_path)) }}"
                                                    class="max-w-3xl max-h-[80vh]" />
                                                <button data-close-modal class="absolute top-4 right-4 text-white">
                                                    <x-mary-icon name="o-x-mark" class="w-8 h-8" />
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <td><svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" viewBox="0 0 24 24"
                                            fill="currentColor" class="size-8">
                                            <path fill-rule="evenodd"
                                                d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </td>
                                @endif
                                <td>{{ $persona->personaldata->firstName . ' ' . $persona->personaldata->lastName }}
                                <td>
                                    @switch($persona->statusTrabajador)
                                        @case('FALTA ASIGNAR')
                                            <span class="font-bold text-red-600">{{ $persona->statusTrabajador }}</span>
                                        @break

                                        @case('Trabajando')
                                            <span class="font-bold text-green-600">{{ $persona->statusTrabajador }}</span>
                                        @break

                                        @case('Trabajando (Cambio de Cargo)')
                                            <span class="font-bold text-green-400">{{ $persona->statusTrabajador }}</span>
                                        @break

                                        @case('Trabajando (Vacaciones)')
                                            <span class="font-bold text-orange-600">{{ $persona->statusTrabajador }}</span>
                                        @break

                                        @case('Extrabajador (Jubilado)')
                                            <span class="font-bold text-blue-600">{{ $persona->statusTrabajador }}</span>
                                        @break

                                        @default
                                            <span class="font-bold text-gray-600">{{ $persona->statusTrabajador }}</span>
                                    @endswitch
                                </td>
                                <td>{{ $persona->created_at }}</td>
                                <td class="w-48 space-x-1">
                                    <x-mary-button icon="o-eye" wire:click="show({{ $persona->idPerson }})"
                                        tooltip="Ver datos" spinner
                                        class="btn-sm bg-base-content/10 border-base-content/10 hover:bg-base-content/20" />

                                    <x-mary-button icon="o-pencil" wire:click="edit({{ $persona->idPerson }})"
                                        tooltip="Editar" spinner
                                        class="btn-sm bg-base-content/10 border-base-content/10 hover:bg-base-content/20" />

                                    <x-mary-button icon="o-trash" wire:click="destroyModal({{ $persona->idPerson }})"
                                        tooltip="Eliminar" spinner
                                        class="btn-sm bg-base-content/10 border-base-content/10 hover:bg-base-content/20" />
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <span class="text-gray-500">No hay personal registrado</span>
                            </td>
                        </tr>
                    @endif
                </x-slot>
            </x-table>
            <div class="mt-3">
                {{ $personasPaginadas->links() }}
            </div>
        </div>
    </div>

    {{-- Crear usuario --}}
    <x-mary-form wire:submit="store">
        <x-dialog-modal wire:model="personCreate.createModal">
            <x-slot name="title">
                <div class="flex items-center space-x-2">
                    <x-mary-icon name="o-user-plus" class="w-6 h-6 text-primary" />
                    <span class="text-xl font-semibold">Agregar Personal</span>
                </div>
            </x-slot>

            <x-slot name="content">
                <x-mary-errors title="Oops!" description="Porfavor, corrija los errores." icon="o-face-frown" />

                <div class="grid grid-cols-1 mt-4 md:grid-cols-2">
                    <!-- Sección de Datos Personales -->
                    <div class="pr-4 space-y-4 border-r border-base-content/20">
                        <div class="flex items-center space-x-2">
                            <x-mary-icon name="o-identification" class="w-5 h-5 text-primary" />
                            <span class="text-lg font-medium">Datos Personales</span>
                        </div>

                        <x-mary-input wire:model="personCreate.firstName" label="Nombre" right-icon="o-user" inline />

                        <x-mary-input wire:model="personCreate.lastName" label="Apellido" right-icon="o-user" inline />

                        <select wire:model="personCreate.nationality"
                            class="select {{ $errors->has('personCreate.nationality') ? 'select-error' : 'select-primary' }} w-full font-normal h-14 pt-3">
                            <option selected hidden>Seleccione una nacionalidad</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->name }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('personCreate.nationality')
                            <span class="text-red-500 label-text-alt p-1">{{ $message }}</span>
                        @enderror

                        <x-mary-input wire:model="personCreate.cuit" label="CUIT" right-icon="o-identification"
                            inline />

                        <select wire:model="personCreate.gender"
                            class="select {{ $errors->has('personCreate.gender') ? 'select-error' : 'select-primary' }} w-full font-normal h-14 pt-3">
                            <option selected hidden>Seleccione un género</option>
                            @foreach ($genders as $gender)
                                <option value="{{ $gender['value'] }}">{{ $gender['value'] }}</option>
                            @endforeach
                        </select>
                        @error('personCreate.gender')
                            <span class="text-red-500 label-text-alt p-1">{{ $message }}</span>
                        @enderror

                        <x-mary-input wire:model="personCreate.birthdate" label="Fecha de Nacimiento"
                            right-icon="o-calendar-days" type="date" inline />
                    </div>

                    <!-- Sección de Dirección -->
                    <div class="pl-4 space-y-4">
                        <div class="flex items-center space-x-2">
                            <x-mary-icon name="o-home" class="w-5 h-5 text-primary" />
                            <span class="text-lg font-medium">Dirección</span>
                        </div>

                        <x-mary-input wire:model="personCreate.street" label="Calle" right-icon="o-map-pin"
                            inline />

                        <x-mary-input wire:model="personCreate.neighborhood" label="Barrio" right-icon="o-map-pin"
                            inline />

                        <x-mary-input wire:model="personCreate.house" label="Casa" right-icon="o-map-pin" inline />

                        <x-mary-input wire:model="personCreate.streetBlock" label="Manzana" right-icon="o-map-pin"
                            inline />

                        <x-mary-input wire:model="personCreate.sector" label="Sector" right-icon="o-map-pin"
                            inline />

                        <x-mary-input wire:model="personCreate.number" label="Altura" right-icon="o-map-pin"
                            inline />
                    </div>
                </div>

                <!-- Sección de Datos de Usuario -->
                <div class="pt-6 mt-6 border-t border-base-content/20 space-y-4">
                    <div class="flex items-center space-x-2">
                        <x-mary-icon name="o-at-symbol" class="w-5 h-5 text-primary" />
                        <span class="text-lg font-medium">Datos de Usuario</span>
                    </div>

                    <x-mary-input wire:model="personCreate.name" label="Usuario" right-icon="o-user" inline />

                    <x-mary-input wire:model="personCreate.email" label="Email" right-icon="o-envelope" inline />

                    <x-mary-password wire:model="personCreate.password" label="Contraseña" right-icon="o-lock-closed"
                        inline />
                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="flex justify-end space-x-2">
                    <x-danger-button type="button" wire:click="$set('personCreate.createModal', false)"
                        class="flex items-center space-x-2">
                        <x-mary-icon name="o-x-mark" class="w-5 h-5" />
                        <span>Cancelar</span>
                    </x-danger-button>

                    <x-button type="submit" class="flex items-center space-x-2">
                        <x-mary-icon name="o-check" class="w-5 h-5" />
                        <span>Crear</span>
                    </x-button>
                </div>
            </x-slot>
        </x-dialog-modal>
    </x-mary-form>

    {{-- Ver usuario --}}
    <x-dialog-modal wire:model="personShow.showModal">
        <x-slot name="title">
            <div class="flex items-center space-x-2">
                <x-mary-icon name="o-user" class="w-6 h-6 text-primary" />
                <span class="text-xl font-semibold">
                    Perfil de {{ $personShow->firstName }} {{ $personShow->lastName }}
                </span>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-6">
                <!-- Sección de Foto y Nombre -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 overflow-hidden rounded-full">
                            @if ($personShow->profile_photo_path)
                                <img src="{{ asset('storage/' . str_replace('storage/', '', $personShow->profile_photo_path)) }}"
                                    alt="{{ $personShow->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center w-full h-full bg-gray-200">
                                    <x-mary-icon name="o-user" class="w-8 h-8 text-gray-500" />
                                </div>
                            @endif
                        </div>
                        <div class="space-y-1">
                            <p class="text-lg font-semibold">{{ $personShow->firstName }}
                                {{ $personShow->lastName }}
                            </p>
                            <p class="text-sm text-gray-500">CUIT: {{ $personShow->cuit }}</p>
                        </div>
                    </div>

                    <div>
                        <h1 class="text-lg font-semibold">Estado: </h1>
                        @if (isset($personShow->statusTrabajador))
                            @switch($personShow->statusTrabajador)
                                @case('FALTA ASIGNAR')
                                    <span class="font-bold text-lg text-red-600">{{ $personShow->statusTrabajador }}</span>
                                @break

                                @case('Trabajando')
                                    <span class="font-bold text-lg text-green-600">{{ $personShow->statusTrabajador }}</span>
                                @break

                                @case('Trabajando (Cambio de Cargo)')
                                    <span class="font-bold text-lg text-green-400">{{ $personShow->statusTrabajador }}</span>
                                @break

                                @case('Trabajando (Vacaciones)')
                                    <span class="font-bold text-lg text-orange-600">{{ $personShow->statusTrabajador }}</span>
                                @break

                                @case('Extrabajador (Jubilado)')
                                    <span class="font-bold text-lg text-blue-600">{{ $personShow->statusTrabajador }}</span>
                                @break

                                @default
                                    <span class="font-bold text-lg text-gray-600">{{ $personShow->statusTrabajador }}</span>
                            @endswitch
                        @endif
                    </div>

                </div>

                <!-- Sección de Datos Personales -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-2">
                        <x-mary-icon name="o-identification" class="w-5 h-5 text-primary" />
                        <span class="font-semibold text-lg">Datos Personales</span>
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <x-mary-input disabled style="cursor: default" icon="o-calendar-days"
                            label="Fecha de Nacimiento" :value="$personShow->birthdate" />
                        <x-mary-input disabled style="cursor: default" icon="o-user" label="Género"
                            :value="$personShow->gender" />
                        <x-mary-input disabled style="cursor: default" icon="o-flag" label="Nacionalidad"
                            :value="$personShow->nationality" />
                    </div>
                </div>

                <!-- Sección de Usuario y Email -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-2">
                        <x-mary-icon name="o-at-symbol" class="w-5 h-5 text-primary" />
                        <span class="font-semibold text-lg">Información de Usuario</span>
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <x-mary-input disabled style="cursor: default" icon="o-user" label="Usuario"
                            :value="$personShow->name" />
                        <x-mary-input disabled style="cursor: default" icon="o-at-symbol" label="Email"
                            :value="$personShow->email" />
                    </div>
                </div>

                <!-- Sección de Domicilio -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-2">
                        <x-mary-icon name="o-home" class="w-5 h-5 text-primary" />
                        <span class="font-semibold text-lg">Domicilio</span>
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <x-mary-input disabled style="cursor: default" label="Calle" :value="$personShow->street" />
                        <x-mary-input disabled style="cursor: default" label="Barrio" :value="$personShow->neighborhood" />
                        <x-mary-input disabled style="cursor: default" label="Casa" :value="$personShow->house" />
                        <x-mary-input disabled style="cursor: default" label="Manzana" :value="$personShow->streetBlock" />
                        <x-mary-input disabled style="cursor: default" label="Sector" :value="$personShow->sector" />
                        <x-mary-input disabled style="cursor: default" label="Altura" :value="$personShow->number" />
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end space-x-2">
                <x-danger-button type="button" wire:click="$set('personShow.showModal', false)"
                    class="flex items-center space-x-2">
                    <x-mary-icon name="o-x-mark" class="w-5 h-5" />
                    <span>Cerrar</span>
                </x-danger-button>
            </div>
        </x-slot>
    </x-dialog-modal>

    {{-- Editar usuario --}}
    <x-mary-form wire:submit="update">
        <x-dialog-modal wire:model="personEdit.editModal">
            <x-slot name="title">
                <div class="flex items-center space-x-2">
                    <x-mary-icon name="o-pencil" class="w-6 h-6 text-primary" />
                    <span class="text-xl font-semibold">Editar Persona</span>
                </div>
            </x-slot>

            <x-slot name="content">
                <x-mary-errors title="Oops!" description="Porfavor, corrija los errores." icon="o-face-frown" />

                <div class="grid grid-cols-1 gap-6 mt-4 md:grid-cols-2">
                    <!-- Sección de Datos Personales -->
                    <div class="pr-4 space-y-4 border-r border-base-content/20">
                        <div class="flex items-center space-x-2">
                            <x-mary-icon name="o-identification" class="w-5 h-5 text-primary" />
                            <span class="text-lg font-medium ">Datos Personales</span>
                        </div>

                        <x-mary-input wire:model="personEdit.firstName" label="Nombre" right-icon="o-user" inline />

                        <x-mary-input wire:model="personEdit.lastName" label="Apellido" right-icon="o-user" inline />

                        <select wire:model="personEdit.nationality"
                            class="select select-primary w-full font-normal h-14 pt-3">
                            <option selected hidden>Seleccione una nacionalidad</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->name }}">{{ $country->name }}</option>
                            @endforeach
                        </select>

                        <x-mary-input wire:model="personEdit.cuit" label="CUIT" right-icon="o-identification"
                            inline />

                        <x-mary-select wire:model="personCreate.gender" label="Genero" right-icon="o-user"
                            :options="$genders" option-value="value" option-label="value" inline />

                        <x-mary-input wire:model="personEdit.birthdate" label="Fecha de Nacimiento"
                            right-icon="o-calendar-days" type="date" inline />
                    </div>

                    <!-- Sección de Dirección -->
                    <div class="pl-4 space-y-4">
                        <div class="flex items-center space-x-2">
                            <x-mary-icon name="o-home" class="w-5 h-5 text-primary" />
                            <span class="text-lg font-medium">Dirección</span>
                        </div>

                        <x-mary-input wire:model="personEdit.street" label="Calle" right-icon="o-map-pin" inline />
                        <x-mary-input wire:model="personEdit.neighborhood" label="Barrio" right-icon="o-map-pin"
                            inline />
                        <x-mary-input wire:model="personEdit.house" label="Casa" right-icon="o-map-pin" inline />
                        <x-mary-input wire:model="personEdit.streetBlock" label="Manzana" right-icon="o-map-pin"
                            inline />
                        <x-mary-input wire:model="personEdit.sector" label="Sector" right-icon="o-map-pin" inline />
                        <x-mary-input wire:model="personEdit.number" label="Número" right-icon="o-map-pin" inline />
                    </div>
                </div>

                <!-- Sección de Datos de Usuario -->
                <div class="pt-6 mt-6 border-t border-base-content/20 space-y-4">
                    <div class="flex items-center space-x-2">
                        <x-mary-icon name="o-at-symbol" class="w-5 h-5 text-primary" />
                        <span class="text-lg font-medium">Datos de Usuario</span>
                    </div>

                    @if ($personEdit->profile_photo_path)
                        <div class="flex justify-center relative">
                            <div class="relative">
                                <div class="absolute flex w-full justify-end">
                                    <button type="button" wire:click="deleteImage"
                                        class="normal-case rounded-md transition-all duration-300 !inline-flex lg:tooltip lg:tooltip-top bg-red-600 hover:bg-red-500 p-2"
                                        data-tip="Eliminar imagen">
                                        <svg class="inline w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            aria-hidden="true" data-slot="icon">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                                <img src="{{ asset('storage/' . str_replace('storage/', '', $personEdit->profile_photo_path)) }}"
                                    alt="{{ $personEdit->name }}" class="w-28 h-28 rounded-full">
                            </div>
                        </div>
                    @endif
                    <x-mary-input wire:model="personEdit.name" label="Usuario" right-icon="o-user" inline />
                    <x-mary-input wire:model="personEdit.email" label="Email" right-icon="o-envelope" inline />
                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="flex justify-end space-x-2">
                    <x-danger-button type="button" wire:click="$set('personEdit.editModal', false)"
                        class="flex items-center space-x-2">
                        <x-mary-icon name="o-x-mark" class="w-5 h-5" />
                        <span>Cancelar</span>
                    </x-danger-button>
                    <x-button type="submit" class="flex items-center space-x-2">
                        <x-mary-icon name="o-check" class="w-5 h-5" />
                        <span>Guardar Cambios</span>
                    </x-button>
                </div>
            </x-slot>
        </x-dialog-modal>
    </x-mary-form>

    {{-- Eliminar usuario --}}
    <x-dialog-modal wire:model="deleteModal">
        <x-slot name="title">
            <div class="flex items-center space-x-2">
                <x-mary-icon name="o-trash" class="w-6 h-6 text-primary" />
                <span class="text-xl font-semibold">Eliminar Persona</span>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex items-center flex-col justify-center">
                <x-mary-icon name="o-exclamation-triangle" class="w-16 h-16 text-warning" />
                <p class="mt-4 text-lg">Esta acción no se puede deshacer.</p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-end space-x-2">
                <x-danger-button type="button" wire:click="$set('deleteModal', false)"
                    class="flex items-center space-x-2">
                    <x-mary-icon name="o-x-mark" class="w-5 h-5" />
                    <span>Cancelar</span>
                </x-danger-button>
                <x-button type="button" wire:click="destroy" class="flex items-center space-x-2">
                    <x-mary-icon name="o-check" class="w-5 h-5" />
                    <span>Eliminar</span>
                </x-button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
