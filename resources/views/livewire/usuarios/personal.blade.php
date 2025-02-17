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
                Agregar Personal
            </x-slot>

            <x-slot name="content">
                <x-mary-errors title="Oops!" description="Porfavor, corrija los errores." icon="o-face-frown" />

                <div class="grid grid-cols-2 mt-2">
                    <div class="pr-4 border-r-2 border-base-content/20">
                        <x-mary-header title="Datos Personales" class="mb-5" size="text-xl" separator />

                        <div>
                            <x-mary-input wire:model="personCreate.firstName" inline label="Nombre"
                                class="block w-full mt-1" type="text" :value="old('personCreate.firstName')" />
                        </div>

                        <div class="mt-3">
                            <x-mary-input wire:model="personCreate.lastName" inline label="Apellido"
                                class="block w-full mt-1" type="text" :value="old('personCreate.lastName')" />
                        </div>

                        <div class="mt-3">
                            <x-mary-select label="Nacionalidad" icon="o-flag" :options="$countries"
                                wire:model="personCreate.nationality" option-value="value" option-label="value"
                                inline />
                        </div>

                        <div class="mt-3">
                            <x-mary-input wire:model="personCreate.cuit" inline label="Cuit" class="block w-full mt-1"
                                type="text" :value="old('personCreate.cuit')" />
                        </div>

                        <div class="mt-3">
                            <label class="block w-full max-w-xs mt-1 form-control">
                                <select class="w-full select select-bordered" wire:model="personCreate.gender">
                                    <option selected hidden>Selecciona un genero</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </label>
                        </div>

                        <div class="mt-3">
                            <x-mary-input wire:model="personCreate.birthdate" inline label="Fecha de Nacimiento"
                                class="block w-full mt-1" type="date" :value="old('personCreate.birthdate')" />
                        </div>
                    </div>

                    <div class="pl-4">
                        <x-mary-header title="Direccion" class="mb-5" size="text-xl" separator />

                        <div>
                            <x-mary-input icon="o-map-pin" wire:model="personCreate.street" inline label="Calle"
                                class="block w-full mt-1" type="text" :value="old('personCreate.street')" />
                        </div>

                        <div class="mt-3">
                            <x-mary-input icon="o-map-pin" wire:model="personCreate.neighborhood" inline label="Barrio"
                                class="block w-full mt-1" type="text" :value="old('personCreate.neighborhood')" />
                        </div>

                        <div class="mt-3">
                            <x-mary-input icon="o-map-pin" wire:model="personCreate.house" inline label="Casa"
                                class="block w-full mt-1" type="text" :value="old('personCreate.house')" />
                        </div>

                        <div class="mt-3">
                            <x-mary-input icon="o-map-pin" wire:model="personCreate.streetBlock" inline label="Manzana"
                                class="block w-full mt-1" type="text" :value="old('personCreate.streetBlock')" />
                        </div>

                        <div class="mt-3">
                            <x-mary-input icon="o-map-pin" wire:model="personCreate.sector" inline label="Sector"
                                class="block w-full mt-1" type="text" :value="old('personCreate.sector')" />
                        </div>

                        <div class="mt-3">
                            <x-mary-input icon="o-map-pin" wire:model="personCreate.number" inline label="Altura"
                                class="block w-full mt-1" type="text" :value="old('personCreate.number')" />
                        </div>
                    </div>
                </div>

                <div class="pt-4 mt-4 border-t-2 border-base-content/20">
                    <x-mary-header title="Datos de usuario" class="mb-5" size="text-xl" separator />

                    <div>
                        <x-mary-input wire:model="personCreate.name" inline label="Usuario" icon="o-user"
                            class="block w-full mt-1" type="text" />
                    </div>

                    <div class="mt-3">
                        <x-mary-input wire:model="personCreate.email" inline label="Email" icon="o-envelope"
                            class="block w-full mt-1" type="email" :value="old('email')" />
                    </div>

                    <div class="mt-3">
                        <x-mary-password wire:model="personCreate.password" inline label="Contraseña"
                            class="block w-full mt-1" type="password" password-icon="o-lock-closed"
                            password-visible-icon="o-lock-open" />
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="space-x-2">
                    <x-danger-button type="button" wire:click="$set('personCreate.createModal', false)">
                        Cancelar
                    </x-danger-button>

                    <x-button type="submit">
                        Crear
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
                    <div>
                        <p class="text-lg font-semibold">{{ $personShow->firstName }} {{ $personShow->lastName }}</p>
                        <p class="text-sm text-gray-500">CUIT: {{ $personShow->cuit }}</p>
                    </div>
                </div>

                <!-- Sección de Datos Personales -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-2">
                        <x-mary-icon name="o-identification" class="w-5 h-5 text-primary" />
                        <span class="font-medium">Datos Personales</span>
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <x-mary-input readonly icon="o-calendar-days" label="Fecha de Nacimiento"
                            :value="$personShow->birthdate" />
                        <x-mary-input readonly icon="o-user" label="Género" :value="$personShow->gender" />
                        <x-mary-input readonly icon="o-flag" label="Nacionalidad" :value="$personShow->nationality" />
                    </div>
                </div>

                <!-- Sección de Usuario y Email -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-2">
                        <x-mary-icon name="o-at-symbol" class="w-5 h-5 text-primary" />
                        <span class="font-medium">Información de Usuario</span>
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <x-mary-input readonly icon="o-user" label="Usuario" :value="$personShow->name" />
                        <x-mary-input readonly icon="o-at-symbol" label="Email" :value="$personShow->email" />
                    </div>
                </div>

                <!-- Sección de Domicilio -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-2">
                        <x-mary-icon name="o-home" class="w-5 h-5 text-primary" />
                        <span class="font-medium">Domicilio</span>
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <x-mary-input readonly label="Calle" :value="$personShow->street" />
                        <x-mary-input readonly label="Barrio" :value="$personShow->neighborhood" />
                        <x-mary-input readonly label="Casa" :value="$personShow->house" />
                        <x-mary-input readonly label="Manzana" :value="$personShow->streetBlock" />
                        <x-mary-input readonly label="Sector" :value="$personShow->sector" />
                        <x-mary-input readonly label="Altura" :value="$personShow->number" />
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
                Editar Persona
            </x-slot>

            <x-slot name="content">
                <x-mary-errors title="Oops!" description="Porfavor, corrija los errores." icon="o-face-frown" />

                <div class="grid grid-cols-2 mt-2">
                    <div class="pr-4 border-r-2 border-base-content/20">
                        <x-mary-header title="Datos Personales" class="mb-5" size="text-xl" separator />

                        <div>
                            <x-mary-input wire:model="personEdit.firstName" inline label="Nombre"
                                class="block w-full mt-1" type="text" :value="old('personEdit.firstName')" />
                        </div>

                        <div class="mt-3">
                            <x-mary-input wire:model="personEdit.lastName" inline label="Apellido"
                                class="block w-full mt-1" type="text" :value="old('personEdit.lastName')" />
                        </div>

                        <div class="mt-3">
                            <x-mary-select label="Nacionalidad" icon="o-flag" :options="$countries"
                                wire:model="personEdit.nationality" option-value="value" option-label="value"
                                inline />
                        </div>

                        <div class="mt-3">
                            <x-mary-input wire:model="personEdit.cuit" inline label="Cuit"
                                class="block w-full mt-1" type="text" :value="old('personEdit.cuit')" />
                        </div>

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

                        <div class="mt-3">
                            <x-mary-input wire:model="personEdit.birthdate" inline label="Fecha de Nacimiento"
                                class="block w-full mt-1" type="date" :value="old('personEdit.birthdate')" />
                        </div>
                    </div>

                    <div class="pl-4">
                        <x-mary-header title="Direccion" class="mb-5" size="text-xl" separator />

                        <div>
                            <x-mary-input icon="o-map-pin" wire:model="personEdit.street" inline label="Calle"
                                class="block w-full mt-1" type="text" :value="old('personEdit.street')" />
                        </div>

                        <div class="mt-3">
                            <x-mary-input icon="o-map-pin" wire:model="personEdit.neighborhood" inline label="Barrio"
                                class="block w-full mt-1" type="text" :value="old('personEdit.neighborhood')" />
                        </div>

                        <div class="mt-3">
                            <x-mary-input icon="o-map-pin" wire:model="personEdit.house" inline label="Casa"
                                class="block w-full mt-1" type="text" :value="old('personEdit.house')" />
                        </div>

                        <div class="mt-3">
                            <x-mary-input icon="o-map-pin" wire:model="personEdit.streetBlock" inline label="Manzana"
                                class="block w-full mt-1" type="text" :value="old('personEdit.streetBlock')" />
                        </div>

                        <div class="mt-3">
                            <x-mary-input icon="o-map-pin" wire:model="personEdit.sector" inline label="Sector"
                                class="block w-full mt-1" type="text" :value="old('personEdit.sector')" />
                        </div>

                        <div class="mt-3">
                            <x-mary-input icon="o-map-pin" wire:model="personEdit.number" inline label="Numero"
                                class="block w-full mt-1" type="text" :value="old('personEdit.number')" />
                        </div>
                    </div>
                </div>

                <div class="pt-4 mt-4 border-t-2 border-base-content/20">
                    <x-mary-header title="Datos de usuario" class="mb-5" size="text-xl" separator />

                    <div>
                        <x-mary-input wire:model="personEdit.name" inline label="Usuario" icon="o-user"
                            class="block w-full mt-1" type="text" />
                    </div>

                    <div class="mt-3">
                        <x-mary-input wire:model="personEdit.email" inline label="Email" icon="o-envelope"
                            class="block w-full mt-1" type="email" :value="old('personEdit.email')" />
                    </div>

                    <div class="mt-3">
                        <x-mary-password wire:model="personEdit.password" inline label="Contraseña"
                            class="block w-full mt-1" type="password" password-icon="o-lock-closed"
                            password-visible-icon="o-lock-open" />
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="space-x-2">
                    <x-danger-button type="button" wire:click="$set('personEdit.editModal', false)">
                        Cancelar
                    </x-danger-button>

                    <x-button type="submit">
                        Editar
                    </x-button>
                </div>
            </x-slot>
        </x-dialog-modal>
    </x-mary-form>
</div>
