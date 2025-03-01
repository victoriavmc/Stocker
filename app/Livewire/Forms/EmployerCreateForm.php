<?php

namespace App\Livewire\Forms;

use App\Models\Jobposition;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EmployerCreateForm extends Form
{
    //Una vez creada la persona puedo asignarle un puesto
    #[Validate('required', 'date')]
    public $startDate;
    #[Validate('required', 'string', 'max:100')]
    public $position;

    //Solo si tiene
    #[Validate('string', 'max:100')]
    public $observation;

    //Id de la persona seleccionada
    public $idPerson;

    // Ahora se procede a crear el trabajador
    public function save()
    {
        // Traemos el id de la persona que seleccionamos
        $idPerson = $this->idPerson;
        // Creamos el trabajador
        Jobposition::create([
            'starDate' => $this->startDate,
            'position' => $this->position,
            'status' => 'Trabajando', //POR DEFECTO *SINO VACACIONES, DESPEDIDO, JUBILADO y CAMBIO PUESTO...
            //*AL CAMBIAR DE PUESTO TIENE LA OBLIGACION DE CREAR UN NUEVO REGISTRO
            'observation' => $this->observation, //Solo si tiene
            'statuslogic' => 'Activo', //POR DEFECTO
            'idPerson' => $idPerson,
        ]);
        // Limpiamos los campos
        $this->reset();
    }
}
