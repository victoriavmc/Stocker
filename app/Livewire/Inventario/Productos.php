<?php

namespace App\Livewire\Inventario;

use App\Livewire\Forms\ProductCreateForm;
use App\Models\Product;
use Livewire\Component;
use Mary\Traits\Toast;

class Productos extends Component
{
    use Toast;

    public ProductCreateForm $productCreate;

    public $showModal = false;
    public $editModal = false;

    public $productos;

    public $producto;

    public function create()
    {
        $this->productCreate->create();
    }

    public function store()
    {
        $this->productCreate->save();

        $this->success('Producto agregado al sistema correctamente');
    }

    public function show()
    {
        $this->showModal = true;
    }

    public function edit()
    {
        $this->editModal = true;
    }

    public function update() {}

    public function destroy() {}

    public function amount()
    {
        $this->productos = Product::all();
    }

    public function render()
    {
        $this->productCreate->loadProductTypes(); // Cargar antes de renderizar

        return view('livewire.inventario.productos', [
            'productTypes' => $this->productCreate->productTypes, // Pasar los tipos de productos a la vista
        ]);
    }
}
