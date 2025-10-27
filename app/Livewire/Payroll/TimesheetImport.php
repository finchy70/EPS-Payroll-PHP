<?php

namespace App\Livewire\Payroll;

use App\Models\Employee;
use App\Models\Period;
use App\Traits\ImportTimesheetTrait;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;
use Livewire\Component;

class TimesheetImport extends Component
{
    public ?string $periodString = "";
    public ?Period $period;
    public ?string $employeeName = "";
    public array $apiErrors = [];
    public array $missingData = [];

    use ImportTimesheetTrait;

    public function mount(): void
    {
        $this->period = Period::query()->where('current', true)->first();
        $this->periodString = $this->period->month.'-'.$this->period->year;
    }

    public function importAllTimesheets(): void
    {
        $this->modal('import-timesheets')->show();
    }

    public function cancelTimesheetImport(): void
    {
        $this->modal('import-timesheets')->close();
    }

    /**
     * @throws ConnectionException
     */
    public function confirmTimesheetImport(): void
    {
        $this->importTimesheets();
    }

    /**
     * @throws ConnectionException
     */
    public function getTimesheetViaApi($empNumber, $weekending): array
    {
        $responseData =  Http::acceptJson()->withToken('1|1ANoybfvxu3lMEFJCt6uWps75eHLER1s360l2Sk3f5f46cc8')->post(config('app.timesheet_endpoint'),['user_emp_no' => $empNumber, 'weekending' => $weekending]);
        if($responseData->status() == 200){
            $data = json_decode($responseData->body(), true);
            if($data['status'] == 'success'){
                return ['exists' => 'exists', 'data' => $data];
            } elseif($data['status'] == 'missing') {
                $missingData = ['user_emp_no' => $empNumber, 'weekending' => $weekending];
                return ['exists' => 'missing', 'data' =>  $missingData];
            }
        }
        return ['exists' => 'error', 'emp_no' => $empNumber, 'weekending' => $weekending];
    }

    /**
     * @throws ConnectionException
     */
    private function importTimesheets(): void
    {
        $employees = Employee::query()->where('current', true)->where('emp_no', '!=', null)->orderBy('id')->get();
        $this->missingData = [];
        $this->apiErrors = [];
        foreach ($employees as $employee) {
            $result = $this->getTimesheetViaApi($employee->emp_no, $this->period->we1);
            if ($result['exists'] == 'exists') {
                $timesheetWeek1Hours = $result['data']['timesheet'];
                $this->populateFromTimesheet(collect($timesheetWeek1Hours), Carbon::parse($this->period->we1), 1);
            } elseif ($result['exists'] == 'missing') {
                $this->missingData[] = [$employee->emp_no, $this->period->we1];
            } elseif ($result['exists'] == 'error') {
                $this->apiErrors[] = [$result['emp_no'], $result['weekending']];
            }
            $result = $this->getTimesheetViaApi($employee->emp_no, $this->period->we2);
            if ($result['exists'] == 'exists') {
                $timesheetWeek2Hours = $result['data']['timesheet'];
                $this->populateFromTimesheet(collect($timesheetWeek2Hours), Carbon::parse($this->period->we2), 1);
            } elseif ($result['exists'] == 'missing') {
                $this->missingData[] = [$employee->emp_no, $this->period->we2];
            } elseif ($result['exists'] == 'error') {
                $this->apiErrors[] = [$result['emp_no'], $result['weekending']];
            }
            $result = $this->getTimesheetViaApi($employee->emp_no, $this->period->we3);
            if ($result['exists'] == 'exists') {
                $timesheetWeek3Hours = $result['data']['timesheet'];
                $this->populateFromTimesheet(collect($timesheetWeek3Hours), Carbon::parse($this->period->we3), 1);
            } elseif ($result['exists'] == 'missing') {
                $this->missingData[] = [$employee->emp_no, $this->period->we3];
            } elseif ($result['exists'] == 'error') {
                $this->apiErrors[] = [$result['emp_no'], $result['weekending']];
            }
            $result = $this->getTimesheetViaApi($employee->emp_no, $this->period->we4);
            if ($result['exists'] == 'exists') {
                $timesheetWeek4Hours = $result['data']['timesheet'];
                $this->populateFromTimesheet(collect($timesheetWeek4Hours), Carbon::parse($this->period->we4), 1);
            } elseif ($result['exists'] == 'missing') {
                $this->missingData[] = [$employee->emp_no, $this->period->we4];
            } elseif ($result['exists'] == 'error') {
                $this->apiErrors[] = [$result['emp_no'], $result['weekending']];
            }
            if ($this->period->we5 != null) {
                $result = $this->getTimesheetViaApi($employee->emp_no, $this->period->we5);
                if ($result['exists'] == 'exists') {
                    $timesheetWeek5Hours = $result['data']['timesheet'];
                    $this->populateFromTimesheet(collect($timesheetWeek5Hours), Carbon::parse($this->period->we5), 1);
                } elseif ($result['exists'] == 'missing') {
                    $this->missingData[] = [$employee->emp_no, $this->period->we5];
                } elseif ($result['exists'] == 'error') {
                    $this->apiErrors[] = [$result['emp_no'], $result['weekending']];
                }
            }
        }
        // Use $missingEmployees and $missingWeeks to provide feedback.
        $this->modal('import-timesheets')->close();
        flash()->success('Timesheets Imported Successfully.');
        $this->redirect(route('payroll-select'));
    }

    public function back(): void
    {
        $this->redirect(route('hours-select-employee'));
    }

    public function render(): Application|Factory|View
    {
        return view('livewire.payroll.timesheet-import');
    }
}
