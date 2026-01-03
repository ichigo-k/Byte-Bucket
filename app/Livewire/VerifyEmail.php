<?php

namespace App\Livewire;

use App\Mail\VerifyMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Str;

#[Layout('components.layouts.app')]
class VerifyEmail extends Component
{
    public ?string $token = null;

    public bool $verified = false;
    public bool $invalid = false;
    public bool $loading = false;
    public string $statusMessage = '';

    public function mount(?string $token = null)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to continue.');
        }

        $this->token = $token;

        $user = Auth::user();


        if ($user->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }


        if (!$this->token) {
            $this->loading = false;
            return;
        }


        $this->loading = true;
        $this->verifyEmail();

        return 0;
    }

    public function verifyEmail(): void
    {
        $user = Auth::user()->fresh();


        if ($user->email_verification_token !== $this->token) {
            $this->invalid = true;
            $this->loading = false;
            return;
        }


        if ($user->email_verification_token_expires_at &&
            $user->email_verification_token_expires_at->isPast()) {


            $user->update([
                'email_verification_token' => null,
                'email_verification_token_expires_at' => null,
            ]);

            $this->invalid = true;
            $this->loading = false;
            return;
        }


        $user->update([
            'email_verified_at' => now(),
            'email_verification_token' => null,
            'email_verification_token_expires_at' => null,
        ]);

        $this->verified = true;
        $this->loading = false;
    }

    public function resendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->statusMessage = 'Your email is already verified.';
            return;
        }

        $newToken = Str::random(64);
        $user->update(['email_verification_token' => $newToken, 'email_verification_token_expires_at' => now()->addMinutes(30)]);

        Mail::to($user->email)->send(new VerifyMail($user));

        $this->statusMessage = 'Verification email sent! Check your inbox (and spam folder).';
    }

    public function render()
    {
        return view('livewire.verify-email');
    }
}
