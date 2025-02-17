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
                    <th>Perfil</th>
                    <th>Nombre Completo</th>
                    <th>Estado en la Empresa</th>
                    <th>Fecha Agregado al Sistema</th>
                    <th>Acciones</th>
                </x-slot>

                <x-slot name="body">
                    @foreach ($personas as $persona)
                        <tr>
                            <th>{{ $persona->idPerson }}</th>
                            <td>{{ $persona->users->profile_photo_path ?? 'No' }}</td>
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

                                <x-mary-button icon="o-trash" wire:click="destroy()" tooltip="Eliminar" spinner
                                    class="btn-sm bg-base-content/10 border-base-content/10 hover:bg-base-content/20" />
                            </td>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>
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

                <div class="grid grid-cols-1 gap-6 mt-4 md:grid-cols-2">
                    <!-- Sección de Datos Personales -->
                    <div class="pr-4 space-y-4 border-r border-base-content/20">
                        <div class="flex items-center space-x-2">
                            <x-mary-icon name="o-identification" class="w-5 h-5 text-primary" />
                            <span class="text-lg font-medium">Datos Personales</span>
                        </div>

                        <x-mary-input wire:model="personCreate.firstName" label="Nombre" right-icon="o-user" inline />
                        <x-mary-input wire:model="personCreate.lastName" label="Apellido" right-icon="o-user" inline />
                        <x-mary-select wire:model="personCreate.nationality" label="Nacionalidad" right-icon="o-flag"
                            :options="$countries" option-value="value" option-label="value" inline />
                        <x-mary-input wire:model="personCreate.cuit" label="CUIT" right-icon="o-identification"
                            inline />
                        <div class="mt-3">
                            <label class="block w-full max-w-xs mt-1 form-control">
                                <select class="w-full select select-bordered" wire:model="personEdit.gender">
                                    <option selected hidden>Selecciona un genero</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </label>
                        </div>
                        <x-mary-input wire:model="personCreate.birthdate" label="Fecha de Nacimiento"
                            right-icon="o-calendar-days" type="date" inline />
                    </div>

                    <!-- Sección de Dirección -->
                    <div class="pl-4 space-y-4">
                        <div class="flex items-center space-x-2">
                            <x-mary-icon name="o-home" class="w-5 h-5 text-primary" />
                            <span class="text-lg font-medium">Dirección</span>
                        </div>

                        <x-mary-input wire:model="personCreate.street" label="Calle" right-icon="o-map-pin" inline />
                        <x-mary-input wire:model="personCreate.neighborhood" label="Barrio" right-icon="o-map-pin"
                            inline />
                        <x-mary-input wire:model="personCreate.house" label="Casa" right-icon="o-map-pin" inline />
                        <x-mary-input wire:model="personCreate.streetBlock" label="Manzana" right-icon="o-map-pin"
                            inline />
                        <x-mary-input wire:model="personCreate.sector" label="Sector" right-icon="o-map-pin" inline />
                        <x-mary-input wire:model="personCreate.number" label="Altura" right-icon="o-map-pin" inline />
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
                <span class="text-xl font-semibold">Perfil de {{ $personShow->firstName }}
                    {{ $personShow->lastName }}</span>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-6">
                <!-- Sección de Foto y Nombre -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 overflow-hidden rounded-full">
                            @if ($personShow->profile_photo_path)
                                <x-mary-avatar :image="$personShow->profile_photo_path" class="object-cover w-full h-full" />
                            @else
                                <div class="flex items-center justify-center w-full h-full bg-gray-200">
                                    <x-mary-icon name="o-user" class="w-8 h-8 text-gray-500" />
                                </div>
                            @endif
                        </div>
                        <div class="space-y-1">
                            <p class="text-lg font-semibold">{{ $personShow->firstName }} {{ $personShow->lastName }}
                            </p>
                            <p class="text-sm text-gray-500">CUIT: {{ $personShow->cuit }}</p>
                        </div>
                    </div>

                    <div>
                        <h1 class="text-lg font-semibold">Estado: </h1>
                        @switch($persona->statusTrabajador)
                            @case('FALTA ASIGNAR')
                                <span class="font-bold text-lg text-red-600">{{ $persona->statusTrabajador }}</span>
                            @break

                            @case('Trabajando')
                                <span class="font-bold text-lg text-green-600">{{ $persona->statusTrabajador }}</span>
                            @break

                            @case('Trabajando (Cambio de Cargo)')
                                <span class="font-bold text-lg text-green-400">{{ $persona->statusTrabajador }}</span>
                            @break

                            @case('Trabajando (Vacaciones)')
                                <span class="font-bold text-lg text-orange-600">{{ $persona->statusTrabajador }}</span>
                            @break

                            @case('Extrabajador (Jubilado)')
                                <span class="font-bold text-lg text-blue-600">{{ $persona->statusTrabajador }}</span>
                            @break

                            @default
                                <span class="font-bold text-lg text-gray-600">{{ $persona->statusTrabajador }}</span>
                        @endswitch
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
                        <x-mary-select wire:model="personEdit.nationality" label="Nacionalidad" right-icon="o-flag"
                            :options="$countries" option-value="value" option-label="value" inline />
                        <x-mary-input wire:model="personEdit.cuit" label="CUIT" right-icon="o-identification"
                            inline />
                        <div class="mt-3">
                            <label class="block w-full max-w-xs mt-1 form-control">
                                <select class="w-full select select-bordered" wire:model="personEdit.gender">
                                    <option selected hidden>Selecciona un genero</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </label>
                        </div>

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
</div>
