<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Module;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth; 

class TeacherDashboard extends Component
{
    public $assignedModules, $selectedModule, $studentsInModule;

    public function mount()
    {
        // Load modules assigned to the current teacher
        $this->assignedModules = Auth::user()->taughtModules;
        $this->selectedModule = $this->assignedModules->first()?->id; // Default to first module
        $this->loadStudents();
    }

    public function loadStudents()
    {
        if ($this->selectedModule) {
            $this->studentsInModule = Enrollment::where('module_id', $this->selectedModule)
                ->where('status', 'enrolled')
                ->with('user')
                ->get();
        } else {
            $this->studentsInModule = collect();
        }
    }

    public function updatedSelectedModule()
    {
        $this->loadStudents();
    }

    public function gradeStudent($enrollmentId, $grade)
    {
        $enrollment = Enrollment::find($enrollmentId);
        $enrollment->update([
            'status' => 'completed',
            'grade' => $grade,
            'completed_at' => now(),
        ]);
        $this->loadStudents(); // Refresh students list
        session()->flash('message', 'Student graded successfully!');
    }

    public function render()
    {
        return view('livewire.teacher-dashboard');
    }
}