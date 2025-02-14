<?php

namespace App\Livewire\Forms;

use App\Models\Archivist;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\DB;

class ReportCreateForm extends Form
{
    //
    #[Validate('required', 'string', 'max:200')]
    public $observation;

    public $idArchivist;

    public function save()
    {
        $this->validate();

        // Save data
        DB::transaction(function () {
            // Save data Archivist
            Archivist::create([
                'observation' => $this->observation,
                'statusLogic' => 'Activo',
                'idArchivist' => $this->idArchivist,
            ]);
        });

        // Se limpian los campos
        $this->reset();
    }
}
