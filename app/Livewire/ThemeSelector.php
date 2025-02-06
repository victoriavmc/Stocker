<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ThemeSelector extends Component
{
    public $theme;

    public function mount()
    {
        $this->theme = session('theme', 'light'); // Cargar tema desde la sesión
    }

    public function updatedTheme($value)
    {
        session(['theme' => $value]); // Guardar tema en la sesión
        $this->dispatchBrowserEvent('theme-updated', ['theme' => $value]); // Emitir evento JS
    }

    public function render()
    {
        return view('livewire.theme-selector');
    }
}
