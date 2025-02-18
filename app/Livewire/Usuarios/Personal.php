<?php

namespace App\Livewire\Usuarios;

use App\Livewire\Forms\PersonCreateForm;
use App\Livewire\Forms\PersonEditForm;
use App\Livewire\Forms\PersonShow;
use App\Models\Country;
use App\Models\Person;
use Livewire\Component;
use Mary\Traits\Toast;

class Personal extends Component
{
    use Toast;

    public PersonCreateForm $personCreate;
    public PersonEditForm $personEdit;
    public PersonShow $personShow;

    public $deleteModal = false;

    public $personas;

    public $person;

    public $statusLogic;

    public $countries;

    public $genders = [
        [
            'value' => 'Masculino',
        ],
        [
            'value' => 'Femenino',
        ],
        [
            'value' => 'Otro',
        ]
    ];

    public $search = '';

    public function mount()
    {
        $this->countries = Country::all()->map(function ($country) {
            return [
                'value' => $country->name,
            ];
        });
    }

    public function create()
    {
        $this->personCreate->create();
    }

    public function store()
    {
        $this->personCreate->save();
        $this->success('Persona agregada al sistema correctamente');
    }

    public function show($id)
    {
        $this->personShow->show($id);
    }

    public function edit($id)
    {
        $this->personEdit->edit($id);
    }

    public function update()
    {
        $this->personEdit->update();
        $this->success('Persona actualizada correctamente');
    }

    public function destroyModal($id)
    {
        $this->deleteModal = true;
        $this->person = Person::find($id);
    }

    public function destroy()
    {
        $person = Person::find($this->person->idPerson);

        $person->userhistories->update([
            'statusLogic' => 'Inactivo',
        ]);

        $this->deleteModal = false;

        $this->success('Persona eliminada correctamente');
    }

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
            $query->orderBy('endDate', 'desc')->latest();
        }])
            ->whereHas('personaldata', function ($query) {
                $query->where('firstName', 'like', '%' . $this->search . '%')
                    ->orWhere('lastName', 'like', '%' . $this->search . '%');
            })
            ->whereHas('userHistories', function ($query) {
                $query->where('statusLogic', '!=', 'Inactivo');
            })
            ->get()
            ->map(function ($persona) {
                $ultimoCargo = $persona->jobPositions->first();
                $persona->ordenStatus = $this->determinarOrdenStatus($ultimoCargo);
                $persona->statusTrabajador = $this->determinarStatusTrabajador($ultimoCargo);
                return $persona;
            });

        $this->personas = $this->personas->sortBy('ordenStatus');

        return view('livewire.usuarios.personal', ['personas' => $this->personas]);
    }
}
