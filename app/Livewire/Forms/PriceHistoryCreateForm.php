<?php

namespace App\Livewire\Forms;

use App\Models\PriceHistory;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\DB;


class PriceHistoryCreateForm extends Form
{
    //
    #[Validate('required', 'double')]
    public $unitPrice;
    #[Validate('required', 'date')]
    public $startSeason;

    public $idProduct;

    public function save()
    {
        $this->validate();

        // Save data
        DB::transaction(function () {
            // Guardar datos personales
            $datosPrice = PriceHistory::create([
                'unitPrice' => $this->unitPrice,
                'startSeason' => $this->startSeason,
                'idProduct' => $this->idProduct,
            ]);
        });
        // Se limpian los campos
        $this->reset();
    }
}
