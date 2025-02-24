<?php

namespace App\Livewire\Forms;

use App\Models\Jobposition;
use App\Traits\CapitalizeFields;
use Exception;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EmployeeCreateForm extends Form
{
    use CapitalizeFields;

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

    #[Validate('required|integer')]
    public $idPerson;

    public $statusLogic = 'Activo';

    public $createModal = false;

    public function create(): void
    {
        $this->resetValidation();
        $this->createModal = true;
    }

    public function save(): Jobposition
    {
        $this->validate();

        $fieldsToCapitalize = [
            'position',
            'status',
            'observation',
        ];

        $this->capitalizeFields($fieldsToCapitalize);

        try {
            $jobPosition = Jobposition::create(
                $this->only('startDate', 'endDate', 'position', 'status', 'observation', 'statusLogic')
            );

            $this->createModal = false;
            $this->reset();
        } catch (Exception $e) {
            throw $e;
        }

        return $jobPosition;
    }
}
