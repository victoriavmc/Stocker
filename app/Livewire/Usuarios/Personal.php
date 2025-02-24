<?php

namespace App\Livewire\Usuarios;

use App\Events\EmailNotification;
use App\Livewire\Forms\PersonCreateForm;
use App\Livewire\Forms\PersonEditForm;
use App\Livewire\Forms\PersonShow;
use App\Models\Country;
use App\Models\Person;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class Personal extends Component
{
    use Toast;
    use WithPagination;

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
        $this->countries = Country::all();
    }

    public function create()
    {
        $this->personCreate->create();
    }

    public function store()
    {
        $persona = $this->personCreate->save();
        $this->success('Persona agregada al sistema correctamente');

        $this->resetPage();

        event(new EmailNotification('bienvenida', ['personaldata' => $persona->personaldata, 'user' => $persona->user]));

        // Enviar email de notiAsignarAreaLaburo a todos los usuarios con el rol de RRHH
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

        $this->dispatch('personUpdated');
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

    public function deleteImage()
    {
        $path = $this->personEdit->deleteImage();

        session(['image_path_to_delete' => $path]);
    }

    #[On('personUpdated')]
    public function deleteImageFromStorage()
    {
        if (session()->has('image_path_to_delete')) {
            Storage::disk('public')->delete(session()->get('image_path_to_delete'));
            session()->forget('image_path_to_delete');
        }

        $this->success('Imagen eliminada correctamente');
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
        $personas = Person::with(['jobPositions' => function ($query) {
            $query->orderBy('endDate', 'desc')->latest();
        }])
            ->whereHas('personaldata', function ($query) {
                $query->where('firstName', 'like', '%' . $this->search . '%')
                    ->orWhere('lastName', 'like', '%' . $this->search . '%');
            })
            ->whereHas('userHistories', function ($query) {
                $query->where('statusLogic', '!=', 'Inactivo');
            });

        $personasPaginadas = $personas->paginate(6);

        $this->personas = collect($personasPaginadas->items())
            ->map(function ($persona) {
                $ultimoCargo = $persona->jobPositions->first();
                $persona->ordenStatus = $this->determinarOrdenStatus($ultimoCargo);
                $persona->statusTrabajador = $this->determinarStatusTrabajador($ultimoCargo);
                return $persona;
            })
            ->sortBy('ordenStatus');

        return view('livewire.usuarios.personal', [
            'personas' => $this->personas,
            'personasPaginadas' => $personasPaginadas
        ]);
    }
}
