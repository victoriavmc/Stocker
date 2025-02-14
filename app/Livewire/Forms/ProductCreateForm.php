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
    #[Validate('required', 'string', 'max:50')]
    public $brand;
    #[Validate('required', 'string', 'max:50')]
    public $name;

    #Products
    #[Validate('required', 'interger')]
    public $code;
    #[Validate('required', 'string', 'max:100')]
    public $measure;
    #[Validate('required', 'string', 'max:100')]
    public $productType;
    #[Validate('required', 'string', 'max:255')]
    public $photo;

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
