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
    }

    // Change a user's role (e.g., to teacher or student)
    public function changeRole($userId, $roleId) {
        User::find($userId)->update(['user_role_id' => $roleId]);
        $this->loadData();
        session()->flash('message', 'User role updated!');
    }

    // Remove a student from a module (delete enrollment)
    public function removeStudentFromModule($enrollmentId) {
        Enrollment::find($enrollmentId)->delete();
        $this->loadData();
        session()->flash('message', 'Student removed from module!');
    }

    // Attach a teacher to a module
    public function attachTeacher($moduleId, $teacherId) {
        $module = Module::find($moduleId);
        $module->teachers()->attach($teacherId);
        $this->loadData();
        session()->flash('message', 'Teacher attached to module!');
    }

    // Detach a teacher from a module
    public function detachTeacher($moduleId, $teacherId) {
        $module = Module::find($moduleId);
        $module->teachers()->detach($teacherId);
        $this->loadData();
        session()->flash('message', 'Teacher detached from module!');
    }

    public function render() {
        return view('livewire.admin-dashboard');
    }
}