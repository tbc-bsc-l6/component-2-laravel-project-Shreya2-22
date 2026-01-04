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
        // OPTIMIZED: Eager load module to prevent N+1 when displaying enrollment list
        $this->enrollments = $user->enrollments()
            ->where('status', 'enrolled')
            ->with('module')
            ->get();
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
        // OPTIMIZED: Refresh with eager loading
        $this->enrollments = $user->enrollments()
            ->where('status', 'enrolled')
            ->with('module')
            ->get();
        session()->flash('message', 'Enrolled successfully!');
    }

    public function render()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $userRole = $user->userRole->role;
        
        // OPTIMIZED: Eager load module relationship
        $completedEnrollments = $user->enrollments()
            ->where('status', 'completed')
            ->with('module')
            ->paginate(5, ['*'], 'completedPage');
        
        // OPTIMIZED: Get enrolled IDs efficiently, then use withCount for enrollment stats
        $enrolledModuleIds = $user->enrollments()->pluck('module_id')->toArray();
        $availableModules = Module::where('active', true)
            ->whereNotIn('id', $enrolledModuleIds)
            ->withCount(['enrollments as enrolled_count' => function ($q) {
                $q->where('status', 'enrolled');
            }])
            ->when($this->searchAvailable, fn($q) => $q->where('module', 'like', '%' . $this->searchAvailable . '%'))
            ->paginate(5, ['*'], 'availablePage');
        
        // OPTIMIZED: Calculate stats with efficient count queries
        $passCount = $user->enrollments()->where('grade', 'PASS')->count();
        $completedCount = $user->enrollments()->where('status', 'completed')->count();
        $passRate = $completedCount > 0 ? round(($passCount / $completedCount) * 100) : 0;
        
        return view('livewire.student-dashboard', compact(
            'userRole', 'completedEnrollments', 'availableModules', 'passRate', 'completedCount'
        ));
    }
}