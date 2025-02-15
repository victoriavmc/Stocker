<?php

namespace App\Livewire\Forms;

//Modelos
use App\Models\Address;
use App\Models\Person;
use App\Models\PersonalData;
use App\Models\User;
use App\Models\UserHistory;
use Livewire\Form;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;

class PersonCreateForm extends Form
{
    // Datos personales
    #[Validate('required|string|max:100')]
    public $firstName;

    #[Validate('required|string|max:100')]
    public $lastName;

    #[Validate('required|string|max:100')]
    public $nationality;

    #[Validate('required|string|digits:11')]
    public $cuit;

    #[Validate('required|string|max:50')]
    public $gender;

    #[Validate('required|date|before:today|after:1900-01-01')]
    public $birthdate;

    // Datos de la dirección
    #[Validate('required|string|max:100')]
    public $street;

    #[Validate('required|string|max:100')]
    public $neighborhood;

    #[Validate('required|integer|min:1|max:100')]
    public $house;

    #[Validate('required|string|max:100')]
    public $streetBlock;

    #[Validate('required|string|max:100')]
    public $sector;

    #[Validate('required|integer')]
    public $number;

    public $createModal = false;

    // Datos del usuario
    #[Validate('required|string|max:100|regex:/^[a-zA-Z\s]+$/')]
    public $name;

    #[Validate('required|max:250|email')]
    public $email;

    #[Validate('required|string|min:8|max:100|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/')]
    public $password;

    public function createPersonalData(): int
    {
        $this->validate();

        $datosPersonalesCarga = PersonalData::create(
            $this->only('firstName', 'lastName', 'cuit', 'birthdate', 'gender', 'nationality')
        );

        return $datosPersonalesCarga->idPersonalData;
    }

    public function createAddress(): int
    {
        $this->validate();

        $datosDireccionCarga = Address::create(
            $this->only('street', 'number', 'neighborhood', 'house', 'streetBlock', 'sector')
        );

        return $datosDireccionCarga->idAddres;
    }

    public function createUser(): int
    {
        $this->validate();

        // Guardar usuario
        $datosUsuarioCarga = User::create(
            $this->only('name', 'password', 'email')
        );

        return $datosUsuarioCarga->idUser;
    }

    public function create()
    {
        $this->createModal = true;
    }

    //Una vez todos los datos solicitados en el formulario, se procede a crear la persona
    public function save()
    {
        // Creamos los datos en orden
        $idPersonalData = $this->createPersonalData();

        if (!$idPersonalData) {
            throw new \Exception('Error al crear datos personales');
        }

        $idAddress = $this->createAddress();

        if (!$idAddress) {
            throw new \Exception('Error al crear dirección');
        }

        $idUser = $this->createUser();

        if (!$idUser) {
            throw new \Exception('Error al crear usuario');
        }

        $personaCarga = Person::create([
            'idPersonalData' => $idPersonalData,
            'idAddres' => $idAddress,
            'idUser' => $idUser,
        ]);

        UserHistory::create([
            'statusLogic' => 'Activo',
            'idPerson' => $personaCarga->idPerson,
        ]);

        $this->createModal = false;
        $this->reset();
    }
}
