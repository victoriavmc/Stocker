<?php

namespace App\Livewire\Usuarios;

use App\Models\Person;
use Livewire\Component;

namespace App\Livewire\Usuarios;

use App\Livewire\Forms\PersonCreateForm;
use App\Models\Person;
use Livewire\Component;
use Mary\Traits\Toast;

class Personal extends Component
{

    use Toast;

    public PersonCreateForm $personCreate;

    public $showModal = false;
    public $editModal = false;

    public $personas;

    public $persona;

    // Datos necesarios para la paginación
    // public $idPerson;
    // public $profile_photo_path;
    // public $firstName;
    // public $lastName;
    // public $statusTrabajador;
    // public $created_at;

    public function create()
    {
        $this->personCreate->create();
    }

    public function store()
    {
        $this->personCreate->save();

        $this->success('Persona agregada al sistema correctamente');
    }

    public function show()
    {
        $this->showModal = true;
    }

    public function edit()
    {
        $this->editModal = true;
    }

    public function update() {}

    public function destroy() {}

    public function determinarOrdenStatus($cargo)
    {
        if ($cargo === null) return 1;

        if ($cargo->endDate === null) return 2;

        return 3;
    }

    public function determinarStatusTrabajador($cargo)
    {
        if ($cargo === null) return "FALTA ASIGNAR";

        if ($cargo->endDate === null) return $cargo->status != 'Trabajando' ? 'Trabajando (' . $cargo->status . ')' : 'Trabajando';

        return isset($cargo->status) ? 'Extrabajador (' . $cargo->status . ')' : 'Extrabajador';
    }

    public function render()
    {
        $this->personas = Person::with(['jobPositions' => function ($query) {
            $query->orderBy('endDate', 'desc')->latest(); // Traemos el último cargo asignado
        }])->get()->map(function ($persona) {
            $ultimoCargo = $persona->jobPositions->first(); // Obtener el más reciente

            $persona->ordenStatus = $this->determinarOrdenStatus($ultimoCargo);
            $persona->statusTrabajador = $this->determinarStatusTrabajador($ultimoCargo);

            return $persona;
        });

        // Ordenamos primero por 'ordenStatus' para que "Falta Asignar" salga primero, luego "Trabajando" y por último "Extrabajador"
        $this->personas = $this->personas->sortBy('ordenStatus');

        return view('livewire.usuarios.personal', ['personas' => $this->personas]);
    }
}
