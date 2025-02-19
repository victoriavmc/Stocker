<div>
    <div class="w-full py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{-- Buscador y Boton para ver --}}
            <div class="flex items-center justify-end gap-2 mb-4">
                <x-mary-input class="px-4 py-2" label="Buscar..." wire:model.live="search" icon="o-magnifying-glass"
                    clearable inline />

                <x-primary-btn label="Agregar Producto" icon="o-plus" spinner wire:click="create()" />
            </div>

            {{-- Productos en Sistema --}}
            <div class="flex flex-wrap justify-center mt-4">
                {{-- @foreach ($productos as $producto) --}}
                <div class="shadow-xl card bg-base-100 w-96">
                    <div class="card-body">
                        <h2 class="card-title">Name
                            <div class="badge badge-secondary">Falta</div>
                        </h2>
                        <p class="flex justify-end mt-8 align-bottom">Stock Actual: / Stock Minimo / Stock Max</p>
                    </div>
                    <figure>
                        <img src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
                            alt="Marca.Nombre" />
                    </figure>
                </div>
                {{-- @endforeach --}}
            </div>
        </div>
    </div>

    {{-- MODAL --}}
    {{-- Crear Producto --}}
    <x-mary-form wire:submit="store">
        <x-dialog-modal wire:model="productCreate.createModal">
            <x-slot name="title">
                <div class="flex items-center space-x-2">
                    <x-mary-icon name="o-cube" class="w-6 h-6 text-primary" />
                    <span class="text-xl font-semibold">Agregar Producto</span>
                </div>
            </x-slot>

            <x-slot name="content">
                <x-mary-errors title="Oops!" description="Por favor, corrija los errores." icon="o-face-frown" />

                <div class="grid grid-cols-1 mt-4 md:grid-cols-2">
                    <!-- Sección de Información Básica -->
                    <div class="pr-4 space-y-4 border-r border-base-content/20">
                        <div class="flex items-center space-x-2">
                            <x-mary-icon name="o-tag" class="w-5 h-5 text-primary" />
                            <span class="text-lg font-medium">Información Básica</span>
                        </div>

                        <x-mary-input wire:model="productCreate.brand" label="Marca" right-icon="o-tag" inline />

                        <x-mary-input wire:model="productCreate.name" label="Nombre" right-icon="o-cube" inline />

                        <x-mary-input wire:model="productCreate.code" label="Código de Barras" right-icon="o-barcode"
                            inline />

                        <x-mary-input wire:model="productCreate.measure" label="Medida">
                            <x-slot:prepend>
                                <x-mary-select wire:model="productCreate.measureUnit" :options="[
                                    ['value' => 'g', 'label' => 'Gramos'],
                                    ['value' => 'kg', 'label' => 'Kilogramos'],
                                    ['value' => 'cm3', 'label' => 'Centímetros Cúbicos'],
                                    ['value' => 'l', 'label' => 'Litros'],
                                    ['value' => 'm', 'label' => 'Metros'],
                                    ['value' => 'cm', 'label' => 'Centímetros'],
                                ]"
                                    option-value="value" option-label="label" class="rounded-e-none bg-base-200"
                                    icon="o-scale" />
                            </x-slot:prepend>
                        </x-mary-input>
                    </div>

                    <!-- Sección de Tipo de Producto -->
                    <div class="pl-4 space-y-4">
                        <div class="flex items-center space-x-2">
                            <x-mary-icon name="o-list-bullet" class="w-5 h-5 text-primary" />
                            <span class="text-lg font-medium">Tipo de Producto</span>
                        </div>

                        <!-- Selector de Tipo de Producto -->
                        <div class="mt-3">
                            <!-- Selector de Tipo de Producto -->
                            <label class="block w-full max-w-xs mt-1 form-control">
                                <select class="select select-primary w-full font-normal h-14 pt-3"
                                    wire:model.live="productCreate.productType">
                                    <option value="" selected hidden>Seleccione un tipo de producto</option>
                                    @foreach ($productTypes as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                    <option value="other">Otro</option>
                                </select>
                            </label>

                            <!-- Campo para nuevo tipo de producto (si se selecciona "Otro") -->
                            @if ($productCreate->newProductTypeCampo)
                                <div class="mt-3">
                                    <label class="block w-full max-w-xs mt-1 form-control">
                                        <input type="text" class="w-full input input-bordered"
                                            wire:model="productCreate.newProductType"
                                            placeholder="Nuevo Tipo de Producto" />
                                    </label>
                                </div>
                            @endif
                        </div>

                        <div class="space-y-2">
                            <span class="text-sm font-bold">Foto del producto</span>
                            <input type="file" class="file-input file-input-bordered file-input-primary w-full"
                                wire:model="productCreate.photo" accept="image/*" />

                        </div>

                        {{-- Previsualizacion de la foto --}}
                        @if ($productCreate->photo)
                            <div class="mt-4">
                                <img src="{{ $productCreate->photo->temporaryUrl() }}" alt="Foto del producto"
                                    class="w-full h-48 object-cover rounded-md" />
                            </div>
                        @endif

                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="flex justify-end space-x-2">
                    <x-danger-button type="button" wire:click="$set('productCreate.createModal', false)"
                        class="flex items-center space-x-2">
                        <x-mary-icon name="o-x-mark" class="w-5 h-5" />
                        <span>Cancelar</span>
                    </x-danger-button>

                    <x-button type="submit" wire:loading.attr="disabled" class="flex items-center space-x-2">
                        <x-mary-icon name="o-check" class="w-5 h-5" />
                        <span>Crear</span>
                    </x-button>
                </div>
            </x-slot>
        </x-dialog-modal>
    </x-mary-form>
</div>
