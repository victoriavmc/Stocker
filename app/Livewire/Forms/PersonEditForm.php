<?php

namespace App\Livewire\Forms;

use App\Models\Address;
use App\Models\Person;
use App\Models\PersonalData;
use App\Models\User;
use App\Traits\CapitalizeFields;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PersonEditForm extends Form
{
    use CapitalizeFields;

    public $idPerson;

    /** @var Person */
    public $person;
    /** @var PersonalData */
    public $personalData;
    /** @var Address */
    public $address;
    /** @var User */
    public $user;

    // Datos personales
    #[Validate('required|string|max:100', as: 'Nombre')]
    public $firstName;
    #[Validate('required|string|max:100', as: 'Apellido')]
    public $lastName;
    #[Validate('required|string|max:100', as: 'Nacionalidad')]
    public $nationality;
    #[Validate('required|string|digits:11', as: 'CUIT')]
    public $cuit;
    #[Validate('required|string|max:50', as: 'Genero')]
    public $gender;
    #[Validate('required|date|before:today|after:1900-01-01', as: 'Fecha de nacimiento')]
    public $birthdate;

    // Datos de la dirección
    #[Validate('required|string|max:100', as: 'Calle')]
    public $street;
    #[Validate('nullable|string|max:100', as: 'Barrio')]
    public $neighborhood;
    #[Validate('required|integer|min:1|max:3000', as: 'Número de casa')]
    public $house;
    #[Validate('nullable|string|max:100', as: 'Bloque')]
    public $streetBlock;
    #[Validate('nullable|string|max:100', as: 'Sector')]
    public $sector;
    #[Validate('required|integer|min:1|max:3000', as: 'Número')]
    public $number;

    // Datos del usuario
    public $name;
    public $email;
    #[Validate('nullable|string|min:8|max:100', as: 'Contraseña')]
    public $password;
    public $profile_photo_path;

    public $editModal = false;

    public function edit($id)
    {
        $this->resetValidation();
        $this->idPerson = $id;

        $this->loadModels();
        $this->fillFormData();

        $this->editModal = true;
    }

    public function deleteImage()
    {
        $path = $this->profile_photo_path;

        $this->profile_photo_path = null;

        return $path;
    }

    public function update()
    {
        $this->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-zA-Z\s]+$/',
                Rule::unique('users', 'name')->ignore($this->person->idUser, 'idUser'),
            ],
            'email' => [
                'required',
                'max:250',
                'email',
                Rule::unique('users', 'email')->ignore($this->person->idUser, 'idUser'),
            ],
        ]);

        $fieldsToCapitalize = [
            'firstName',
            'lastName',
            'street',
            'neighborhood',
            'streetBlock',
            'sector',
        ];

        $this->capitalizeFields($fieldsToCapitalize);

        try {
            DB::beginTransaction();

            $this->updatePersonalData();
            $this->updateAddress();
            $this->updateUser();

            DB::commit();
            $this->editModal = false;
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    private function loadModels()
    {
        $this->person = Person::findOrFail($this->idPerson);
        $this->personalData = PersonalData::findOrFail($this->person->idPersonalData);
        $this->address = Address::findOrFail($this->person->idAddres);
        $this->user = User::findOrFail($this->person->idUser);
    }

    private function fillFormData()
    {
        $this->fillPersonalData();
        $this->fillAddressData();
        $this->fillUserData();
    }

    private function fillPersonalData()
    {
        $fields = [
            'firstName',
            'lastName',
            'nationality',
            'cuit',
            'gender',
            'birthdate'
        ];

        foreach ($fields as $field) {
            $this->$field = $this->personalData->$field;
        }
    }

    private function fillAddressData()
    {
        $fields = [
            'street',
            'neighborhood',
            'house',
            'streetBlock',
            'sector',
            'number'
        ];

        foreach ($fields as $field) {
            $this->$field = $this->address->$field;
        }
    }

    private function fillUserData()
    {
        $fields = [
            'name',
            'email',
            'password',
            'profile_photo_path'
        ];

        foreach ($fields as $field) {
            $this->$field = $this->user->$field;
        }
    }

    private function updatePersonalData()
    {
        $this->person->personalData->update(
            $this->only('firstName', 'lastName', 'nationality', 'cuit', 'gender', 'birthdate')
        );
    }

    private function updateAddress()
    {
        $this->person->address->update(
            $this->only('street', 'neighborhood', 'house', 'streetBlock', 'sector', 'number')
        );
    }

    private function updateUser()
    {
        $this->person->address->update(
            $this->only('name', 'email', 'password', 'profile_photo_path')
        );
    }
}
