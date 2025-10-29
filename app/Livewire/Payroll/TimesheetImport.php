<?php

namespace App\Livewire\Payroll;

use App\Models\Employee;
use App\Models\Hours;
use App\Models\Period;
use App\Traits\ImportTimesheetTrait;
use App\Traits\PayrollEntryTrait;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Component;

class TimesheetImport extends Component
{
    public ?string $periodString = "";
    public ?string $name = "";
    public ?Period $period;
    public ?string $employeeName = "";
    public array $apiErrors = [];
    public array $missingData = [];

    use ImportTimesheetTrait;
    use PayrollEntryTrait;

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
    public function getTimesheetViaApi($empNumber, $period, $name): array
    {
        if($period->we5 != null)
        {
            $weekEndings = "$period->we1, $period->we2, $period->we3, $period->we4, $period->we5";
        } else {
            $weekEndings = "$period->we1, $period->we2, $period->we3, $period->we4";
        }
        $responseData =  Http::acceptJson()->withToken('1|1ANoybfvxu3lMEFJCt6uWps75eHLER1s360l2Sk3f5f46cc8')->post(config('app.timesheet_endpoint'),['user_emp_no' => $empNumber, 'period' => $weekEndings]);
        Log::info("Getting timesheet info for employee $name for $period->month - $period->year via API.");
        if($responseData->status() == 200){
            $data = json_decode($responseData->body(), true);
            if($data['status'] == 'success'){
                Log::info("Timesheet imported successfully");
                return ['exists' => 'exists', 'data' => $data];
            } elseif($data['status'] == 'missing') {
                Log::info("Timesheet missing");
                $missingData = ['user_emp_no' => $empNumber, 'period' => $period->id];
                return ['exists' => 'missing', 'data' =>  $missingData];
            }
        }
        Log::info("Response ".$responseData->status());
        return ['exists' => 'error', 'emp_no' => $empNumber, 'period' => $period->id];
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
            Log::info("Importing Timesheet {$employee->emp_no} - {$employee->name}");
            $this->name = $employee->name;
            $result = $this->getTimesheetViaApi($employee->emp_no, $this->period, $employee->name);
            if ($result['exists'] == 'exists') {
                $timesheetWeek1Hours = $result['data']['timesheets'][$this->period->we1];
                if($timesheetWeek1Hours != null){
                    $this->populateFromTimesheet(collect($timesheetWeek1Hours), Carbon::parse($this->period->we1), 1, $employee->emp_no);
                } else {
                    $this->createBlankHoursRecord(1,$this->period->we1, $employee);
                }
            } elseif ($result['exists'] == 'missing') {
                $this->missingData[] = [$employee->emp_no, $this->period->we1];
            } elseif ($result['exists'] == 'error') {
                $this->apiErrors[] = [$result['emp_no'], $result['weekending']];
            }
            if ($result['exists'] == 'exists') {
                $timesheetWeek2Hours = $result['data']['timesheets'][$this->period->we2];
                if($timesheetWeek2Hours != null){
                    $this->populateFromTimesheet(collect($timesheetWeek2Hours), Carbon::parse($this->period->we2), 1, $employee->emp_no);
                } else {
                    $this->createBlankHoursRecord(2,$this->period->we2, $employee);
                }
            } elseif ($result['exists'] == 'missing') {
                $this->missingData[] = [$employee->emp_no, $this->period->we2];
            } elseif ($result['exists'] == 'error') {
                $this->apiErrors[] = [$result['emp_no'], $result['weekending']];
            }
            if ($result['exists'] == 'exists') {
                $timesheetWeek3Hours = $result['data']['timesheets'][$this->period->we3];;
                if($timesheetWeek3Hours != null){
                    $this->populateFromTimesheet(collect($timesheetWeek3Hours), Carbon::parse($this->period->we3), 1, $employee->emp_no);
                } else {
                    $this->createBlankHoursRecord(3,$this->period->we3, $employee);
                }
            } elseif ($result['exists'] == 'missing') {
                $this->missingData[] = [$employee->emp_no, $this->period->we3];
            } elseif ($result['exists'] == 'error') {
                $this->apiErrors[] = [$result['emp_no'], $result['weekending']];
            }
            if ($result['exists'] == 'exists') {
                $timesheetWeek4Hours = $result['data']['timesheets'][$this->period->we4];
                if($timesheetWeek4Hours != null){
                    $this->populateFromTimesheet(collect($timesheetWeek4Hours), Carbon::parse($this->period->we4), 1, $employee->emp_no);
                } else {
                    $this->createBlankHoursRecord(4,$this->period->we4, $employee);
                }
            } elseif ($result['exists'] == 'missing') {
                $this->missingData[] = [$employee->emp_no, $this->period->we4];
            } elseif ($result['exists'] == 'error') {
                $this->apiErrors[] = [$result['emp_no'], $result['weekending']];
            }
            if ($this->period->we5 != null) {
                if ($result['exists'] == 'exists') {
                    $timesheetWeek5Hours = $result['data']['timesheets'][$this->period->we5];
                    if($timesheetWeek5Hours != null){
                        $this->populateFromTimesheet(collect($timesheetWeek5Hours), Carbon::parse($this->period->we5), 1, $employee->emp_no);
                    } else {
                        $this->createBlankHoursRecord(5,$this->period->we5, $employee);
                    }
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

    public function createBlankHoursRecord($weekNumber, $weekEnding, $employee): void
    {
        Hours::query()->create([
            'week_ending' => Carbon::parse($weekEnding),
            'week_number' => $weekNumber,
            'employee' => $employee->name,
            'emp_no' => $employee->emp_no,
            'period_id' => $this->period->id,
            'period' => $this->period->month.'-'.$this->period->year,
            'expenses' => 0.00,
            'bonus_hours' => 0.00,
        ]);
    }

    public function getPeriod($id): string{
        $period = Period::query()->where('id', $id)->first();
        return $period->month.'-'.$period->year;
    }

    public function getWeekNumber(): int
    {
        $period = Period::query()->where('id', $this->period_id)->first();
        switch (Carbon::parse($this->weekEnding)->format('Y-m-d')) {
            case $period->we1:
                return 1;
            case $period->we2:
                return 2;
            case $period->we3:
                return 3;
            case $period->we4:
                return 4;
            case $period->we5:
                return 5;
        }
    }

    public function back(): void
    {
        $this->redirect(route('payroll-select'));
    }

    public function render(): Application|Factory|View
    {
        return view('livewire.payroll.timesheet-import');
    }
}
