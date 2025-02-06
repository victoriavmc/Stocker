<?php

namespace App\Livewire\Usuarios;

use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class AsignarPermisos extends Component
{
    public function render()
    {
        return view('livewire.usuarios.asignar-permisos');
    }
}
