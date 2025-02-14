<div>
    <div class="w-full py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{-- Boton para crear usuario --}}
            <div class="flex justify-end p-4">
                <x-primary-btn label="Crear persona" icon="o-plus" spinner wire:click="create()" />
            </div>

            {{-- Tabla de usuarios --}}
            <div class="shadow-xl bg-base-300 sm:rounded-lg">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Perfil</th>
                            <th>Nombre Completo</th>
                            <th>Estado en la Empresa</th>
                            <th>Fecha Agregado al Sistema</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        @foreach ($personas as $persona)
                            <tr>
                                <th>{{ $persona->idPerson }}</th>
                                <td>{{ $persona->users->profile_photo_path ?? 'No' }}</td>
                                <td>{{ $persona->personaldata->firstName . ' ' . $persona->personaldata->lastName }}
                                <td>
                                    @if ($persona->statusTrabajador === 'FALTA ASIGNAR')
                                        <!-- Rojo -->
                                        <span class="font-bold text-red-600">{{ $persona->statusTrabajador }}</span>
                                    @elseif ($persona->statusTrabajador === 'Trabajando')
                                        <!-- Verde -->
                                        <span class="font-bold text-green-600">{{ $persona->statusTrabajador }}</span>
                                    @elseif ($persona->statusTrabajador === 'Trabajando (Cambio de Cargo)')
                                        <!-- Naranja para vacaciones -->
                                        <span class="font-bold text-green-400">{{ $persona->statusTrabajador }}</span>
                                    @elseif ($persona->statusTrabajador === 'Trabajando (Vacaciones)')
                                        <!-- Naranja para vacaciones -->
                                        <span class="font-bold text-orange-600">{{ $persona->statusTrabajador }}</span>
                                    @elseif ($persona->statusTrabajador === 'Extrabajador (Jubilado)')
                                        <!-- Azul para Jubilado -->
                                        <span class="font-bold text-blue-600">{{ $persona->statusTrabajador }}</span>
                                    @elseif ($persona->statusTrabajador === 'Extrabajador (Despedido)')
                                        <!-- Gris para Despedido -->
                                        <span class="font-bold text-gray-600">{{ $persona->statusTrabajador }}</span>
                                    @endif
                                </td>
                                <td>{{ $persona->created_at }}</td>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Crear usuario --}}
    <form>
        <x-dialog-modal wire:model="createModal">
            <x-slot name="title">
                Crear personal
            </x-slot>

            <x-slot name="content">
                hola
            </x-slot>

            <x-slot name="footer">
                <div class="space-x-2">
                    <x-danger-button type="button" wire:click="$set('createModal', false)">
                        Cancelar
                    </x-danger-button>

                    <x-button type="submit" wire:click="create()">
                        Crear
                    </x-button>
                </div>
            </x-slot>
        </x-dialog-modal>
    </form>

    {{-- Ver usuario --}}
    <form>
        <x-dialog-modal wire:model="createModal">
            <x-slot name="title">
                Crear Usuario
            </x-slot>

            <x-slot name="content">
                hola
            </x-slot>

            <x-slot name="footer">
                <div class="space-x-2">
                    <x-danger-button type="button" wire:click="$set('createModal', false)">
                        Cancelar
                    </x-danger-button>

                    <x-button type="submit" wire:click="create()">
                        Crear
                    </x-button>
                </div>
            </x-slot>
        </x-dialog-modal>
    </form>

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
