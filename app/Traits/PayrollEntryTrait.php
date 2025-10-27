<?php

namespace App\Traits;

use App\Models\Job;

trait PayrollEntryTrait
{
    public function updated($element, $value): void
    {
        $site = ($value != null && $value != 0) ? Job::query()->where('job_no', $value)->first() : "";
        switch ($element) {
            case 'jobMon1':
                if($site != null) {
                    $this->siteMon1 = $site->site;
                } elseif($value == "") {
                    $this->siteMon1 = "";
                } else {
                    $this->siteMon1 = "Job Number Unknown.";
                }
                break;
            case 'jobMon2':
                if($site != null) {
                    $this->siteMon2 = $site->site;
                } elseif($value == "") {
                    $this->siteMon2 = "";
                } else {
                    $this->siteMon2 = "Job Number Unknown.";
                }
                break;
            case 'jobMon3':
                if($site != null) {
                    $this->siteMon3 = $site->site;
                } elseif($value == "") {
                    $this->siteMon3 = "";
                } else {
                    $this->siteMon3 = "Job Number Unknown.";
                }
                break;
            case 'jobTues1':
                if($site != null) {
                    $this->siteTues1 = $site->site;
                } elseif($value == "") {
                    $this->siteTues1 = "";
                } else {
                    $this->siteTues1 = "Job Number Unknown.";
                }
                break;
            case 'jobTues2':
                if($site != null) {
                    $this->siteTues2 = $site->site;
                } elseif($value == "") {
                    $this->siteTues2 = "";
                } else {
                    $this->siteTues2 = "Job Number Unknown.";
                }
                break;
            case 'jobTues3':
                if($site != null) {
                    $this->siteTues3 = $site->site;
                } elseif($value == "") {
                    $this->siteTues3 = "";
                } else {
                    $this->siteTues3 = "Job Number Unknown.";
                }
                break;
            case 'jobWed1':
                if($site != null) {
                    $this->siteWed1 = $site->site;
                } elseif($value == "") {
                    $this->siteWed1 = "";
                } else {
                    $this->siteWed1 = "Job Number Unknown.";
                }
                break;
            case 'jobWed2':
                if($site != null) {
                    $this->siteWed2 = $site->site;
                } elseif($value == "") {
                    $this->siteWed2 = "";
                } else {
                    $this->siteWed2 = "Job Number Unknown.";
                }
                break;
            case 'jobWed3':
                if($site != null) {
                    $this->siteWed3 = $site->site;
                } elseif($value == "") {
                    $this->siteWed3 = "";
                } else {
                    $this->siteWed3 = "Job Number Unknown.";
                }
                break;
            case 'jobThurs1':
                if($site != null) {
                    $this->siteThurs1 = $site->site;
                } elseif($value == "") {
                    $this->siteThurs1 = "";
                } else {
                    $this->siteThurs1 = "Job Number Unknown.";
                }
                break;
            case 'jobThurs2':
                if($site != null) {
                    $this->siteThurs2 = $site->site;
                } elseif($value == "") {
                    $this->siteThurs2 = "";
                } else {
                    $this->siteThurs2 = "Job Number Unknown.";
                }
                break;
            case 'jobThurs3':
                if($site != null) {
                    $this->siteThurs3 = $site->site;
                } elseif($value == "") {
                    $this->siteThurs3 = "";
                } else {
                    $this->siteThurs3 = "Job Number Unknown.";
                }
                break;
            case 'jobFri1':
                if($site != null) {
                    $this->siteFri1 = $site->site;
                } elseif($value == "") {
                    $this->siteFri1 = "";
                } else {
                    $this->siteFri1 = "Job Number Unknown.";
                }
                break;
            case 'jobFri2':
                if($site != null) {
                    $this->siteFri2 = $site->site;
                } elseif($value == "") {
                    $this->siteFri2 = "";
                } else {
                    $this->siteFri2 = "Job Number Unknown.";
                }
                break;
            case 'jobFri3':
                if($site != null) {
                    $this->siteFri3 = $site->site;
                } elseif($value == "") {
                    $this->siteFri3 = "";
                } else {
                    $this->siteFri3 = "Job Number Unknown.";
                }
                break;
            case 'jobSat1':
                if($site != null) {
                    $this->siteSat1 = $site->site;
                } elseif($value == "") {
                    $this->siteSat1 = "";
                } else {
                    $this->siteSat1 = "Job Number Unknown.";
                }
                break;
            case 'jobSat2':
                if($site != null) {
                    $this->siteSat2 = $site->site;
                } elseif($value == "") {
                    $this->siteSat2 = "";
                } else {
                    $this->siteSat2 = "Job Number Unknown.";
                }
                break;
            case 'jobSat3':
                if($site != null) {
                    $this->siteSat3 = $site->site;
                } elseif($value == "") {
                    $this->siteSat3 = "";
                } else {
                    $this->siteSat3 = "Job Number Unknown.";
                }
                break;
            case 'jobSun1':
                if($site != null) {
                    $this->siteSun1 = $site->site;
                } elseif($value == "") {
                    $this->siteSun1 = "";
                } else {
                    $this->siteSun1 = "Job Number Unknown.";
                }
                break;
            case 'jobSun2':
                if($site != null) {
                    $this->siteSun2 = $site->site;
                } elseif($value == "") {
                    $this->siteSun2 = "";
                } else {
                    $this->siteSun2 = "Job Number Unknown.";
                }
                break;
            case 'jobSun3':
                if($site != null) {
                    $this->siteSun3 = $site->site;
                } elseif($value == "") {
                    $this->siteSun3 = "";
                } else {
                    $this->siteSun3 = "Job Number Unknown.";
                }
                break;
            case 'hoursMon1':
            case 'hoursMon2':
            case 'hoursMon3':
                $removeBreak = $this->checkForBreak($this->hoursMon1, $this->hoursMon2, $this->hoursMon3);
                $this->totalHoursBreakMon = ($removeBreak) ? number_format($this->hoursMon1 - 0.5, 2) : number_format($this->hoursMon1, 2);
                $this->totalHoursMon2 = number_format($this->hoursMon2, 2);
                $this->totalHoursMon3 = number_format($this->hoursMon3, 2);
                $this->monTotal = number_format($this->totalHoursBreakMon + $this->totalHoursMon2 + $this->totalHoursMon3, 2);
                break;
            case 'hoursTues1':
            case 'hoursTues2':
            case 'hoursTues3':
                $removeBreak = $this->checkForBreak($this->hoursTues1, $this->hoursTues2, $this->hoursTues3);
                $this->totalHoursBreakTues = ($removeBreak) ? number_format($this->hoursTues1 - 0.5, 2) : number_format($this->hoursTues1, 2);
                $this->totalHoursTues2 = number_format($this->hoursTues2, 2);
                $this->totalHoursTues3 = number_format($this->hoursTues3, 2);
                $this->tuesTotal = number_format($this->totalHoursBreakTues + $this->totalHoursTues2 + $this->totalHoursTues3, 2);
                break;
            case 'hoursWed1':
            case 'hoursWed2':
            case 'hoursWed3':
                $removeBreak = $this->checkForBreak($this->hoursWed1, $this->hoursWed2, $this->hoursWed3);
                $this->totalHoursBreakWed = ($removeBreak) ? number_format($this->hoursWed1 - 0.5, 2) : number_format($this->hoursWed1, 2);
                $this->totalHoursWed2 = number_format($this->hoursWed2, 2);
                $this->totalHoursWed3 = number_format($this->hoursWed3, 2);
                $this->wedTotal = number_format($this->totalHoursBreakWed + $this->totalHoursWed2 + $this->totalHoursWed3, 2);
                break;
            case 'hoursThurs1':
            case 'hoursThurs2':
            case 'hoursThurs3':
                $removeBreak = $this->checkForBreak($this->hoursThurs1, $this->hoursThurs2, $this->hoursThurs3);
                $this->totalHoursBreakThurs = ($removeBreak) ? number_format($this->hoursThurs1 - 0.5, 2) : number_format($this->hoursThurs1, 2);
                $this->totalHoursThurs2 = number_format($this->hoursThurs2, 2);
                $this->totalHoursThurs3 = number_format($this->hoursThurs3, 2);
                $this->thursTotal = number_format($this->totalHoursBreakThurs + $this->totalHoursThurs2 + $this->totalHoursThurs3, 2);
                break;
            case 'hoursFri1':
            case 'hoursFri2':
            case 'hoursFri3':
                $removeBreak = $this->checkForBreak($this->hoursFri1, $this->hoursFri2, $this->hoursFri3);
                $this->totalHoursBreakFri = ($removeBreak) ? number_format($this->hoursFri1 - 0.5, 2) : number_format($this->hoursFri1, 2);
                $this->totalHoursFri2 = number_format($this->hoursFri2, 2);
                $this->totalHoursFri3 = number_format($this->hoursFri3, 2);
                $this->friTotal = number_format($this->totalHoursBreakFri + $this->totalHoursFri2 + $this->totalHoursFri3, 2);
                break;
            case 'hoursSat1':
            case 'hoursSat2':
            case 'hoursSat3':
                $removeBreak = $this->checkForBreak($this->hoursSat1, $this->hoursSat2, $this->hoursSat3);
                $this->totalHoursBreakSat = ($removeBreak) ? number_format($this->hoursSat1 - 0.5, 2) : number_format($this->hoursSat1, 2);
                $this->totalHoursSat2 = number_format($this->hoursSat2, 2);
                $this->totalHoursSat3 = number_format($this->hoursSat3, 2);
                $this->satTotal = number_format($this->totalHoursBreakSat + $this->totalHoursSat2 + $this->totalHoursSat3, 2);
                break;
            case 'hoursSun1':
            case 'hoursSun2':
            case 'hoursSun3':
                $removeBreak = $this->checkForBreak($this->hoursSun1, $this->hoursSun2, $this->hoursSun3);
                $this->totalHoursBreakSun = ($removeBreak) ? number_format($this->hoursSun1 - 0.5, 2) : number_format($this->hoursSun1, 2);
                $this->totalHoursSun2 = number_format($this->hoursSun2, 2);
                $this->totalHoursSun3 = number_format($this->hoursSun3, 2);
                $this->sunTotal = number_format($this->totalHoursBreakSun + $this->totalHoursSun2 + $this->totalHoursSun3, 2);
                break;

        }
    }
}
