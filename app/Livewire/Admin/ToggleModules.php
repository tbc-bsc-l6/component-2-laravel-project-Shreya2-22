<?php

namespace App\Livewire\Admin;

use App\Models\Course;
use Livewire\Component;

class ToggleModules extends Component
{
    public $courses;

    public function mount()
    {
        $this->courses = Course::all();
    }

    public function toggleAvailability($courseId)
    {
        $course = Course::find($courseId);
        $course->update(['available' => !$course->available]);
        session()->flash('message', 'Module availability toggled.');
        $this->mount();
    }

    public function render()
    {
        return view('livewire.admin.toggle-modules');
    }
}