<?php

namespace App\Livewire;

use Livewire\Component;

class PageHeading extends Component
{
    public $header;

    public function render()
    {
        return view('livewire.page-heading');
    }
}
