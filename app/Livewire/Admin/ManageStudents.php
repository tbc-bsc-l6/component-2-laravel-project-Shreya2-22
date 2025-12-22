<?php

namespace App\Livewire\Admin;

use App\Models\Enrollment;
use App\Models\Course;
use Livewire\Component;

class ManageStudents extends Component
{
    public $selectedCourseId;
    public $enrollments;

    public function mount()
    {
        $this->loadEnrollments();
    }

    public function loadEnrollments()
    {
        if ($this->selectedCourseId) {
            $this->enrollments = Enrollment::with('user', 'course')->where('course_id', $this->selectedCourseId)->get();
        } else {
            $this->enrollments = collect();
        }
    }

    public function updatedSelectedCourseId()
    {
        $this->loadEnrollments();
    }

    public function removeStudent($enrollmentId)
    {
        Enrollment::find($enrollmentId)->delete();
        session()->flash('message', 'Student removed from module.');
        $this->loadEnrollments();
    }

    public function render()
    {
        $courses = Course::all();
        return view('livewire.admin.manage-students', compact('courses'));
    }
}