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
                <x-dialog-modal wire:model="productCreate.createModal">
                    <x-slot name="title">
                        Agregar Productos
                    </x-slot>

                    <x-slot name="content">
                        <x-mary-errors title="Oops!" description="Por favor, corrija los errores."
                            icon="o-face-frown" />

                        <div class="grid grid-cols-1 gap-4 mt-2 md:grid-cols-2">
                            <div>
                                <x-mary-input wire:model="productCreate.brand" inline label="Marca"
                                    class="block w-full mt-1" type="text" />
                            </div>

                            <div>
                                <x-mary-input wire:model="productCreate.name" inline label="Nombre"
                                    class="block w-full mt-1" type="text" />
                            </div>

                            <div>
                                <x-mary-input wire:model="productCreate.code" inline label="Código de Barras"
                                    class="block w-full mt-1" type="text" />
                            </div>

                            <div>
                                <x-mary-input wire:model="productCreate.measure" inline label="Medida"
                                    class="block w-full mt-1" type="text" />
                            </div>

                            {{-- Extra (Controla en el peor de los casos plis) --}}
                            <div>
                                <x-mary-select wire:model="productCreate.productType" inline label="Tipo de Producto"
                                    class="block w-full mt-1">
                                    <option value="">-- Seleccionar --</option>
                                    @foreach ($productTypes ?? [] as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                    <option value="other">Otro</option>
                                </x-mary-select>

                                @if ($productCreate->productType === 'other')
                                    <x-mary-input wire:model="productCreate.newProductType" inline
                                        label="Nuevo Tipo de Producto" class="block w-full mt-2" type="text" />
                                @endif
                            </div>
                        </div>
                    </x-slot>

                    <x-slot name="footer">
                        <div class="space-x-2">
                            <x-danger-button type="button" wire:click="$set('productCreate.createModal', false)">
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
