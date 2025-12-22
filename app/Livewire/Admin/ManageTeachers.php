<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ManageTeachers extends Component
{
    public $name;
    public $email;
    public $password;
    public $teachers;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8',
    ];

    public function mount()
    {
        $this->loadTeachers();
    }

    public function loadTeachers()
    {
        $this->teachers = User::where('user_role_id', 2)->get();
    }

    public function addTeacher()
    {
        $this->validate();
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'user_role_id' => 2, // Teacher
        ]);
        session()->flash('message', 'Teacher added successfully.');
        $this->reset(['name', 'email', 'password']);
        $this->loadTeachers();
    }

    public function removeTeacher($teacherId)
    {
        User::find($teacherId)->delete();
        session()->flash('message', 'Teacher removed successfully.');
        $this->loadTeachers();
    }

    public function render()
    {
        return view('livewire.admin.manage-teachers');
    }
}