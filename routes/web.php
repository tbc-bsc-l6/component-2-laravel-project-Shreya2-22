<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', Login::class)->name('login');

Route::get('/register', Register::class)->name('register');

use Illuminate\Support\Facades\Auth;

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
