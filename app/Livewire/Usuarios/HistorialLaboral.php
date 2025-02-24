<?php

namespace App\Livewire\Usuarios;

use App\Livewire\Forms\employeeCreateForm;
use App\Livewire\Forms\employeeEditForm;
use App\Livewire\Forms\employeeShow;
use App\Models\Jobposition;

use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class HistorialLaboral extends Component
{
    use Toast;
    use WithPagination;

    public employeeCreateForm $employeeCreate;
    public employeeEditForm $employeeEdit;
    public employeeShow $employeeShow;

    public $deleteModal = false;

    public $trabajadores;
    public $trabajador;

    public function create()
    {
        $this->employeeCreate->create();
    }

    public function store()
    {
        $this->employeeCreate->save();
        $this->success('Historial laboral creado correctamente');

        $this->resetPage();

        // event(new EmailNotification('historial-laboral', ['employee' => $this->employeeCreate->employee]));
    }

    public function show($id)
    {
        $this->employeeShow->show($id);
    }

    public function edit($id)
    {
        $this->employeeEdit->edit($id);
    }

    public function update()
    {
        $this->employeeEdit->update();
        $this->success('Historial laboral actualizado correctamente');
    }

    public function destroyModal($id)
    {
        $this->deleteModal = true;
        $this->trabajador = Jobposition::find($id);
    }

    public function destroy() {}


    public function mount()
    {
        // Cargamos los datos necesarios, de todos los trabajadores
        $this->trabajadores = Jobposition::all();
    }

    public function render()
    {
        return view('livewire.usuarios.historial-laboral');
    }
}
