<?php

namespace App\Livewire\Usuarios;

use App\Models\Jobposition;
use Livewire\Component;

class Trabajadores extends Component
{
    // Variable para almacenar los trabajadores
    public $trabajadores;

    // Variable parusuarios.createa almacenar el trabajador seleccionado
    public $trabajador;

    //Datos necesarios para la paginación
    public $idJobposition; // id del trabajador
    public $profile_photo_path; // Foto de perfil
    public $firstName; //Nombre Completo
    public $lastName; //Apellido Completo
    public $position; //Nombre deL area que cubre
    public $startDate; //Nombre del inicio que comenzo a trabajar
    public $status; //Estado del trabajador


    public function mount()
    {
        // Cargamos los datos necesarios, de todos los trabajadores
        $this->trabajadores = Jobposition::all();
    }

    public function render()
    {
        return view('livewire.usuarios.trabajadores');
    }
}
