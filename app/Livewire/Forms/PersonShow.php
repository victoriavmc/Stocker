<?php

namespace App\Livewire\Forms;

use App\Models\Person;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PersonShow extends Form
{
    public $showModal = false;

    /** @var Person */
    public $person;
    /** @var PersonalData */
    public $personalData;
    /** @var Address */
    public $address;
    /** @var User */
    public $user;

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
        $this->person = Person::with(['personalData', 'address', 'user'])->findOrFail($id);

        $this->loadPersonalData();

        $this->loadAddressData();

        $this->loadUserData();
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
}
