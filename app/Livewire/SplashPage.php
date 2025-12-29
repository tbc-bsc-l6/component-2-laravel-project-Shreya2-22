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
            }
            // Add redirects for other roles here as needed
        }
    }

    public function render()
    {
        return view('livewire.splash-page');
    }
}