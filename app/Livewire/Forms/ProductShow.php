<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ProductShow extends Form
{

    public $showModal = false;

    /** @var Product */
    public $product;

    #Products
    public $code;
    public $measure;
    public $productType;
    public $photo;
    public $productTypes = [];

    public function show($id)
    {
        $this->showModal = true;
        $this->product = Product::all();

        $this->fill($this->product->only('code', 'measure', 'productTypes', 'photo'));
    }
}
