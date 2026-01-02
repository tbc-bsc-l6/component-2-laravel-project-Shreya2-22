<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth; // Add this import

class LoginUser extends Component
{
    public $email;
    public $password;

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) { // Change auth() to Auth::
            session()->regenerate();
            return redirect()->intended('/');
        }

        session()->flash('error', 'Invalid credentials.');
    }

    public function render()
    {
        return view('livewire.login-user');
    }
}