<?php

namespace App\Livewire\Usuarios;

use App\Models\Person;
use Livewire\Component;

namespace App\Livewire\Usuarios;

use App\Models\Person;
use Livewire\Component;

class Trabajadores extends Component
{
    public $createModal = false;
    public $showModal = false;
    public $editModal = false;

    // Variables para almacenar los trabajadores
    public $personas;

    // Variable para almacenar el trabajador seleccionado
    public $persona;

    // Datos necesarios para la paginación
    public $idPerson;
    public $profile_photo_path;
    public $firstName;
    public $lastName;
    public $statusTrabajador;
    public $created_at;

    public function create()
    {
        $this->createModal = true;
    }

    public function store() {}

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

    public function mount()
    {
        // Cargamos las personas con el último cargo asignado
        $this->personas = Person::with(['jobPositions' => function ($query) {
            $query->orderBy('endDate', 'desc')->latest(); // Traemos el último cargo asignado
        }])->get()->map(function ($persona) {
            $ultimoCargo = $persona->jobPositions->first(); // Obtener el más reciente

            if ($ultimoCargo === null) {
                // Si no tiene ningún cargo asignado
                $persona->statusTrabajador = 'FALTA ASIGNAR';
                $persona->ordenStatus = 1; // Ordenar primero
            } elseif ($ultimoCargo->endDate === null) {
                // Si no tiene fecha de fin, sigue trabajando
                if ($ultimoCargo->status != 'Trabajando') {
                    $persona->statusTrabajador = 'Trabajando (' . $ultimoCargo->status . ')';
                } else {
                    $persona->statusTrabajador = 'Trabajando';
                }
                $persona->ordenStatus = 2; // Ordenar después de "Falta Asignar"
            } else {
                // Si tiene un endDate, es un extrabajador
                $persona->statusTrabajador = 'Extrabajador';

                // Si el estado es "Extrabajador", le asignamos los posibles estados "Despedido" o "Jubilado"
                if (isset($ultimoCargo->status)) {
                    $persona->statusTrabajador = 'Extrabajador (' . $ultimoCargo->status . ')';
                }
                $persona->ordenStatus = 3; // Ordenar al final
            }

            return $persona;
        });

        // Ordenamos primero por 'ordenStatus' para que "Falta Asignar" salga primero, luego "Trabajando" y por último "Extrabajador"
        $this->personas = $this->personas->sortBy('ordenStatus');
    }


    public function render()
    {
        return view('livewire.usuarios.trabajadores');
    }
}
