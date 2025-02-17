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

        // Cargar datos personales
        $this->loadPersonalData();

        // Cargar datos de dirección  
        $this->loadAddressData();

        // Cargar datos de usuario
        $this->loadUserData();
    }

    private function loadPersonalData()
    {
        $this->personalData = $this->person->personalData;
        $this->fill([
            'firstName' => $this->personalData->firstName,
            'lastName' => $this->personalData->lastName,
            'nationality' => $this->personalData->nationality,
            'cuit' => $this->personalData->cuit,
            'gender' => $this->personalData->gender,
            'birthdate' => $this->personalData->birthdate
        ]);
    }

    private function loadAddressData()
    {
        $this->address = $this->person->address;
        $this->fill([
            'street' => $this->address->street,
            'neighborhood' => $this->address->neighborhood,
            'house' => $this->address->house,
            'streetBlock' => $this->address->streetBlock,
            'sector' => $this->address->sector,
            'number' => $this->address->number
        ]);
    }

    private function loadUserData()
    {
        $this->user = $this->person->user;
        $this->fill([
            'name' => $this->user->name,
            'email' => $this->user->email,
            'password' => $this->user->password,
            'profile_photo_path' => $this->user->profile_photo_path
        ]);
    }
}
