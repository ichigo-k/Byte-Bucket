<?php


use App\Livewire\CreateBucket;
use App\Livewire\Dashboard;
use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Signup;
use App\Livewire\VerifyEmail;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get("/", Login::class)->name('login');
    Route::get("/signup", Signup::class)->name('register');
});


Route::get("/email-verify/{token?}", VerifyEmail::class)->name('verify.email');
Route::get("/email-verify/{token?}", VerifyEmail::class)->name('verification.notice');



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/bucket/new', CreateBucket::class)->name('create.bucket');
});
