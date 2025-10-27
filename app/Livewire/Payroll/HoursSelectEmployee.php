<?php

namespace App\Livewire\Payroll;

use App\Models\Employee;
use App\Models\Period;
use App\Traits\PeriodFunctionsTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class HoursSelectEmployee extends Component
{
    public array $employees = [];
    public ?string $selectedWeekEnding = null;
    public array $weeks = [];
    public Period $period;

    public ?int $selectedEmployee = null;

    use PeriodFunctionsTrait;

    public function mount():void
    {
        $this->period = Period::query()->where('current', true)->first();
        $this->weeks = $this->setPeriod($this->period);
    }
    public function viewHours():void
    {
        $this->validate([
            'selectedEmployee' => 'required',
            'selectedWeekEnding' => 'required',
        ]);
        $data = ['selectedEmployee' => $this->selectedEmployee, 'selectedWeekEnding' => $this->selectedWeekEnding];
        $data = encrypt($data);
        $this->redirect(route('payroll-entry', $data));
    }
    public function render(): View|Application|\Illuminate\View\View
    {
        $this->employees = Employee::query()->where('current', true)->where('emp_no', '!=',null)->get()->toArray();
        return view('livewire.payroll.hours-select-employee');
    }
}
