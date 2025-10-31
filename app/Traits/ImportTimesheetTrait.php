<?php

namespace App\Traits;

use App\Models\Employee;
use App\Models\Hours;
use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

trait ImportTimesheetTrait
{
    public ?float $hoursMon1 = 0;
    public ?float $hoursMon2 = 0;
    public ?float $hoursMon3 = 0;
    public ?float $hoursTues1 = 0;
    public ?float $hoursTues2 = 0;
    public ?float $hoursTues3 = 0;
    public ?float $hoursWed1 = 0;
    public ?float $hoursWed2 = 0;
    public ?float $hoursWed3 = 0;
    public ?float $hoursThurs1 = 0;
    public ?float $hoursThurs2 = 0;
    public ?float $hoursThurs3 = 0;
    public ?float $hoursFri1 = 0;
    public ?float $hoursFri2 = 0;
    public ?float $hoursFri3 = 0;
    public ?float $hoursSat1 = 0;
    public ?float $hoursSat2 = 0;
    public ?float $hoursSat3 = 0;
    public ?float $hoursSun1 = 0;
    public ?float $hoursSun2 = 0;
    public ?float $hoursSun3 = 0;
    public float $totalHoursMon1 = 0;
    public float $totalHoursMon2 = 0;
    public float $totalHoursMon3 = 0;
    public float $totalHoursTues1 = 0;
    public float $totalHoursTues2 = 0;
    public float $totalHoursTues3 = 0;
    public float $totalHoursWed1 = 0;
    public float $totalHoursWed2 = 0;
    public float $totalHoursWed3 = 0;
    public float $totalHoursThurs1 = 0;
    public float $totalHoursThurs2 = 0;
    public float $totalHoursThurs3 = 0;
    public float $totalHoursFri1 = 0;
    public float $totalHoursFri2 = 0;
    public float $totalHoursFri3 = 0;
    public float $totalHoursSat1 = 0;
    public float $totalHoursSat2 = 0;
    public float $totalHoursSat3 = 0;
    public float $totalHoursSun1 = 0;
    public float $totalHoursSun2 = 0;
    public float $totalHoursSun3 = 0;

    public float $totalHoursBreakMon = 0;
    public float $totalHoursBreakTues = 0;
    public float $totalHoursBreakWed = 0;
    public float $totalHoursBreakThurs = 0;
    public float $totalHoursBreakFri = 0;
    public float $totalHoursBreakSat = 0;
    public float $totalHoursBreakSun = 0;
    public float $monTotal = 0;
    public float $tuesTotal = 0;
    public float $wedTotal = 0;
    public float $thursTotal = 0;
    public float $friTotal = 0;
    public float $satTotal = 0;
    public float $sunTotal = 0;
    public float $expenses = 0;
    public float $bonusHours = 0;
    public bool $late = false;
    public bool $monOvernight = false;
    public bool $tueOvernight = false;
    public bool $wedOvernight = false;
    public bool $thuOvernight = false;
    public bool $friOvernight = false;
    public bool $satOvernight = false;
    public bool $sunOvernight = false;
    public ?int $period_id;
    public function populateFromTimesheet($hours, $weekending, $weekNumber, $employee): void
    {

        $this->hoursMon1 = number_format($this->getHours($hours['start_mon_1'], $hours['finish_mon_1']), 2);
        $this->hoursMon2 = number_format($this->getHours($hours['start_mon_2'], $hours['finish_mon_2']), 2);
        $this->hoursMon3 = number_format($this->getHours($hours['start_mon_3'], $hours['finish_mon_3']), 2);
        $this->hoursTues1 = number_format($this->getHours($hours['start_tues_1'], $hours['finish_tues_1']), 2);
        $this->hoursTues2 = number_format($this->getHours($hours['start_tues_2'], $hours['finish_tues_2']), 2);
        $this->hoursTues3 = number_format($this->getHours($hours['start_tues_3'], $hours['finish_tues_3']), 2);
        $this->hoursWed1 = number_format($this->getHours($hours['start_wed_1'], $hours['finish_wed_1']), 2);
        $this->hoursWed2 = number_format($this->getHours($hours['start_wed_2'], $hours['finish_wed_2']), 2);
        $this->hoursWed3 = number_format($this->getHours($hours['start_wed_3'], $hours['finish_wed_3']), 2);
        $this->hoursThurs1 = number_format($this->getHours($hours['start_thur_1'], $hours['finish_thur_1']), 2);
        $this->hoursThurs2 = number_format($this->getHours($hours['start_thur_2'], $hours['finish_thur_2']), 2);
        $this->hoursThurs3 = number_format($this->getHours($hours['start_thur_3'], $hours['finish_thur_3']), 2);
        $this->hoursFri1 = number_format($this->getHours($hours['start_fri_1'], $hours['finish_fri_1']), 2);
        $this->hoursFri2 = number_format($this->getHours($hours['start_fri_2'], $hours['finish_fri_2']), 2);
        $this->hoursFri3 = number_format($this->getHours($hours['start_fri_3'], $hours['finish_fri_3']), 2);
        $this->hoursSat1 = number_format($this->getHours($hours['start_sat_1'], $hours['finish_sat_1']), 2);
        $this->hoursSat2 = number_format($this->getHours($hours['start_sat_2'], $hours['finish_sat_2']), 2);
        $this->hoursSat3 = number_format($this->getHours($hours['start_sat_3'], $hours['finish_sat_3']), 2);
        $this->hoursSun1 = number_format($this->getHours($hours['start_sun_1'], $hours['finish_sun_1']), 2);
        $this->hoursSun2 = number_format($this->getHours($hours['start_sun_2'], $hours['finish_sun_2']), 2);
        $this->hoursSun3 = number_format($this->getHours($hours['start_sun_3'], $hours['finish_sun_3']), 2);
        $this->jobMon1 = $hours['job_number_mon_1'];
        $this->jobMon2 = $hours['job_number_mon_2'];
        $this->jobMon3 = $hours['job_number_mon_3'];
        $this->jobTues1 = $hours['job_number_tues_1'];
        $this->jobTues2 = $hours['job_number_tues_2'];
        $this->jobTues3 = $hours['job_number_tues_3'];
        $this->jobWed1 = $hours['job_number_wed_1'];
        $this->jobWed2 = $hours['job_number_wed_2'];
        $this->jobWed3 = $hours['job_number_wed_3'];
        $this->jobThurs1 = $hours['job_number_thur_1'];
        $this->jobThurs2 = $hours['job_number_thur_2'];
        $this->jobThurs3 = $hours['job_number_thur_3'];
        $this->jobFri1 = $hours['job_number_fri_1'];
        $this->jobFri2 = $hours['job_number_fri_2'];
        $this->jobFri3 = $hours['job_number_fri_3'];
        $this->jobSat1 = $hours['job_number_sat_1'];
        $this->jobSat2 = $hours['job_number_sat_2'];
        $this->jobSat3 = $hours['job_number_sat_3'];
        $this->jobSun1 = $hours['job_number_sun_1'];
        $this->jobSun2 = $hours['job_number_sun_2'];
        $this->jobSun3 = $hours['job_number_sun_3'];

        $this->siteMon1 = $this->getSite($hours['job_number_mon_1']);
        $this->siteMon2 = $this->getSite($hours['job_number_mon_2']);
        $this->siteMon3 = $this->getSite($hours['job_number_mon_3']);
        $this->siteTues1 = $this->getSite($hours['job_number_tues_1']);
        $this->siteTues2 = $this->getSite($hours['job_number_tues_2']);
        $this->siteTues3 = $this->getSite($hours['job_number_tues_3']);
        $this->siteWed1 = $this->getSite($hours['job_number_wed_1']);
        $this->siteWed2 = $this->getSite($hours['job_number_wed_2']);
        $this->siteWed3 = $this->getSite($hours['job_number_wed_3']);
        $this->siteThurs1 = $this->getSite($hours['job_number_thur_1']);
        $this->siteThurs2 = $this->getSite($hours['job_number_thur_2']);
        $this->siteThurs3 = $this->getSite($hours['job_number_thur_3']);
        $this->siteFri1 = $this->getSite($hours['job_number_fri_1']);
        $this->siteFri2 = $this->getSite($hours['job_number_fri_2']);
        $this->siteFri3 = $this->getSite($hours['job_number_fri_3']);
        $this->siteSat1 = $this->getSite($hours['job_number_sat_1']);
        $this->siteSat2 = $this->getSite($hours['job_number_sat_2']);
        $this->siteSat3 = $this->getSite($hours['job_number_sat_3']);
        $this->siteSun1 = $this->getSite($hours['job_number_sun_1']);
        $this->siteSun2 = $this->getSite($hours['job_number_sun_2']);
        $this->siteSun3 = $this->getSite($hours['job_number_sun_3']);

        $this->monOvernight = $hours['mon_overnight'];
        $this->tueOvernight = $hours['tues_overnight'];
        $this->wedOvernight = $hours['wed_overnight'];
        $this->thuOvernight = $hours['thur_overnight'];
        $this->friOvernight = $hours['fri_overnight'];
        $this->satOvernight = $hours['sat_overnight'];
        $this->sunOvernight = $hours['sun_overnight'];

        $totalHoursBreakMon = $this->checkForBreak($this->hoursMon1, $this->hoursMon2, $this->hoursMon3);
        $this->totalHoursBreakMon = ($totalHoursBreakMon) ? number_format($this->hoursMon1 - 0.5, 2) : number_format($this->hoursMon1, 2);
        $this->totalHoursMon2 = number_format($this->hoursMon2, 2);
        $this->totalHoursMon3 = number_format($this->hoursMon3, 2);
        $totalHoursBreakTues = $this->checkForBreak($this->hoursTues1, $this->totalHoursTues2, $this->hoursTues3);
        $this->totalHoursBreakTues = ($totalHoursBreakTues) ? number_format($this->hoursTues1 - 0.5, 2) : number_format($this->hoursTues1, 2);
        $this->totalHoursTues2 = number_format($this->hoursTues2, 2);
        $this->totalHoursTues3 = number_format($this->hoursTues3, 2);
        $totalHoursBreakWed = $this->checkForBreak($this->hoursWed1, $this->hoursWed2, $this->hoursWed3);
        $this->totalHoursBreakWed = ($totalHoursBreakWed) ? number_format($this->hoursWed1 - 0.5, 2) : number_format($this->hoursWed1, 2);
        $this->totalHoursWed2 = number_format($this->hoursWed2, 2);
        $this->totalHoursWed3 = number_format($this->hoursWed3, 2);
        $totalHoursBreakThurs = $this->checkForBreak($this->hoursThurs1, $this->hoursThurs2, $this->hoursThurs3);
        $this->totalHoursBreakThurs = ($totalHoursBreakThurs) ? number_format($this->hoursThurs1 - 0.5, 2) : number_format($this->hoursThurs1, 2);
        $this->totalHoursThurs2 = number_format($this->hoursThurs2, 2);
        $this->totalHoursThurs3 = number_format($this->hoursThurs3, 2);
        $totalHoursBreakFri = $this->checkForBreak($this->hoursFri1, $this->hoursFri2, $this->hoursFri3);
        $this->totalHoursBreakFri = ($totalHoursBreakFri) ? number_format($this->hoursFri1 - 0.5, 2) : number_format($this->hoursFri1, 2);
        $this->totalHoursFri2 = number_format($this->hoursFri2, 2);
        $this->totalHoursFri3 = number_format($this->hoursFri3, 2);
        $totalHoursBreakSat = $this->checkForBreak($this->hoursSat1, $this->hoursSat2, $this->hoursSat3);
        $this->totalHoursBreakSat = ($totalHoursBreakSat) ? number_format($this->hoursSat1 - 0.5, 2) : number_format($this->hoursSat1, 2);
        $this->totalHoursSat2 = number_format($this->hoursSat2, 2);
        $this->totalHoursSat3 = number_format($this->hoursSat3, 2);
        $totalHoursBreakSun = $this->checkForBreak($this->hoursSun1, $this->hoursSun2, $this->hoursSun3);
        $this->totalHoursBreakSun = ($totalHoursBreakSun) ? number_format($this->hoursSun1 - 0.5, 2) : number_format($this->hoursSun1, 2);
        $this->totalHoursSun2 = number_format($this->hoursSun2, 2);
        $this->totalHoursSun3 = number_format($this->hoursSun3, 2);

        $this->monTotal = $this->totalHoursBreakMon + $this->hoursMon2 + $this->hoursMon3;
        $this->tuesTotal = $this->totalHoursBreakTues + $this->totalHoursTues2 + $this->totalHoursTues3;
        $this->wedTotal = $this->totalHoursBreakWed + $this->totalHoursWed2 + $this->totalHoursWed3;
        $this->thursTotal = $this->totalHoursBreakThurs + $this->totalHoursThurs2 + $this->totalHoursThurs3;
        $this->friTotal = $this->totalHoursBreakFri + $this->totalHoursFri2 + $this->totalHoursFri3;
        $this->satTotal = $this->totalHoursBreakSat + $this->totalHoursSat2 + $this->totalHoursSat3;
        $this->sunTotal = $this->totalHoursBreakSun + $this->totalHoursSun2 + $this->totalHoursSun3;
        $this->weekNumber = $weekNumber;
        $this->saveHours($weekending, $employee);
    }

    public function saveHours($weekending, $employee): void
    {
        $existingHours = Hours::query()->where('emp_no', $employee->emp_no)->where('week_ending', $weekending)->first();
        if($existingHours == null) {
            Log::info("Importing Timesheet {$employee->emp_no} - {$employee->name} - WE {$weekending}.");
            $hours = new Hours();
        } else {
            Log::info("Updating Timesheet {$employee->emp_no} - {$employee->name} - WE {$weekending}.");
            $hours = $existingHours;
        }
        $hours->week_ending = Carbon::parse($weekending);
        $hours->employee = $employee->name;
        $hours->emp_no = $employee->emp_no;
        $hours->mon1 = $this->hoursMon1;
        $hours->mon2 = $this->hoursMon2;
        $hours->mon3 = $this->hoursMon3;
        $hours->job_no_mon1 = $this->jobMon1 == '' ? null : $this->jobMon1;
        $hours->job_no_mon2 = $this->jobMon2 == '' ? null : $this->jobMon2;
        $hours->job_no_mon3 = $this->jobMon3 == '' ? null : $this->jobMon3;

        $hours->tue1 = $this->hoursTues1;
        $hours->tue2 = $this->hoursTues2;
        $hours->tue3 = $this->hoursTues3;;
        $hours->job_no_tue1 = $this->jobTues1 == '' ? null : $this->jobTues1;
        $hours->job_no_tue2 = $this->jobTues2 == '' ? null : $this->jobTues2;
        $hours->job_no_tue3 = $this->jobTues3 == '' ? null : $this->jobTues3;

        $hours->wed1 = $this->hoursWed1;
        $hours->wed2 = $this->hoursWed2;
        $hours->wed3 = $this->hoursWed3;
        $hours->job_no_wed1 = $this->jobWed1 == '' ? null : $this->jobWed1;
        $hours->job_no_wed2 = $this->jobWed2 == '' ? null : $this->jobWed2;
        $hours->job_no_wed3 = $this->jobWed3 == '' ? null : $this->jobWed3;

        $hours->thu1 = $this->hoursThurs1;
        $hours->thu2 = $this->hoursThurs2;
        $hours->thu3 = $this->hoursThurs3;
        $hours->job_no_thu1 = $this->jobThurs1 == '' ? null : $this->jobThurs1;
        $hours->job_no_thu2 = $this->jobThurs2 == '' ? null : $this->jobThurs2;
        $hours->job_no_thu3 = $this->jobThurs3 == '' ? null : $this->jobThurs3;

        $hours->fri1 = $this->hoursFri1;
        $hours->fri2 = $this->hoursFri2;
        $hours->fri3 = $this->hoursFri3;
        $hours->job_no_fri1 = $this->jobFri1 == '' ? null : $this->jobFri1;
        $hours->job_no_fri2 = $this->jobFri2 == '' ? null : $this->jobFri2;
        $hours->job_no_fri3 = $this->jobFri3 == '' ? null : $this->jobFri3;

        $hours->sat1 = $this->hoursSat1;
        $hours->sat2 = $this->hoursSat2;
        $hours->sat3 = $this->hoursSat3;
        $hours->job_no_sat1 = $this->jobSat1 == '' ? null : $this->jobSat1;
        $hours->job_no_sat2 = $this->jobSat2 == '' ? null : $this->jobSat2;
        $hours->job_no_sat3 = $this->jobSat3 == '' ? null : $this->jobSat3;

        $hours->sun1 = $this->hoursSun1;
        $hours->sun2 = $this->hoursSun2;
        $hours->sun3 = $this->hoursSun3;
        $hours->job_no_sun1 = $this->jobSun1 == '' ? null : $this->jobSun1;
        $hours->job_no_sun2 = $this->jobSun2 == '' ? null : $this->jobSun2;
        $hours->job_no_sun3 = $this->jobSun3 == '' ? null : $this->jobSun3;

        $hours->tot_mon = $this->monTotal;
        $hours->tot_tue = $this->tuesTotal;
        $hours->tot_wed = $this->wedTotal;
        $hours->tot_thu = $this->thursTotal;
        $hours->tot_fri = $this->friTotal;
        $hours->tot_sat = $this->satTotal;
        $hours->tot_sun = $this->sunTotal;

        $hours->mon_overnight = $this->monOvernight;
        $hours->tue_overnight = $this->tueOvernight;
        $hours->wed_overnight = $this->wedOvernight;
        $hours->thu_overnight = $this->thuOvernight;
        $hours->fri_overnight = $this->friOvernight;
        $hours->sat_overnight = $this->satOvernight;
        $hours->sun_overnight = $this->sunOvernight;
        if($existingHours == null) {
            $hours->expenses = $this->expenses;
        }
        $hours->late = $this->late;
        $hours->period_id = $this->period->id;
        $hours->period = $this->period->month.'-'.$this->period->year;
        $hours->bonus_hours = $this->bonusHours;
        $hours->week_number = $this->weekNumber;
        if($existingHours == null) {
            $hours->save();
        } else {
            $hours->update();
        }
    }


    public function getHours($start, $finish): float
    {
        $start = Carbon::parse($start);
        $finish = Carbon::parse($finish);
        if($start > $finish){
            $untilMidnight = $start->subSecond()->diffInHours(Carbon::parse('23:59:59'));
            $afterMidnight = Carbon::parse('00:00:00')->diffInHours($finish);
            return $untilMidnight + $afterMidnight;
        } else {
            return $start->diffInHours($finish);
        }
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

    public function checkForBreak($day1, $day2, $day3): bool
    {
        if(($day1 + $day2 + $day3) > 6){
            return true;
        } else {
            return false;
        }
    }
}
