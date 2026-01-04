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
        // OPTIMIZED: Eager load enrollment counts to avoid N+1 queries
        $this->assignedModules = Auth::user()->taughtModules()
            ->withCount(['enrollments as enrolled_count' => function ($q) {
                $q->where('status', 'enrolled');
            }])
            ->get();
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
        $totalStudents = 0;
        $pendingGrades = 0;
        
        // OPTIMIZED: Calculate stats from already-loaded data (no extra queries)
        foreach ($this->assignedModules as $module) {
            $totalStudents += $module->enrolled_count ?? 0;
        }
        
        if ($this->selectedModule) {
            // OPTIMIZED: Eager load user.userRole to prevent N+1
            $query = Enrollment::where('module_id', $this->selectedModule)
                ->where('status', 'enrolled')
                ->with('user.userRole');
            
            // Apply search filter
            if ($this->searchStudents) {
                $query->whereHas('user', function($q) {
                    $q->where('name', 'like', '%' . $this->searchStudents . '%')
                      ->orWhere('email', 'like', '%' . $this->searchStudents . '%');
                });
            }
            
            $studentsInModule = $query->paginate(10, ['*'], 'studentsPage');
            
            // Count pending grades for selected module
            $pendingGrades = Enrollment::where('module_id', $this->selectedModule)
                ->where('status', 'enrolled')
                ->count();
        }
        
        return view('livewire.teacher-dashboard', compact('studentsInModule', 'totalStudents', 'pendingGrades'));
    }
}