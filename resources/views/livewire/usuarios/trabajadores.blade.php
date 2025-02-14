<div>
    <div class="py-12 w-full">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Boton para crear usuario --}}
            <div class="flex justify-end p-4">
                <x-primary-btn label="Crear persona" icon="o-plus" spinner wire:click="create()" />
            </div>

            {{-- Tabla de usuarios --}}
            <div class="bg-base-300 shadow-xl sm:rounded-lg">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th></th>
                            <th>Perfil</th>
                            <th>Nombre</th>
                            <th>Posicion</th>
                            <th>Fecha de ingreso</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- row 1 -->
                        <tr>
                            <th>1</th>
                            <td>Cy Ganderton</td>
                            <td>Quality Control Specialist</td>
                            <td>Blue</td>
                            <td>Blue</td>
                            <td class="w-48">
                                <x-mary-button icon="o-eye" wire:click="show()" tooltip="Ver datos" spinner
                                    class="btn-sm bg-base-content/10 border-base-content/10 hover:bg-base-content/20" />

                                <x-mary-button icon="o-pencil" wire:click="edit()" tooltip="Editar" spinner
                                    class="btn-sm bg-base-content/10 border-base-content/10 hover:bg-base-content/20" />

                                <x-mary-button icon="o-trash" wire:click="destroy()" tooltip="Eliminar" spinner
                                    class="btn-sm bg-base-content/10 border-base-content/10 hover:bg-base-content/20" />
                            </td>
                        </tr>
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
