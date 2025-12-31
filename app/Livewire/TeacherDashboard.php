<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Module;
use Illuminate\Support\Facades\Auth; // Add this import

class TeacherDashboard extends Component
{
    public $assignedModules;

    public function mount()
    {
        // Load modules assigned to the current teacher
        $this->assignedModules = Auth::user()->modules; // Change to Auth::user()
    }

    public function render()
    {
        return view('livewire.teacher-dashboard');
    }
}