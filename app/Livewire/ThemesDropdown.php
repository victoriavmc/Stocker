<?php

namespace App\Livewire;

use Livewire\Component;

class ThemesDropdown extends Component
{
    public $selectedTheme;

    public function mount()
    {
        $this->selectedTheme = session('theme', 'light');
    }

    public function updatedSelectedTheme($value)
    {
        session(['theme' => $value]);
    }

    public function render()
    {
        return view('livewire.themes-dropdown');
    }
}
