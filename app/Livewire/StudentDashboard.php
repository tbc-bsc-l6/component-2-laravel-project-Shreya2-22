<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Module;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class StudentDashboard extends Component
{
    public $enrollments, $availableModules, $completedEnrollments;

    public function mount()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $this->enrollments = $user->enrollments()->where('status', 'enrolled')->get(); // Current enrollments
        $this->completedEnrollments = $user->enrollments()->where('status', 'completed')->get(); // Completed history
        $this->availableModules = Module::where('active', true)
            ->whereNotIn('id', $user->enrollments()->pluck('module_id'))
            ->get(); // Available modules not enrolled in
    }

    // Enroll in a module (max 4, only if active and not already enrolled)
    public function enroll($moduleId)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($user->enrollments()->where('status', 'enrolled')->count() >= 4) {
            session()->flash('error', 'You can only enroll in a maximum of 4 modules.');
            return;
        }
        if ($user->enrollments()->where('module_id', $moduleId)->exists()) {
            session()->flash('error', 'You are already enrolled in this module.');
            return;
        }
        Enrollment::create([
            'user_id' => $user->id,
            'module_id' => $moduleId,
            'status' => 'enrolled',
            'enrolled_at' => now(),
        ]);
        $this->mount(); // Refresh data
        session()->flash('message', 'Enrolled successfully!');
    }

    public function render()
    {
        $userRole = Auth::user()->userRole->role; // Access role through the userRole relationship
        return view('livewire.student-dashboard', compact('userRole'));
    }
}