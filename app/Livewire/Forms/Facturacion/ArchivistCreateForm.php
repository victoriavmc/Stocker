<?php

namespace App\Livewire\Forms;

use App\Models\Archivist;
use App\Models\InventoryData;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\DB;

class ArchivistCreateForm extends Form
{
    //Inventory Data
    #[Validate('required', 'interger')]
    public $quantity;
    #[Validate('required', 'double')]
    public $price;
    #[Validate('required', 'double')]
    public $totalMovement;

    public $idProduct;

    //Archivist
    #[Validate('required', 'date')]
    public $date;
    #[Validate('required', 'string', 'max:60')]
    public $movementType;
    #[Validate('required', 'interger')]
    public $invoceNumber;

    public $idInventoryData;

    public function save()
    {
        $this->validate();

        // Save data
        DB::transaction(function () {
            // Save data InventoryData
            $inventoryData = InventoryData::create([
                'quantity' => $this->quantity,
                'price' => $this->price,
                'totalMovement' => $this->totalMovement,
                'idProduct' => $this->idProduct,
            ]);

            // Save data Archivist
            Archivist::create([
                'date' => $this->date,
                'movementType' => $this->movementType,
                'invoceNumber' => $this->invoceNumber,
                'statusLogic' => 'Activo',
                'idInventoryData' => $inventoryData->idInventoryData,
            ]);
        });

        // Se limpian los campos
        $this->reset();
    }
}
