<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Module;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class StudentDashboard extends Component
{
    use WithPagination;

    public $enrollments;
    public $searchAvailable = '';

    public function updatedSearchAvailable() {
        $this->resetPage('availablePage');
    }

    public function mount()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $this->enrollments = $user->enrollments()->where('status', 'enrolled')->get(); // Current enrollments
    }

    public function enroll($moduleId)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $module = Module::find($moduleId);
        
        // Check max 4 enrollments for user
        if ($user->enrollments()->where('status', 'enrolled')->count() >= 4) {
            session()->flash('error', 'You can only enroll in a maximum of 4 modules.');
            return;
        }
        
        // Check if already enrolled
        if ($user->enrollments()->where('module_id', $moduleId)->exists()) {
            session()->flash('error', 'You are already enrolled in this module.');
            return;
        }
        
        // Check if module is active
        if (!$module->active) {
            session()->flash('error', 'This module is not available for enrollment.');
            return;
        }
        
        // Check max 10 students per module
        if ($module->enrollments()->where('status', 'enrolled')->count() >= 10) {
            session()->flash('error', 'This module has reached the maximum enrollment limit of 10 students.');
            return;
        }
        
        Enrollment::create([
            'user_id' => $user->id,
            'module_id' => $moduleId,
            'status' => 'enrolled',
            'enrolled_at' => now(),
        ]);
        // Refresh current enrollments
        $this->enrollments = $user->enrollments()->where('status', 'enrolled')->get();
        session()->flash('message', 'Enrolled successfully!');
    }

    public function render()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $userRole = $user->userRole->role;
        
        // Paginated completed enrollments
        $completedEnrollments = $user->enrollments()
            ->where('status', 'completed')
            ->with('module')
            ->paginate(5, ['*'], 'completedPage');
        
        // Available modules with search and pagination
        $enrolledModuleIds = $user->enrollments()->pluck('module_id')->toArray();
        $availableModules = Module::where('active', true)
            ->whereNotIn('id', $enrolledModuleIds)
            ->when($this->searchAvailable, fn($q) => $q->where('module', 'like', '%' . $this->searchAvailable . '%'))
            ->paginate(5, ['*'], 'availablePage');
        
        return view('livewire.student-dashboard', compact('userRole', 'completedEnrollments', 'availableModules'));
    }
}