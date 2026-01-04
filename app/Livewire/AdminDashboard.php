<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Module;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Enrollment;

class AdminDashboard extends Component {
    use WithPagination;

    public $newModule = '', $selectedUser, $newRole, $selectedModule, $selectedTeacher;
    public $searchModules = '', $searchUsers = '', $searchEnrollments = '';

    // Reset pagination when search changes
    public function updatedSearchModules() {
        $this->resetPage('modulesPage');
    }

    public function updatedSearchUsers() {
        $this->resetPage('usersPage');
    }

    public function updatedSearchEnrollments() {
        $this->resetPage('enrollmentsPage');
    }

    public function mount() {
        // No longer preloading data
    }

    public function loadData() {
        // Kept for compatibility with flash messages but data is now loaded in render()
    }

    // Add a new module
    public function addModule() {
        $this->validate(['newModule' => 'required|string|unique:modules,module']);
        Module::create(['module' => $this->newModule, 'active' => true]);
        $this->newModule = '';
        $this->loadData();
        session()->flash('message', 'Module added successfully!');
    }

    // Toggle module active status
    public function toggleModule($id) {
        $module = Module::find($id);
        $module->update(['active' => !$module->active]);
        $this->loadData();
        session()->flash('message', 'Module status updated!');
    }

    // Change a user's role
    public function changeRole($userId, $roleId) {
        User::find($userId)->update(['user_role_id' => $roleId]);
        $this->loadData();
        session()->flash('message', 'User role updated!');
    }

    // Remove a student from a module
    public function removeStudentFromModule($enrollmentId) {
        Enrollment::find($enrollmentId)->delete();
        $this->loadData();
        session()->flash('message', 'Student removed from module!');
    }

    // Attach a teacher to a module
    public function attachTeacher($moduleId, $teacherId) {
        $module = Module::find($moduleId);
        if (!$module->teachers()->where('user_id', $teacherId)->exists()) {
            $module->teachers()->attach($teacherId);
            $this->loadData();
            session()->flash('message', 'Teacher attached to module!');
        } else {
            session()->flash('message', 'Teacher already attached!');
        }
    }

    // Detach a teacher from a module
    public function detachTeacher($moduleId, $teacherId) {
        $module = Module::find($moduleId);
        $module->teachers()->detach($teacherId);
        $this->loadData();
        session()->flash('message', 'Teacher detached from module!');
    }

    // Attach teacher to module via form
    public function attachTeacherForm() {
        $this->validate(['selectedTeacher' => 'required', 'selectedModule' => 'required']);
        $module = Module::find($this->selectedModule);
        if (!$module->teachers()->where('user_id', $this->selectedTeacher)->exists()) {
            $module->teachers()->attach($this->selectedTeacher);
            $this->loadData();
            session()->flash('message', 'Teacher attached to module successfully!');
        } else {
            session()->flash('message', 'Teacher already attached to this module!');
        }
    }

    public function render() {
        // OPTIMIZED: Cache roles query (small table, rarely changes)
        $roles = UserRole::all();
        
        // OPTIMIZED: Eager load userRole to prevent N+1 when displaying teacher names
        $teachers = User::whereHas('userRole', fn($q) => $q->where('role', 'teacher'))
            ->with('userRole')
            ->get();
        
        // OPTIMIZED: Eager load teachers + count active enrollments in ONE query
        $modules = Module::with('teachers')
            ->withCount(['enrollments as enrolled_count' => function ($q) {
                $q->where('status', 'enrolled');
            }])
            ->when($this->searchModules, fn($q) => $q->where('module', 'like', '%' . $this->searchModules . '%'))
            ->paginate(5, ['*'], 'modulesPage');
        
        // OPTIMIZED: Already has eager loading for userRole
        $users = User::with('userRole')
            ->when($this->searchUsers, fn($q) => $q->where('name', 'like', '%' . $this->searchUsers . '%')
                ->orWhere('email', 'like', '%' . $this->searchUsers . '%'))
            ->paginate(10, ['*'], 'usersPage');
        
        // OPTIMIZED: Eager load nested relationships (user.userRole) to prevent N+1
        $enrollments = Enrollment::with(['user.userRole', 'module'])
            ->when($this->searchEnrollments, function($q) {
                $q->whereHas('user', fn($q2) => $q2->where('name', 'like', '%' . $this->searchEnrollments . '%'))
                  ->orWhereHas('module', fn($q2) => $q2->where('module', 'like', '%' . $this->searchEnrollments . '%'));
            })
            ->paginate(10, ['*'], 'enrollmentsPage');
        
        // OPTIMIZED: Use COUNT queries instead of loading all records
        $totalModules = Module::count();
        $totalUsers = User::count();
        $activeEnrollments = Enrollment::where('status', 'enrolled')->count();
        $totalTeachers = User::whereHas('userRole', fn($q) => $q->where('role', 'teacher'))->count();
        
        return view('livewire.admin-dashboard', compact(
            'roles', 'teachers', 'modules', 'users', 'enrollments',
            'totalModules', 'totalUsers', 'activeEnrollments', 'totalTeachers'
        ));
    }
}