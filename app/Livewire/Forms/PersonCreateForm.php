<?php

namespace App\Livewire\Forms;

//Modelos
use App\Models\Address;
use App\Models\PersonalData;
use App\Models\Person;
use App\Models\User;
use App\Models\UserHistory;
//
use Livewire\Attributes\Validate;
use Livewire\Form;
//
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PersonCreateForm extends Form
{
    // Aca los campos que se van a utilizar en el formulario para crear un trabajador

    #DATOS PERSONALES
    #[Validate('required', 'string', 'max:100')]
    public $firstName;
    #[Validate('required', 'string', 'max:100')]
    public $lastName;
    #[Validate('required', 'string', 'max:100')]
    public $nacionality;

    #[Validate('required', 'string', 'digits:11')]
    public $cuit;
    #[Validate('required', 'string', 'max:50')]
    public $gender;

    #[Validate('required', 'date')]
    public $birthdate;

    #ADDRESS
    #[Validate('required', 'string', 'max:100')]
    public $street;
    #[Validate('required', 'string', 'max:100')]
    public $neighborhood;
    #[Validate('required', 'string', 'max:100')]
    public $house;
    #[Validate('required', 'string', 'max:100')]
    public $streetBlock;
    #[Validate('required', 'string', 'max:100')]
    public $sector;

    #[Validate('required', 'integer')]
    public $number;

    #USERS
    #[Validate('required', 'string', 'max:100')]
    public $name;
    #[Validate('required', 'string', 'max:250')]
    public $email;
    #[Validate('required', 'string', 'min:8', 'max:100')]
    public $password;


    //Una vez todos los datos solicitados en el formulario, se procede a crear la persona
    public function save()
    {
        $this->validate();
        //Aca se guarda los datos en la base de datos

        // Se usa una transacción para evitar datos inconsistentes
        DB::transaction(function () {
            // Guardar datos personales
            $datosPersonalesCarga = PersonalData::create([
                'firstName' => $this->firstName,
                'lastName' => $this->lastName,
                'cuit' => $this->cuit,
                'birthdate' => $this->birthdate,
                'gender' => $this->gender,
                'nacionality' => $this->nacionality,
            ]);

            // Guardar dirección
            $datosDireccionCarga = Address::create([
                'street' => $this->street,
                'number' => $this->number,
                'neighborhood' => $this->neighborhood,
                'house' => $this->house,
                'streetBlock' => $this->streetBlock,
                'sector' => $this->sector,
            ]);

            // Guardar usuario
            $datosUsuarioCarga = User::create([
                'name' => $this->name,
                'password' => Hash::make($this->password),
                'email' => $this->email,
            ]);

            $personaCarga = Person::create([
                'idPersonalData' => $datosPersonalesCarga->idpersonalData,
                'idAddres' => $datosDireccionCarga->idAddress,
                'idUser' => $datosUsuarioCarga->idUser,
            ]);

            //Por defecto se crea el historial de usuario
            UserHistory::created([
                'statusLogic' => 'Activo',
                'idPerson' => $personaCarga->idPerson,
            ]);
        });

        // Se limpian los campos
        $this->reset();
    }
}
