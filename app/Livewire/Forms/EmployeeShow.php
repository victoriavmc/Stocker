<?php

namespace App\Livewire\Forms;

use App\Models\Jobposition;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EmployeeShow extends Form
{
    public $showModal = false;

    /** @var JobPosition */
    public $jobPosition;

    public $startDate;
    public $endDate;
    public $position;
    public $status;
    public $observation;

    public function show($id)
    {
        $this->showModal = true;
        $this->jobPosition = Jobposition::findOrFail($id);

        $this->loadJobPositionData();
    }

    private function loadJobPositionData()
    {
        $this->fill($this->only('startDate', 'endDate', 'position', 'status', 'observation'));
    }
}
