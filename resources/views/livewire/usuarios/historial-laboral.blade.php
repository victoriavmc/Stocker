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
                    @if ($employees->count() > 0)
                        @foreach ($employees as $employee)
                            <tr>
                                <th>{{ $employee->idJobPosition }}</th>
                                @if ($employee->person->users->profile_photo_path)
                                    <td>
                                        <button id="avatar-button" onclick="openImageModal()">
                                            <img src="{{ asset('storage/' . str_replace('storage/', '', $employee->person->users->profile_photo_path)) }}"
                                                alt="{{ $employee->person->users->name }}"
                                                class="w-12 h-12 rounded-full">
                                        </button>
                                    </td>

                                    <div id="image-modal" class="fixed inset-0 z-50 hidden">
                                        <div class="absolute inset-0 bg-black bg-opacity-75"></div>
                                        <div class="flex items-center justify-center min-h-screen">
                                            <div class="relative">
                                                <img id="modal-image"
                                                    src="{{ asset('storage/' . str_replace('storage/', '', $employee->person->users->profile_photo_path)) }}"
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
                                <td>{{ $employee->person->personaldata->firstName . ' ' . $employee->person->personaldata->lastName }}
                                </td>
                                <td>{{ $employee->position }}</td>
                                <td>{{ $employee->startDate }}</td>
                                <td>{{ $employee->endDate }}</td>
                                <td>{{ $employee->status }}</td>
                                <td>{{ $employee->observation ?? 'No Presenta' }}</td>
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
    <x-mary-form>
        <x-dialog-modal wire:model="employeeCreate.createModal">
            <x-slot name="title">
                Crear Trabajador
            </x-slot>

            <x-slot name="content">
                <x-mary-errors title="Oops!" description="Porfavor, corrija los errores." icon="o-face-frown" />
                <div class="space-y-4">
                    <div class="flex items-center space-x-2">
                        <x-mary-icon name="o-wrench-screwdriver" class="w-5 h-5 text-primary" />
                        <span class="text-lg font-medium">Datos del trabajador</span>
                    </div>

                    <x-mary-input wire:model="employeeCreate.startDate" label="Fecha de inicio" icon="o-calendar-days"
                        type="date" inline />

                    <x-mary-input wire:model="employeeCreate.position" label="Posicion" icon="o-wrench" inline />

                    <x-mary-select />

                    <x-mary-input wire:model="employeeCreate.status" label="Estado" icon="o-wrench" inline />

                    <x-mary-textarea label="Observacion" wire:model="employeeCreate.observation"
                        placeholder="Tu observacion ..." hint="Maximo 1000 caracteres" rows="5" icon="o-wrench"
                        inline />

                    <select icon="o-user" wire:model="employeeCreate.idPerson"
                        class="select {{ $errors->has('employeeCreate.idPerson') ? 'select-error' : 'select-primary' }} w-full font-normal h-14 pt-3">
                        <option selected hidden>Seleccione a la persona</option>
                        @foreach ($persons as $person)
                            <option value="{{ $person->idPerson }}">
                                {{ $person->personaldata->firstName . ' ' . $person->personaldata->lastName }}</option>
                        @endforeach
                    </select>
                    @error('employeeCreate.idPerson')
                        <span class="text-red-500 label-text-alt p-1">{{ $message }}</span>
                    @enderror
                </div>
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
    </x-mary-form>

    {{-- Ver trabajador --}}
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
                            @if ($employeeShow->profile_photo_path)
                                <img src="{{ asset('storage/' . str_replace('storage/', '', $employeeShow->profile_photo_path)) }}"
                                    alt="{{ $employeeShow->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center w-full h-full bg-gray-200">
                                    <x-mary-icon name="o-user" class="w-8 h-8 text-gray-500" />
                                </div>
                            @endif
                        </div>
                        <div class="space-y-1">
                            <p class="text-lg font-semibold">
                                {{ $employeeShow->firstName }}
                                {{ $employeeShow->lastName }}
                            </p>
                            <p class="text-sm text-gray-500">CUIT:
                                {{ $employeeShow->cuit }}
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
                            label="Fecha de Nacimiento" :value="$employeeShow->birthdate" />
                        <x-mary-input disabled style="cursor: default" icon="o-user" label="Género"
                            :value="$employeeShow->gender" />
                        <x-mary-input disabled style="cursor: default" icon="o-flag" label="Nacionalidad"
                            :value="$employeeShow->nationality" />
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
                            :value="$employeeShow->name" />
                        <x-mary-input disabled style="cursor: default" icon="o-at-symbol" label="Email"
                            :value="$employeeShow->email" />
                    </div>
                </div>

                <!-- Sección de Domicilio -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-2">
                        <x-mary-icon name="o-home" class="w-5 h-5 text-primary" />
                        <span class="font-semibold text-lg">Domicilio</span>
                    </div>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <x-mary-input disabled style="cursor: default" label="Calle" :value="$employeeShow->street" />
                        <x-mary-input disabled style="cursor: default" label="Barrio" :value="$employeeShow->neighborhood" />
                        <x-mary-input disabled style="cursor: default" label="Casa" :value="$employeeShow->house" />
                        <x-mary-input disabled style="cursor: default" label="Manzana" :value="$employeeShow->streetBlock" />
                        <x-mary-input disabled style="cursor: default" label="Sector" :value="$employeeShow->sector" />
                        <x-mary-input disabled style="cursor: default" label="Altura" :value="$employeeShow->number" />
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

    {{-- Editar trabajador --}}
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
