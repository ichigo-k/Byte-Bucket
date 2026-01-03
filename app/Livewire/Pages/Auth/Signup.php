<?php

namespace App\Livewire\Pages\Auth;
use App\Mail\VerifyMail;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;

use Livewire\Attributes\Validate;
use Livewire\Component;

#[layout("components.layouts.app")]
class Signup extends Component
{

    #[Validate('required|string|min:2')]
    public string $firstname = '';

    #[Validate('required|string|min:2')]
    public string $lastname = '';

    #[Validate('required|email|unique:users,email')]
    public string $email = '';

    #[Validate('required|min:7')]
    public string $password = '';


    public function signUp(): void
    {

        $this->validate();

        DB::transaction(function () {


            $user = User::create([
                'first_name' => $this->firstname,
                'last_name'  => $this->lastname,
                'email'      => $this->email,
                'password'   => Hash::make($this->password),
                'email_verification_token' => Str::random(64),
                'email_verification_token_expires_at' => now()->addMinutes(30),
            ]);
            Auth::login($user);
            Mail::to($user->email)->send(new VerifyMail($user));
            Storage::disk('s3')->put('users/'.$user->id.'/buckets/', '');

        });

        session()->flash('success', 'Account created successfully. Please check your email to verify your account.');
        $this->reset();
    }



    public function render(): View
    {
        return view('livewire.pages.auth.signup');
    }
}
