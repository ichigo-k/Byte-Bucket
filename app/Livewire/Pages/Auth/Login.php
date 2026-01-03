<?php

namespace App\Livewire\Pages\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[layout("components.layouts.app")]
class Login extends Component
{
    #[validate("required|email")]
    public string $email;

    #[Validate('required')]
    public string $password;

    public function login(): void
    {
        $this->validate();

        Auth::attempt(['email' => $this->email, 'password' => $this->password]);

        $this->redirect(route('dashboard'));

    }
    public function render()
    {
        return view('livewire.pages.auth.login');
    }
}
