<?php

namespace App\Livewire\Forms;

use App\Models\Jobposition;
use App\Traits\CapitalizeFields;
use Exception;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EmployeeEditForm extends Form
{
    use CapitalizeFields;

    public $idJobPosition;

    /** @var Jobposition */
    public $jobPosition;

    #[Validate('required|date')]
    public $startDate;
    #[Validate('required|date')]
    public $endDate;
    #[Validate('required')]
    public $position;
    #[Validate('required')]
    public $status;
    #[Validate('required')]
    public $observation;

    public $editModal = false;
    public $trabajador;

    public function edit($id)
    {
        $this->resetValidation();
        $this->idJobPosition = $id;

        $this->loadModels();
        $this->fillJobPositionData();

        $this->editModal = true;
    }

    public function update()
    {
        $this->validate();

        $fieldsToCapitalize = [
            'position',
            'status',
            'observation',
        ];

        $this->capitalizeFields($fieldsToCapitalize);

        try {
            $this->jobPosition->update($this->only('startDate', 'endDate', 'position', 'status', 'observation'));
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function loadModels()
    {
        $this->jobPosition = Jobposition::findOrFail($this->idJobPosition);
    }

    private function fillJobPositionData()
    {
        $fields = [
            'startDate',
            'endDate',
            'position',
            'status',
            'observation',
        ];

        foreach ($fields as $field) {
            $this->$field = $this->jobPosition->$field;
        }
    }
}
