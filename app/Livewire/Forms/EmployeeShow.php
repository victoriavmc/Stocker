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
    /** @var Person */
    public $person;
    /** @var PersonalData */
    public $personalData;
    /** @var Address */
    public $address;
    /** @var User */
    public $user;

    // Datos del trabajador
    public $startDate;
    public $endDate;
    public $position;
    public $status;
    public $observation;

    // Datos personales
    public $firstName;
    public $lastName;
    public $nationality;
    public $cuit;
    public $gender;
    public $birthdate;

    // Datos de la dirección
    public $street;
    public $neighborhood;
    public $house;
    public $streetBlock;
    public $sector;
    public $number;

    // Datos del usuario
    public $name;
    public $email;
    public $password;
    public $profile_photo_path;

    public function show($id)
    {
        $this->showModal = true;
        $this->jobPosition = Jobposition::findOrFail($id);

        $this->loadPersonalData();

        $this->loadAddressData();

        $this->loadUserData();

        $this->loadEmployeeData();
    }

    private function loadPersonalData()
    {
        $this->personalData = $this->person->personalData;

        $this->fill($this->personalData->only('firstName', 'lastName', 'nationality', 'cuit', 'gender', 'birthdate'));
    }

    private function loadAddressData()
    {
        $this->address = $this->person->address;

        $this->fill($this->address->only('street', 'neighborhood', 'house', 'streetBlock', 'sector', 'number'));
    }

    private function loadUserData()
    {
        $this->user = $this->person->user;

        $this->fill($this->user->only('name', 'email', 'password', 'profile_photo_path'));
    }

    private function loadEmployeeData()
    {
        $this->fill($this->only('startDate', 'endDate', 'position', 'status', 'observation'));
    }
}
