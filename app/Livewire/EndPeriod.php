<?php

namespace App\Livewire;

use App\Models\Employee;
use App\Models\Hours;
use App\Models\Period;
use Carbon\Carbon;
use Flux\Flux;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class EndPeriod extends Component
{
    public string $period = '';
    public ?string $lastWeek = null;
    public ?string $weekEnding1 = '';
    public ?string $weekEnding2 = '';
    public ?string $weekEnding3 = '';
    public ?string $weekEnding4 = '';
    public ?string $weekEnding5 = '';
    public ?string $periodMonth = '';
    public ?int $periodYear;
    public ?int $numberOfWeeks = null;
    public bool $addYear = false;

    public function mount(): void{
        $period = Period::query()->where('current', 1)->first();
        $this->period = $period->month.'-'.$period->year;
        $this->periodMonth = $period->month;
        $this->periodYear = intval($period->year);
        $this->lastWeek = ($period->we5 == null) ? $period->we4 : $period->we5;
    }

    public function endPeriod(): void
    {
        Flux::modal('end-period-modal')->show();
    }

    public function updatedNumberOfWeeks(): void
    {
        $this->resetErrorBag('numberOfWeeks');
        $this->weekEnding1 = Carbon::parse($this->lastWeek)->addWeek()->format('Y-m-d');
        $this->weekEnding2 = Carbon::parse($this->lastWeek)->addWeeks(2)->format('Y-m-d');
        $this->weekEnding3 = Carbon::parse($this->lastWeek)->addWeeks(3)->format('Y-m-d');
        $this->weekEnding4 = Carbon::parse($this->lastWeek)->addWeeks(4)->format('Y-m-d');
        if($this->numberOfWeeks == 5) {
            $this->weekEnding5 = Carbon::parse($this->lastWeek)->addWeeks(5)->format('Y-m-d');
        } elseif($this->numberOfWeeks == 4) {
            $this->weekEnding5 = null;
        }
    }

    public function saveNewPeriod(): void
    {
        $this->validate([
            'numberOfWeeks' => 'required',
        ]);
        $oldPeriod = Period::query()->where('current', 1)->first();
        $newPeriod = new Period();
        $newPeriod->month = $this->getPeriodText($oldPeriod->month);
        $newPeriod->year = $this->addYear ? $oldPeriod->year + 1 : $oldPeriod->year;
        $newPeriod->we1 = $this->weekEnding1;
        $newPeriod->we2 = $this->weekEnding2;
        $newPeriod->we3 = $this->weekEnding3;
        $newPeriod->we4 = $this->weekEnding4;
        $newPeriod->current = 1;
        if($this->numberOfWeeks == 5)
        {
            $newPeriod->we5 = $this->weekEnding5;
        }
        $oldPeriod->current = false;
        $oldPeriod->update();
        $newPeriod->save();
        Flux::modal('end-period-modal')->close();
//        $this->populateHoursForNewPeriod();
        flash()->option('position', 'bottom-right')->success('Period Ended Successfully.');
        $this->redirect(route('setup.menu'));
    }

    private function populateHoursForNewPeriod(): void
    {
        $period = Period::query()->where('current', 1)->first();
        $employees = Employee::query()->orderBy('emp_no')->get();
        foreach($employees as $employee)
        {
            $this->setHoursForEmployee($employee, $period);
        }
    }

    public function setHoursForEmployee(Employee $employee, Period $period): void
    {
        Hours::query()->create([
            'week_commencing' => $period->wc1,
            'employee' => $employee->name,
            'emp_no' => $employee->emp_no,
            'period' => $period->id
        ]);
        Hours::query()->create([
            'week_commencing' => $period->we2,
            'employee' => $employee->name,
            'emp_no' => $employee->emp_no,
            'period' => $period->id
        ]);
        Hours::query()->create([
            'week_commencing' => $period->we3,
            'employee' => $employee->name,
            'emp_no' => $employee->emp_no,
            'period' => $period->id
        ]);
        Hours::query()->create([
            'week_commencing' => $period->we4,
            'employee' => $employee->name,
            'emp_no' => $employee->emp_no,
            'period' => $period->id
        ]);
        if($period->wc5 != null)
        {
            Hours::query()->create([
                'week_commencing' => $period->we5,
                'employee' => $employee->name,
                'emp_no' => $employee->emp_no,
                'period' => $period->id
            ]);
        }
    }

    private function getPeriodText(string $month): string
    {
        switch($month) {
            case 'January':
                return 'February';
            case 'February':
                return 'March';
            case 'March':
                return 'April';
            case 'April':
                return 'May';
            case 'May':
                return 'June';
            case 'June':
                return 'July';
            case 'July':
                return 'August';
            case 'August':
                return 'September';
            case 'September':
                return 'October';
            case 'October':
                return 'November';
            case 'November':
                return 'December';
            case 'December':
                $this->addYear = true;
                return 'January';
        }
    }

    public function render(): View|Application|\Illuminate\View\View
    {
        return view('livewire.end-period');
    }
}
