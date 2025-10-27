<?php

namespace App\Livewire\Payroll;

use App\Models\Employee;
use App\Models\Period;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;

class EmployeeSelect extends Component
{
    public array $employees = [];
    public array $weeks = [];
    public string $periodString = '';
    public string $selectedEmployee = '';
    public string $selectedWeek = '';
    public ?Period $period = null;

    public function mount(): void
    {
        $this->employees = Employee::query()->select('id','emp_no','name')->where('current', true)->orderBy('name')->get()->toArray();
        $this->period = Period::query()->where('current', true)->first();
        $this->periodString = $this->period['month'].'-'.$this->period['year'];
        $this->weeks[] = ['id' => '1', 'week' => Carbon::parse($this->period->we1)->format('d-m-Y')];
        $this->weeks[] = ['id' => '2', 'week' => Carbon::parse($this->period->we2)->format('d-m-Y')];
        $this->weeks[] = ['id' => '3', 'week' => Carbon::parse($this->period->we3)->format('d-m-Y')];
        $this->weeks[] = ['id' => '4', 'week' => Carbon::parse($this->period->we4)->format('d-m-Y')];
        if($this->period->wc5 != null){
            $this->weeks[] = ['id' => '5', 'week' => Carbon::parse($this->period->we5)->format('d-m-Y')];
        }
    }

    public function select()
    {
        if($this->selectedEmployee == "" || $this->selectedWeek == ""){
            flash()->option('position', 'bottom-right')->error('Please select an employee and a week commencing.');
        }
        //Code here to redirect to hours entry with week and employee attributes.
        return redirect(route('payroll-entry', encrypt(['period' => $this->period->id, 'employee' => $this->selectedEmployee, 'week' => $this->selectedWeek])));
    }

    public function back(): void
    {
        $this->redirect(route('welcome'));
    }

    public function render(): View|Application|\Illuminate\View\View
    {
        return view('livewire.payroll.employee-select');
    }
}
