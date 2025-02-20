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
        // Datos personales
        $this->firstName = $this->personalData->firstName;
        $this->lastName = $this->personalData->lastName;
        $this->nationality = $this->personalData->nationality;
        $this->cuit = $this->personalData->cuit;
        $this->gender = $this->personalData->gender;
        $this->birthdate = $this->personalData->birthdate;

        // Datos de dirección
        $this->street = $this->address->street;
        $this->neighborhood = $this->address->neighborhood;
        $this->house = $this->address->house;
        $this->streetBlock = $this->address->streetBlock;
        $this->sector = $this->address->sector;
        $this->number = $this->address->number;

        // Datos de usuario
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->password = $this->user->password;
        $this->profile_photo_path = $this->user->profile_photo_path;
    }

    private function updatePersonalData()
    {
        $this->person->personalData->update([
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'nationality' => $this->nationality,
            'cuit' => $this->cuit,
            'gender' => $this->gender,
            'birthdate' => $this->birthdate,
        ]);
    }

    private function updateAddress()
    {
        $this->person->address->update([
            'street' => $this->street,
            'neighborhood' => $this->neighborhood,
            'house' => $this->house,
            'streetBlock' => $this->streetBlock,
            'sector' => $this->sector,
            'number' => $this->number,
        ]);
    }

    private function updateUser()
    {
        $this->person->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'profile_photo_path' => $this->profile_photo_path,
            'password' => $this->password,
        ]);
    }
}
