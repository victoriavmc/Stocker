<?php

namespace App\Livewire\Forms;

use App\Models\BaseProduct;
use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\DB;

class ProductCreateForm extends Form
{

    #BaseProducts
    #[Validate('required|string|max:50, as:Marca')]
    public $brand;
    #[Validate('required|string|max:50, as:Nombre')]
    public $name;

    #Products
    #[Validate('required|integer, as:Código')]
    public $code;
    #[Validate('required|integer|max:100, as:Medida')]
    public $measure;
    #[Validate('required|string|max:100, as:Tipo')]
    public $productType;
    #[Validate('required|image|max:1024, as:Foto')]
    public $photo;

    //Extra (Controla en el peor de los casos plis)
    public $productTypes = []; // Lista de tipos de productos existentes (Obtenemos de la base de datos)
    #[Validate('required|string|max:255')]
    public $newProductType; // Nuevo tipo de producto

    public $newProductTypeCampo = false;

    public $createModal = false;

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

        // Si no hay tipos de producto, inicializa con array vacío en lugar de valor predeterminado
        if (empty($this->productTypes)) {
            $this->productTypes = ['Sin tipos disponibles'];
        }

        // Convierte los tipos existentes al formato deseado
        $this->productTypes = collect($this->productTypes)->map(function ($type) {
            return [
                'value' => $type,
                'label' => $type,
            ];
        })->toArray();

        // Agrega la opción "Otro" al final del array
        $this->productTypes[] = [
            'value' => 'other',
            'label' => 'Otro'
        ];
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
