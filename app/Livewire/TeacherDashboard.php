<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Module;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth; 

class TeacherDashboard extends Component
{
    use WithPagination;

    public $assignedModules, $selectedModule;
    public $searchStudents = '';

    public function updatedSearchStudents()
    {
        $this->resetPage('studentsPage');
    }

    public function mount()
    {
        // Load modules assigned to the current teacher
        $this->assignedModules = Auth::user()->taughtModules;
        $this->selectedModule = $this->assignedModules->first()?->id; // Default to first module
    }

    public function updatedSelectedModule()
    {
        $this->resetPage('studentsPage');
    }

    public function gradeStudent($enrollmentId, $grade)
    {
        $enrollment = Enrollment::find($enrollmentId);
        $enrollment->update([
            'status' => 'completed',
            'grade' => $grade,
            'completed_at' => now(),
        ]);
        session()->flash('message', 'Student graded successfully!');
    }

    public function render()
    {
        $studentsInModule = collect();
        
        if ($this->selectedModule) {
            $query = Enrollment::where('module_id', $this->selectedModule)
                ->where('status', 'enrolled')
                ->with('user');
            
            // Apply search filter
            if ($this->searchStudents) {
                $query->whereHas('user', function($q) {
                    $q->where('name', 'like', '%' . $this->searchStudents . '%')
                      ->orWhere('email', 'like', '%' . $this->searchStudents . '%');
                });
            }
            
            $studentsInModule = $query->paginate(10, ['*'], 'studentsPage');
        }
        
        return view('livewire.teacher-dashboard', compact('studentsInModule'));
    }
}