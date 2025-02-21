<div>
    <div class="w-full py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="flex items-center justify-end gap-2 mb-4">
                <x-mary-input class="px-4 py-2 w-96" label="Buscar..." wire:model.live="search" icon="o-magnifying-glass"
                    clearable inline />

                <x-primary-btn label="Agregar Trabajador" icon="o-plus" spinner wire:click="create()" />
            </div>

            {{-- Tabla de usuarios --}}
            <x-table>
                <x-slot name="header">
                    <th>#</th>
                    <th>Perfil</th>
                    <th>Nombre</th>
                    <th>Posicion</th>
                    <th>Fecha de ingreso</th>
                    <th>Fecha de salida</th>
                    <th>Estado</th>
                    <th>Observacion</th>
                    <th>Acciones</th>
                </x-slot>

                <x-slot name="body">
                    @if ($trabajadores->count() > 0)
                        @foreach ($trabajadores as $trabajador)
                            <tr>
                                <th>{{ $trabajador->idJobPosition }}</th>
                                @if ($trabajador->person->users->profile_photo_path)
                                    <td>
                                        <button id="avatar-button" onclick="openImageModal()">
                                            <img src="{{ asset('storage/' . str_replace('storage/', '', $trabajador->person->users->profile_photo_path)) }}"
                                                alt="{{ $trabajador->person->users->name }}"
                                                class="w-12 h-12 rounded-full">
                                        </button>
                                    </td>

                                    <div id="image-modal" class="fixed inset-0 z-50 hidden">
                                        <div class="absolute inset-0 bg-black bg-opacity-75"></div>
                                        <div class="flex items-center justify-center min-h-screen">
                                            <div class="relative">
                                                <img id="modal-image"
                                                    src="{{ asset('storage/' . str_replace('storage/', '', $trabajador->person->users->profile_photo_path)) }}"
                                                    class="max-w-3xl max-h-[80vh]" />
                                                <button onclick="closeImageModal()"
                                                    class="absolute top-4 right-4 text-white">
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
                                <td>{{ $trabajador->person->personaldata->firstName . ' ' . $trabajador->person->personaldata->lastName }}
                                </td>
                                <td>{{ $trabajador->position }}</td>
                                <td>{{ $trabajador->startDate }}</td>
                                <td>{{ $trabajador->endDate }}</td>
                                <td>{{ $trabajador->status }}</td>
                                <td>{{ $trabajador->observation ?? 'No Presenta' }}</td>
                                <td class="w-48">
                                    <x-mary-button icon="o-eye" wire:click="show()" tooltip="Ver datos" spinner
                                        class="btn-sm bg-base-content/10 border-base-content/10 hover:bg-base-content/20" />

                                    <x-mary-button icon="o-pencil" wire:click="edit()" tooltip="Editar" spinner
                                        class="btn-sm bg-base-content/10 border-base-content/10 hover:bg-base-content/20" />

                                    <x-mary-button icon="o-trash" wire:click="destroy()" tooltip="Eliminar" spinner
                                        class="btn-sm bg-base-content/10 border-base-content/10 hover:bg-base-content/20" />
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center">No hay trabajadores</td>
                        </tr>
                    @endif
                </x-slot>
            </x-table>
        </div>
    </div>

    {{-- Crear Trabajador --}}
    <form>
        <x-dialog-modal wire:model="employeeCreate.createModal">
            <x-slot name="title">
                Crear Trabajador
            </x-slot>

            <x-slot name="content">
                hola
            </x-slot>

            <x-slot name="footer">
                <div class="flex justify-end space-x-2">
                    <x-danger-button type="button" wire:click="$set('employeeCreate.createModal', false)"
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
    </form>

    {{-- Ver usuario --}}
    {{-- <form>
        <x-dialog-modal wire:model="employeeShow.showModal">
            <x-slot name="title">
                Ver Trabajador
            </x-slot>

            <x-slot name="content">
                <div class="space-y-6">
                    <!-- Sección de Foto y Nombre -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 overflow-hidden rounded-full">
                                @if ($employeeShow->person->user->profile_photo_path)
                                    <img src="{{ asset('storage/' . str_replace('storage/', '', $employeeShow->person->user->profile_photo_path)) }}"
                                        alt="{{ $employeeShow->person->user->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center w-full h-full bg-gray-200">
                                        <x-mary-icon name="o-user" class="w-8 h-8 text-gray-500" />
                                    </div>
                                @endif
                            </div>
                            <div class="space-y-1">
                                <p class="text-lg font-semibold">
                                    {{ $employeeShow->person->personaldata->firstName }}
                                    {{ $employeeShow->person->personaldata->lastName }}
                                </p>
                                <p class="text-sm text-gray-500">CUIT:
                                    {{ $employeeShow->person->personaldata->cuit }}
                                </p>
                            </div>
                        </div>

                        <div>
                            <h1 class="text-lg font-semibold">Estado: </h1>
                            @switch($employeeShow->status)
                                @case('FALTA ASIGNAR')
                                    <span class="font-bold text-lg text-red-600">{{ $employeeShow->status }}</span>
                                @break

                                @case('Trabajando')
                                    <span class="font-bold text-lg text-green-600">{{ $employeeShow->status }}</span>
                                @break

                                @case('Trabajando (Cambio de Cargo)')
                                    <span class="font-bold text-lg text-green-400">{{ $employeeShow->status }}</span>
                                @break

                                @case('Trabajando (Vacaciones)')
                                    <span class="font-bold text-lg text-orange-600">{{ $employeeShow->status }}</span>
                                @break

                                @case('Extrabajador (Jubilado)')
                                    <span class="font-bold text-lg text-blue-600">{{ $employeeShow->status }}</span>
                                @break

                                @default
                                    <span class="font-bold text-lg text-gray-600">{{ $employeeShow->status }}</span>
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
                                label="Fecha de Nacimiento" :value="$employeeShow->person->personaldata->birthdate" />
                            <x-mary-input disabled style="cursor: default" icon="o-user" label="Género"
                                :value="$employeeShow->person->personaldata->gender" />
                            <x-mary-input disabled style="cursor: default" icon="o-flag" label="Nacionalidad"
                                :value="$employeeShow->person->personaldata->nationality" />
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
                                :value="$employeeShow->person->users->name" />
                            <x-mary-input disabled style="cursor: default" icon="o-at-symbol" label="Email"
                                :value="$employeeShow->person->users->email" />
                        </div>
                    </div>

                    <!-- Sección de Domicilio -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-2">
                            <x-mary-icon name="o-home" class="w-5 h-5 text-primary" />
                            <span class="font-semibold text-lg">Domicilio</span>
                        </div>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <x-mary-input disabled style="cursor: default" label="Calle" :value="$employeeShow->person->personaldata->street" />
                            <x-mary-input disabled style="cursor: default" label="Barrio" :value="$employeeShow->person->personaldata->neighborhood" />
                            <x-mary-input disabled style="cursor: default" label="Casa" :value="$employeeShow->person->personaldata->house" />
                            <x-mary-input disabled style="cursor: default" label="Manzana" :value="$employeeShow->person->personaldata->streetBlock" />
                            <x-mary-input disabled style="cursor: default" label="Sector" :value="$employeeShow->person->personaldata->sector" />
                            <x-mary-input disabled style="cursor: default" label="Altura" :value="$employeeShow->person->personaldata->number" />
                        </div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="flex justify-end space-x-2">
                    <x-danger-button type="button" wire:click="$set('employeeShow.showModal', false)"
                        class="flex items-center space-x-2">
                        <x-mary-icon name="o-x-mark" class="w-5 h-5" />
                        <span>Cerrar</span>
                    </x-danger-button>
                </div>
            </x-slot>
        </x-dialog-modal>
    </form> --}}

    {{-- Editar usuario --}}
    <form>
        <x-dialog-modal wire:model="editModal">
            <x-slot name="title">
                Editar Usuario
            </x-slot>

            <x-slot name="content">
                hola
            </x-slot>

            <x-slot name="footer">
                <div class="space-x-2">
                    <x-danger-button type="button" wire:click="$set('editModal', false)">
                        Cancelar
                    </x-danger-button>

                    <x-button type="submit" wire:click="update()">
                        Crear
                    </x-button>
                </div>
            </x-slot>
        </x-dialog-modal>
    </form>
</div>
