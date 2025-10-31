<?php

namespace App\Livewire\Payroll;

use App\Models\Employee;
use App\Models\Hours;
use App\Models\Job;
use App\Models\Period;
use App\Traits\ImportTimesheetTrait;
use App\Traits\PayrollEntryTrait;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class PayrollEntry extends Component
{
    public string $weekEnding = '';
    public string $weekNumber = '';
    public ?Employee $employee = null;
    public string $info = "";
    public ?string $jobMon1 = '';
    public ?string $jobMon2 = '';
    public ?string $jobMon3 = '';
    public ?string $jobTues1 = '';
    public ?string $jobTues2 = '';
    public ?string $jobTues3 = '';
    public ?string $jobWed1 = '';
    public ?string $jobWed2 = '';
    public ?string $jobWed3 = '';
    public ?string $jobThurs1 = '';
    public ?string $jobThurs2 = '';
    public ?string $jobThurs3 = '';
    public ?string $jobFri1 = '';
    public ?string $jobFri2 = '';
    public ?string $jobFri3 = '';
    public ?string $jobSat1 = '';
    public ?string $jobSat2 = '';
    public ?string $jobSat3 = '';
    public ?string $jobSun1 = '';
    public ?string $jobSun2 = '';
    public ?string $jobSun3 = '';
    public ?string $siteMon1 = '';
    public ?string $siteMon2 = '';
    public ?string $siteMon3 = '';
    public ?string $siteTues1 = '';
    public ?string $siteTues2 = '';
    public ?string $siteTues3 = '';
    public ?string $siteWed1 = '';
    public ?string $siteWed2 = '';
    public ?string $siteWed3 = '';
    public ?string $siteThurs1 = '';
    public ?string $siteThurs2 = '';
    public ?string $siteThurs3 = '';
    public ?string $siteFri1 = '';
    public ?string $siteFri2 = '';
    public ?string $siteFri3 = '';
    public ?string $siteSat1 = '';
    public ?string $siteSat2 = '';
    public ?string $siteSat3 = '';
    public ?string $siteSun1 = '';
    public ?string $siteSun2 = '';
    public ?string $siteSun3 = '';
    public string $employeeName = '';


    use PayrollEntryTrait;
    use ImportTimesheetTrait;

    public function mount(string $data): void
    {
        $data = decrypt($data);
        $period = Period::query()->where('current', true)->first();
        $this->period_id = $period->id;
        $this->weekEnding = Carbon::parse($data['selectedWeekEnding'])->format('d-m-Y');
        $this->employee = Employee::query()->where('emp_no', $data['selectedEmployee'])->first();
        $this->employeeName = $this->employee->name;;
        $hours = Hours::query()->where('week_ending', $data['selectedWeekEnding'])->where('emp_no', $this->employee->emp_no)->first();
        if($hours != null) {
            $this->weekNumber = $hours->week_number;
            $this->info = "Values loaded from EPS Payroll App.";
            $this->populateHours();
        } else {
            $this->info = "No timesheet found for this employee. A blank hours record has been created";
            $this->createBlankHoursRecord();
        }


    }

    private function populateHours(): void
    {
        $hours = Hours::query()->where('week_ending', Carbon::parse($this->weekEnding))->where('emp_no', $this->employee->emp_no)->first();
        $this->populateFromHours($hours);
    }

    public function createBlankHoursRecord(): void
    {
        $this->weekNumber = $this->getWeekNumber();
        Hours::query()->create([
            'week_ending' => Carbon::parse($this->weekEnding),
            'week_number' => $this->weekNumber,
            'employee' => $this->employee->name,
            'emp_no' => $this->employee->emp_no,
            'period_id' => $this->period_id,
            'period' => $this->getPeriod($this->period_id),
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

    public function populateFromHours($hours): void
    {
        $removeBreak = $this->checkForBreak($hours->mon1, $hours->mon2, $hours->mon3);
        $this->totalHoursBreakMon = ($removeBreak) ? number_format($hours->mon1 - 0.5, 2) : number_format($hours->mon1);
        $this->hoursMon1 = number_format($hours->mon1,2);
        $this->hoursMon2 = number_format($hours->mon2,2);
        $this->hoursMon3 = number_format($hours->mon3,2);
        $removeBreak = $this->checkForBreak($hours->tue1, $hours->tue2, $hours->tue3);
        $this->totalHoursBreakTues = ($removeBreak) ? number_format($hours->tue1 - 0.5, 2) : number_format($hours->tue1);
        $this->hoursTues1 = number_format($hours->tue1,2);
        $this->hoursTues2 = number_format($hours->tue2,2);
        $this->hoursTues3 = number_format($hours->tue3,2);
        $removeBreak = $this->checkForBreak($hours->wed1, $hours->wed2, $hours->wed3);
        $this->totalHoursBreakWed = ($removeBreak) ? number_format($hours->wed1 - 0.5, 2) : number_format($hours->wed1);
        $this->hoursWed1 = number_format($hours->wed1,2);
        $this->hoursWed2 = number_format($hours->wed2,2);
        $this->hoursWed3 = number_format($hours->wed3,2);
        $removeBreak = $this->checkForBreak($hours->thur1, $hours->thur2, $hours->thur3);
        $this->totalHoursBreakThurs = ($removeBreak) ? number_format($hours->thu1 - 0.5, 2) : number_format($hours->thur1);
        $this->hoursThurs1 = number_format($hours->thu1,2);
        $this->hoursThurs2 = number_format($hours->thu2,2);
        $this->hoursThurs3 = number_format($hours->thu3,2);
        $removeBreak = $this->checkForBreak($hours->fri1, $hours->fri2, $hours->fri3);
        $this->totalHoursBreakFri = ($removeBreak) ? number_format($hours->fri1 - 0.5, 2) : number_format($hours->fri1);
        $this->hoursFri1 = number_format($hours->fri1,2);
        $this->hoursFri2 = number_format($hours->fri2,2);
        $this->hoursFri3 = number_format($hours->fri3,2);
        $removeBreak = $this->checkForBreak($hours->sat1, $hours->sat2, $hours->sat3);
        $this->totalHoursBreakSat = ($removeBreak) ? number_format($hours->sat1 - 0.5, 2) : number_format($hours->sat1);
        $this->hoursSat1 = number_format($hours->sat1,2);
        $this->hoursSat2 = number_format($hours->sat2,2);
        $this->hoursSat3 = number_format($hours->sat3,2);
        $removeBreak = $this->checkForBreak($hours->sun1, $hours->sun2, $hours->sun3);
        $this->totalHoursBreakSun = ($removeBreak) ? number_format($hours->sun1 - 0.5, 2) : number_format($hours->sun1);
        $this->hoursSun1 = number_format($hours->sun1,2);
        $this->hoursSun2 = number_format($hours->sun2,2);
        $this->hoursSun3 = number_format($hours->sun3,2);

        $this->jobMon1 = $hours->job_no_mon1;
        $this->siteMon1 = $this->getSite($hours->job_no_mon1);
        $this->jobMon2 = $hours->job_no_mon2;
        $this->siteMon2 = $this->getSite($hours->job_no_mon2);
        $this->jobMon3 = $hours->job_no_mon3;
        $this->siteMon3 = $this->getSite($hours->job_no_mon3);
        $this->jobTues1 = $hours->job_no_tue1;
        $this->siteTues1 = $this->getSite($hours->job_no_tue1);
        $this->jobTues2 = $hours->job_no_tue2;
        $this->siteTues2 = $this->getSite($hours->job_no_tue2);
        $this->jobTues3 = $hours->job_no_tue3;
        $this->siteTues3 = $this->getSite($hours->job_no_tue3);
        $this->jobWed1 = $hours->job_no_wed1;
        $this->siteWed1 = $this->getSite($hours->job_no_wed1);
        $this->jobWed2 = $hours->job_no_wed2;
        $this->siteWed2 = $this->getSite($hours->job_no_wed2);
        $this->jobWed3 = $hours->job_no_wed3;
        $this->siteWed3 = $this->getSite($hours->job_no_wed3);
        $this->jobThurs1 = $hours->job_no_thu1;
        $this->siteThurs1 = $this->getSite($hours->job_no_thu1);
        $this->jobThurs2 = $hours->job_no_thu2;
        $this->siteThurs2 = $this->getSite($hours->job_no_thu2);
        $this->jobThurs3 = $hours->job_no_thu3;
        $this->siteThurs3 = $this->getSite($hours->job_no_thu3);
        $this->jobFri1 = $hours->job_no_fri1;
        $this->siteFri1 = $this->getSite($hours->job_no_fri1);
        $this->jobFri2 = $hours->job_no_fri2;
        $this->siteFri2 = $this->getSite($hours->job_no_fri2);
        $this->jobFri3 = $hours->job_no_fri3;
        $this->siteFri3 = $this->getSite($hours->job_no_fri3);
        $this->jobSat1 = $hours->job_no_sat1;
        $this->siteSat1 = $this->getSite($hours->job_no_sat1);
        $this->jobSat2 = $hours->job_no_sat2;
        $this->siteSat2 = $this->getSite($hours->job_no_sat2);
        $this->jobSat3 = $hours->job_no_sat3;
        $this->siteSat3 = $this->getSite($hours->job_no_sat3);
        $this->jobSun1 = $hours->job_no_sun1;
        $this->siteSun1 = $this->getSite($hours->job_no_sun1);
        $this->jobSun2 = $hours->job_no_sun2;
        $this->siteSun2 = $this->getSite($hours->job_no_sun2);
        $this->jobSun3 = $hours->job_no_sun3;
        $this->siteSun3 = $this->getSite($hours->job_no_sun3);
        $this->monOvernight = $hours->mon_overnight;
        $this->tueOvernight = $hours->tue_overnight;
        $this->wedOvernight = $hours->wed_overnight;
        $this->thuOvernight = $hours->thu_overnight;
        $this->friOvernight = $hours->fri_overnight;
        $this->satOvernight = $hours->sat_overnight;
        $this->sunOvernight = $hours->sun_overnight;
        $this->monTotal = number_format($this->hoursMon1 + $this->hoursMon2 + $this->hoursMon3,2);
        $this->tuesTotal =  number_format($this->hoursTues1 + $this->hoursTues2 + $this->hoursTues3, 2);
        $this->wedTotal =  number_format($this->hoursWed1 + $this->hoursWed2 + $this->hoursWed3, 2);
        $this->thursTotal =  number_format($this->hoursThurs1 + $this->hoursThurs2 + $this->hoursThurs3, 2);
        $this->friTotal =  number_format($this->hoursFri1 + $this->hoursFri2 + $this->hoursFri3, 2);
        $this->satTotal =  number_format($this->hoursSat1 + $this->hoursSat2 + $this->hoursSat3, 2);
        $this->sunTotal =  number_format($this->hoursSun1 + $this->hoursSun2 + $this->hoursSun3, 2);
        $this->expenses = $hours->expenses;
        $this->late = $hours->late;
        $this->bonusHours = $hours->bonus_hours;

    }

    public function getSite($id): string
    {
        if($id == '9999') {
            return "Holiday";
        } else{
            $site = Job::query()->where('job_no', $id)->first();
            if($site != null) {
                return $site->site;
            } else {
                return '';
            }
        }
    }

//    public function checkForBreak($day1, $day2, $day3, $climb1 = 0, $climb2 = 0, $climb3 = 0): bool
//    {
//        if(($day1 + $day2 + $day3 + $climb1 + $climb2 + $climb3) > 6){
//            return true;
//        } else {
//            return false;
//        }
//    }

//    public function getHours($start, $finish): float
//    {
//        $start = Carbon::parse($start);
//        $finish = Carbon::parse($finish);
//        if($start > $finish){
//            $untilMidnight = $start->subSecond()->diffInHours(Carbon::parse('23:59:59'));
//            $afterMidnight = Carbon::parse('00:00:00')->diffInHours($finish);
//            return $untilMidnight + $afterMidnight;
//        } else {
//            return $start->diffInHours($finish);
//        }
//    }

    public function back(): void
    {
        $this->redirect(route('hours-select-employee'));
    }

    public function getWeekEnding($week, $period): string
    {
        return match ($week) {
            '1' => $period->we1,
            '2' => $period->we2,
            '3' => $period->we3,
            '4' => $period->we4,
            '5' => $period->we5,
            default => '',
        };
    }

    public function save(): void
    {
        $checkExists = Hours::query()->where('week_ending', Carbon::parse($this->weekEnding))->where('emp_no', $this->employee->emp_no)->first();
        if($checkExists == null){
            $this->saveHours($this->employee->id, Carbon::parse($this->weekEnding));
            flash()->option('position', 'top-right')->success('Hours saved locally to Payroll App successfully');
        } else {
            $checkExists->update([
                'week_ending' => Carbon::parse($this->weekEnding),
                'employee' => $this->employee->name,
                'emp_no' => $this->employee->emp_no,
                'mon1' => $this->hoursMon1,
                'mon2' => $this->hoursMon2,
                'mon3' => $this->hoursMon3,
                'job_no_mon1' => $this->jobMon1 == '' ? null : $this->jobMon1,
                'job_no_mon2' => $this->jobMon2 == '' ? null : $this->jobMon2,
                'job_no_mon3' => $this->jobMon3 == '' ? null : $this->jobMon3,

                'tue1' => $this->hoursTues1,
                'tue2' => $this->hoursTues2,
                'tue3' => $this->hoursTues3,
                'job_no_tue1' => $this->jobTues1 == '' ? null : $this->jobTues1,
                'job_no_tue2' => $this->jobTues2 == '' ? null : $this->jobTues2,
                'job_no_tue3' => $this->jobTues3 == '' ? null : $this->jobTues3,

                'wed1' => $this->hoursWed1,
                'wed2' => $this->hoursWed2,
                'wed3' => $this->hoursWed3,
                'job_no_wed1' => $this->jobWed1 == '' ? null : $this->jobWed1,
                'job_no_wed2' => $this->jobWed2 == '' ? null : $this->jobWed2,
                'job_no_wed3' => $this->jobWed3 == '' ? null : $this->jobWed3,

                'thu1' => $this->hoursThurs1,
                'thu2' => $this->hoursThurs2,
                'thu3' => $this->hoursThurs3,
                'job_no_thu1' => $this->jobThurs1 == '' ? null : $this->jobThurs1,
                'job_no_thu2' => $this->jobThurs2 == '' ? null : $this->jobThurs2,
                'job_no_thu3' => $this->jobThurs3 == '' ? null : $this->jobThurs3,

                'fri1' => $this->hoursFri1,
                'fri2' => $this->hoursFri2,
                'fri3' => $this->hoursFri3,
                'job_no_fri1' => $this->jobFri1 == '' ? null : $this->jobFri1,
                'job_no_fri2' => $this->jobFri2 == '' ? null : $this->jobFri2,
                'job_no_fri3' => $this->jobFri3 == '' ? null : $this->jobFri3,

                'sat1' => $this->hoursSat1,
                'sat2' => $this->hoursSat2,
                'sat3' => $this->hoursSat3,
                'job_no_sat1' => $this->jobSat1 == '' ? null : $this->jobSat1,
                'job_no_sat2' => $this->jobSat2 == '' ? null : $this->jobSat2,
                'job_no_sat3' => $this->jobSat3 == '' ? null : $this->jobSat3,

                'sun1' => $this->hoursSun1,
                'sun2' => $this->hoursSun2,
                'sun3' => $this->hoursSun3,
                'job_no_sun1' => $this->jobSun1 == '' ? null : $this->jobSun1,
                'job_no_sun2' => $this->jobSun2 == '' ? null : $this->jobSun2,
                'job_no_sun3' => $this->jobSun3 == '' ? null : $this->jobSun3,

                'tot_mon' => $this->monTotal,
                'tot_tue' => $this->tuesTotal,
                'tot_wed' => $this->wedTotal,
                'tot_thu' => $this->thursTotal,
                'tot_fri' => $this->friTotal,
                'tot_sat' => $this->satTotal,
                'tot_sun' => $this->sunTotal,

                'mon_overnight' => $this->monOvernight,
                'tue_overnight' => $this->tueOvernight,
                'wed_overnight' => $this->wedOvernight,
                'thu_overnight' => $this->thuOvernight,
                'fri_overnight' => $this->friOvernight,
                'sat_overnight' => $this->satOvernight,
                'sun_overnight' => $this->sunOvernight,

                'expenses' => $this->expenses,
                'late' => $this->late,
                'period_id' => $this->period_id,
                'bonus_hours' => $this->bonusHours
            ]);
            flash()->option('position', 'top-right')->success('Hours updated locally to Payroll App successfully');
        }


    }

    public function render(): View|Application|\Illuminate\View\View
    {
        return view('livewire.payroll.payroll-entry');
    }

}
