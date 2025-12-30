<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Module;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Enrollment;

class AdminDashboard extends Component {
    public $modules, $users, $enrollments, $newModule = '', $selectedUser, $newRole, $selectedModule, $selectedTeacher;

    public function mount() {
        $this->loadData();
    }

    public function loadData() {
        $this->modules = Module::with('teachers')->get();
        $this->users = User::with('userRole')->get();
        $this->enrollments = Enrollment::with('user', 'module')->get();
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
        $roles = UserRole::all();
        $teachers = User::whereHas('userRole', fn($q) => $q->where('role', 'teacher'))->get();
        return view('livewire.admin-dashboard', compact('roles', 'teachers'));
    }
}