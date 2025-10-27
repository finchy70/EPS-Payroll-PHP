<?php

namespace App\Traits;


use App\Models\Period;

trait PeriodFunctionsTrait
{
    public function setPeriod(Period $period): array
    {
        $weeks = [];
        $weeks[] = $period->we1;
        $weeks[] = $period->we2;
        $weeks[] = $period->we3;
        $weeks[] = $period->we4;
        if($period->we5 != null)
        {
            $weeks[] = $period->we5;
        }
        return $weeks;
    }
}
