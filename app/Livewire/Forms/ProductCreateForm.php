<?php

namespace App\Livewire\Forms;

use App\Models\BaseProduct;
use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\DB;

class ProductCreateForm extends Form
{
    //
    #BaseProducts
    #[Validate('required|string|max:50')]
    public $brand;
    #[Validate('required|string|max:50')]
    public $name;

    #Products
    #[Validate('required|interger')]
    public $code;
    #[Validate('required|string|max:100')]
    public $measure;
    #[Validate('required|string|max:100')]
    public $productType;
    #[Validate('required|string|max:255')]
    public $photo;

    //Extra (Controla en el peor de los casos plis)
    public $productTypes = []; // Lista de tipos de productos existentes (Obtenemos de la base de datos)
    #[Validate('required|string|max:255')]
    public $newProductType; // Nuevo tipo de producto

    public $createModal = false;
    // Modal
    public function create()
    {
        $this->createModal = true;
    }

    // Cargar tipos de productos desde la base de datos
    public function loadProductTypes()
    {
        $this->productTypes = Product::distinct()
            ->orderBy('productType', 'asc')
            ->pluck('productType')
            ->toArray();
    }

    public function save()
    {
        $this->validate();
        // Save data

        // Se usa una transacción para evitar datos inconsistentes
        DB::transaction(function () {
            // Guardar datos baseProducts
            $baseProduct = BaseProduct::create([
                'brand' => $this->brand,
                'name' => $this->name,
            ]);
            // Guardar datos Product
            Product::create([
                'code' => $this->code,
                'measure' => $this->measure,
                'productType' => $this->productType,
                'photo' => $this->photo,
                'statusLogic' => 'Activo',
                'idBaseProduct' => $baseProduct->idBaseProduct,
            ]);
        });

        // Se limpian los campos
        $this->reset();
    }
}
