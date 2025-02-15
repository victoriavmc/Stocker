<div>
    <div class="w-full py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{-- Buscador y Boton para ver --}}
            <div class="flex flex-row justify-end gap-2">
                {{-- Buscar --}}
                <input type="text" class="px-4 py-2 border border-gray-300 rounded-md w-96"
                    placeholder="Buscar Producto">
                {{-- Boton --}}
                <label for="my_modal_7" class="btn">Agregar Producto</label>
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
            <!-- Put this part before </body> tag -->
            <input type="checkbox" id="my_modal_7" class="modal-toggle" />
            <div class="modal" role="dialog">
                <div class="modal-box">
                    <h3 class="text-lg font-bold">Producto</h3>
                    <p class="py-4">Ingreso de datos</p>
                </div>
                <label class="modal-backdrop" for="my_modal_7">Close</label>
            </div>
        </div>
    </div>
</div>
