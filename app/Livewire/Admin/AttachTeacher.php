<?php

namespace App\Livewire\Admin;

use App\Models\Course;
use App\Models\User;
use Livewire\Component;

class AttachTeacher extends Component
{
    public $selectedCourseId;
    public $selectedTeacherId;

    public function attachTeacher()
    {
        $this->validate([
            'selectedCourseId' => 'required',
            'selectedTeacherId' => 'required',
        ]);

        Course::find($this->selectedCourseId)->update(['teacher_id' => $this->selectedTeacherId]);
        session()->flash('message', 'Teacher attached to module.');
        $this->reset();
    }

    public function render()
    {
        $courses = Course::all();
        $teachers = User::where('user_role_id', 2)->get();
        return view('livewire.admin.attach-teacher', compact('courses', 'teachers'));
    }
}