<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    protected $layout = 'components.layouts.app';

    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
    ];

    public function register()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'user_role_id' => 3, // Default to Student
        ]);

        session()->flash('message', 'Registration successful! Please login.');
        return redirect('/login');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}