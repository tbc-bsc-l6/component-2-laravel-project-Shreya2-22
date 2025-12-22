<?php
namespace App\Livewire\Admin;
use App\Models\Course;
use Livewire\Component;

class AddModule extends Component
{
    public $name;
    protected $rules = ['name' => 'required|string|max:255|unique:courses'];

    public function addModule()
    {
        $this->validate();
        Course::create(['name' => $this->name, 'available' => true]);
        session()->flash('message', 'Module added successfully.');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.add-module');
    }
}