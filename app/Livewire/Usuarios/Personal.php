<?php

namespace App\Livewire\Usuarios;

use App\Livewire\Forms\PersonCreateForm;
use App\Livewire\Forms\PersonEditForm;
use App\Livewire\Forms\PersonShow;
use App\Models\Country;
use App\Models\Person;
use Exception;
use Livewire\Component;
use Mary\Traits\Toast;

use function Laravel\Prompts\error;

class Personal extends Component
{
    use Toast;

    public PersonCreateForm $personCreate;
    public PersonEditForm $personEdit;
    public PersonShow $personShow;

    public $personas;

    public $countries;

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

    public function destroy($id)
    {
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
