<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Livewire\RegisterUser;
use App\Livewire\LoginUser;
use App\Livewire\SplashPage;
use App\Livewire\AdminDashboard;
use App\Livewire\TeacherDashboard;

Route::get('/', SplashPage::class)->name('splash');

Route::get('/register', RegisterUser::class)->name('register');

Route::get('/login', LoginUser::class)->name('login');

Route::get('/admin', AdminDashboard::class)->middleware('role:admin')->name('admin');

Route::post('/logout', function () {
	Auth::logout();
	request()->session()->invalidate();
	request()->session()->regenerateToken();
	return redirect('/');
})->name('logout');

Route::get('/teacher', TeacherDashboard::class)->middleware('role:teacher')->name('teacher');

