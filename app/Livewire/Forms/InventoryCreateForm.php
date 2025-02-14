<?php

namespace App\Livewire\Forms;

use App\Models\Inventory;
use Livewire\Attributes\Validate;
use Livewire\Form;

class InventoryCreateForm extends Form
{
    //
    #[Validate('required', 'interger')]
    public $maxQuantity;
    #[Validate('required', 'interger')]
    public $minQuantity;
    #[Validate('required', 'interger')]
    public $stock;

    public $idProduct;

    public function save()
    {
        $this->validate();

        Inventory::create([
            'maxQuantity' => $this->maxQuantity,
            'minQuantity' => $this->minQuantity,
            'stock' => $this->stock,
            'idProduct' => $this->idProduct,
        ]);

        $this->reset();
    }
}
