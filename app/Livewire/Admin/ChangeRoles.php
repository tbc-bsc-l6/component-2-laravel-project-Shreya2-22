<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\UserRole;
use Livewire\Component;

class ChangeRoles extends Component
{
    public $users;
    public $selectedUserId;
    public $newRoleId;

    public function mount()
    {
        $this->users = User::with('role')->get();
    }

    public function changeRole()
    {
        $this->validate([
            'selectedUserId' => 'required',
            'newRoleId' => 'required',
        ]);

        User::find($this->selectedUserId)->update(['user_role_id' => $this->newRoleId]);
        session()->flash('message', 'User role changed.');
        $this->reset(['selectedUserId', 'newRoleId']);
        $this->mount();
    }

    public function render()
    {
        $roles = UserRole::all();
        return view('livewire.admin.change-roles', compact('roles'));
    }
}