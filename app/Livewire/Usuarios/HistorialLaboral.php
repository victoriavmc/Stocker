<?php

namespace App\Livewire\Usuarios;

use Livewire\Component;

class HistorialLaboral extends Component
{

    public $createModal = false;
    public $showModal = false;
    public $editModal = false;

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

    public function render()
    {
        return view('livewire.usuarios.historial-laboral');
    }
}
