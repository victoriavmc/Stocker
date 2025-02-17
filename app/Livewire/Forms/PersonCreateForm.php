<?php

namespace App\Livewire\Forms;

//Modelos
use App\Models\Address;
use App\Models\Person;
use App\Models\PersonalData;
use App\Models\User;
use App\Models\UserHistory;
use App\Traits\CapitalizeFields;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Form;
use Livewire\Attributes\Validate;

class PersonCreateForm extends Form
{

    use CapitalizeFields;

    // Datos personales
    #[Validate('required|string|max:100', as: "Nombre")]
    public $firstName;
    #[Validate('required|string|max:100', as: "Apellido")]
    public $lastName;
    #[Validate('required|string|max:100', as: "Nacionalidad")]
    public $nationality;
    #[Validate('required|string|digits:11', as: "CUIT")]
    public $cuit;
    #[Validate('required|string|max:50', as: "Sexo")]
    public $gender;
    #[Validate('required|date|before:today|after:1900-01-01', as: "Fecha de nacimiento")]
    public $birthdate;

    // Datos de la dirección
    #[Validate('required|string|max:100', as: "Calle")]
    public $street;
    #[Validate('nullable|string|max:100', as: "Barrio")]
    public $neighborhood;
    #[Validate('required|integer|min:1|max:3000', as: "Número de casa")]
    public $house;
    #[Validate('nullable|string|max:100', as: "Bloque")]
    public $streetBlock;
    #[Validate('nullable|string|max:100', as: "Sector")]
    public $sector;
    #[Validate('required|integer|min:1|max:3000', as: "Número")]
    public $number;

    // Datos del usuario
    #[Validate('required|string|max:100|regex:/^[a-zA-Z\s]+$/|unique:users,name', as: "Nombre de usuario")]
    public $name;
    #[Validate('required|max:250|email|unique:users,email', as: "Correo electrónico")]
    public $email;
    #[Validate('required|string|min:8|max:100', as: "Contraseña")]
    public $password;

    public $createModal = false;

    private const STATUS_ACTIVE = 'Activo';

    public function createPersonalData(): int
    {
        return PersonalData::create(
            $this->only(['firstName', 'lastName', 'cuit', 'birthdate', 'gender', 'nationality'])
        )->idPersonalData;
    }

    public function createAddress(): int
    {
        return Address::create(
            $this->only('street', 'number', 'neighborhood', 'house', 'streetBlock', 'sector')
        )->idAddres;
    }

    public function createUser(): int
    {
        return User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password)
        ])->idUser;
    }

    public function create(): void
    {
        $this->createModal = true;
    }

    //Una vez todos los datos solicitados en el formulario, se procede a crear la persona
    public function save(): void
    {
        $this->validate();

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

            $idPersonalData = $this->createPersonalData();
            $idAddress = $this->createAddress();
            $idUser = $this->createUser();

            $persona = Person::create([
                'idPersonalData' => $idPersonalData,
                'idAddres' => $idAddress,
                'idUser' => $idUser,
            ]);

            UserHistory::create([
                'statusLogic' => self::STATUS_ACTIVE,
                'idPerson' => $persona->idPerson,
            ]);

            DB::commit();

            $this->createModal = false;
            $this->reset();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
}
