<?php

namespace App\Livewire\Setup;

use App\Models\Employee;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class NewStarter extends Component
{
    public string $name = "";
    public string $company = "";

    public ?int $employeeNumber = null;

    public function save(): void
    {
        $data = $this->validate([
            'name' => 'required|string|min:4|max:255',
            'company' => 'required|string',
            'employeeNumber' => 'required|integer|min:1|max:9999|unique:mysql.employees,emp_no'
        ]);
        Employee::create([
            'name' => $data['name'],
            'company' => $data['company'],
            'emp_no' => $data['employeeNumber'],
            'current' => true,
        ]);
        flash()->success("New Starter ".$data['name']." has been created.");
        $this->redirect(route('setup.menu'));
    }

    public function back(): void
    {
        $this->redirect(route('setup.menu'));
    }
    public function render(): View|Application|\Illuminate\View\View
    {
        return view('livewire.setup.new-starter');
    }
}
