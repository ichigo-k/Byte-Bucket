<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[layout("components.layouts.auth")]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard');
    }
}
