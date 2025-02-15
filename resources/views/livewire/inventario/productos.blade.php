<div>
    <div class="w-full py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{-- Buscador y Boton para ver --}}
            <div class="flex flex-row justify-end gap-2">
                {{-- Buscar --}}
                <input type="text" class="px-4 py-2 border border-gray-300 rounded-md w-96"
                    placeholder="Buscar Producto">
                {{-- Boton --}}
                <x-primary-btn label="Agregar Producto" icon="o-plus" spinner wire:click="create()" />
            </div>

            {{-- Productos en Sistema --}}
            <div class="flex flex-wrap justify-center mt-4">
                {{-- @foreach ($productos as $producto) --}}
                <div class="shadow-xl card bg-base-100 w-96">
                    <div class="card-body">
                        <h2 class="card-title">Nombre
                            <div class="badge badge-secondary">Falta</div>
                        </h2>
                        <p class="flex justify-end mt-8 align-bottom">Stock Actual / Stock Minimo / Stock Max</p>
                    </div>
                    <figure>
                        <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                            alt="Marca.Nombre" />
                    </figure>
                </div>
                {{-- @endforeach --}}
            </div>

            {{-- MODAL --}}
            {{-- Crear usuario --}}
            <x-mary-form wire:submit="store">
                <x-dialog-modal wire:model="personCreate.createModal">
                    <x-slot name="title">
                        Agregar Productos
                    </x-slot>

                    <x-slot name="content">
                        <x-mary-errors title="Oops!" description="Porfavor, corrija los errores."
                            icon="o-face-frown" />

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
                                    <x-mary-input wire:model="personCreate.nationality" inline label="Nacionalidad"
                                        class="block w-full mt-1" type="text" :value="old('personCreate.nationality')" />
                                </div>

                                <div class="mt-3">
                                    <x-mary-input wire:model="personCreate.cuit" inline label="Cuit"
                                        class="block w-full mt-1" type="text" :value="old('personCreate.cuit')" />
                                </div>

                                <div class="mt-3">
                                    <label class="block w-full max-w-xs mt-1 form-control">
                                        <select class="w-full select select-bordered" wire:model="personCreate.genero">
                                            <option disabled selected>Selecciona un genero</option>
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
                                    <x-mary-input icon="o-map-pin" wire:model="personCreate.street" inline
                                        label="Calle" class="block w-full mt-1" type="text" :value="old('personCreate.street')" />
                                </div>

                                <div class="mt-3">
                                    <x-mary-input icon="o-map-pin" wire:model="personCreate.neighborhood" inline
                                        label="Barrio" class="block w-full mt-1" type="text" :value="old('personCreate.neighborhood')" />
                                </div>

                                <div class="mt-3">
                                    <x-mary-input icon="o-map-pin" wire:model="personCreate.house" inline label="Casa"
                                        class="block w-full mt-1" type="text" :value="old('personCreate.house')" />
                                </div>

                                <div class="mt-3">
                                    <x-mary-input icon="o-map-pin" wire:model="personCreate.streetBlock" inline
                                        label="Manzana" class="block w-full mt-1" type="text" :value="old('personCreate.streetBlock')" />
                                </div>

                                <div class="mt-3">
                                    <x-mary-input icon="o-map-pin" wire:model="personCreate.sector" inline
                                        label="Sector" class="block w-full mt-1" type="text" :value="old('personCreate.sector')" />
                                </div>

                                <div class="mt-3">
                                    <x-mary-input icon="o-map-pin" wire:model="personCreate.number" inline
                                        label="Numero" class="block w-full mt-1" type="text" :value="old('personCreate.number')" />
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

        </div>
    </div>
</div>
