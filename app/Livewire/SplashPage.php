<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class SplashPage extends Component
{
    public function mount()
    {
        if (Auth::check()) {
            $role = Auth::user()->userRole->role;
            if ($role === 'admin') {
                return redirect('/admin');
            } elseif ($role === 'teacher') {
                return redirect('/teacher'); 
            }
            elseif ($role === 'student' || $role === 'old_student') {
                return redirect('/student'); // Add this for students
            }
            
        }
    }

    public function render()
    {
        return view('livewire.splash-page');
    }
}