<?php

namespace App\Traits;

use App\Models\Job;

trait ProjectHoursTrait
{
    public function getProjectHours($allHours): array
    {
        $projects = [];
        foreach($allHours as $hours) {
            if ($hours->job_no_mon1 != null) {
                if (array_key_exists($hours->job_no_mon1, $projects)) {
                    $existingHours = $projects[$hours->job_no_mon1];

                    $projects[$hours->job_no_mon1] = $existingHours + $hours->mon1;
                } else {
                    $projects[$hours->job_no_mon1] = floatval($hours->mon1);
                }
            }
            if ($hours->job_no_mon2 != null) {
                if (array_key_exists($hours->job_no_mon2, $projects)) {
                    $existingHours = $projects[$hours->job_no_mon2];

                    $projects[$hours->job_no_mon2] = $existingHours + $hours->mon2;
                } else {
                    $projects[$hours->job_no_mon2] = floatval($hours->mon2);
                }
            }
            if ($hours->job_no_mon3 != null) {
                if (array_key_exists($hours->job_no_mon3, $projects)) {
                    $existingHours = $projects[$hours->job_no_mon3];

                    $projects[$hours->job_no_mon3] = $existingHours + $hours->mon3;
                } else {
                    $projects[$hours->job_no_mon3] = floatval($hours->mon3);
                }
            }

            if ($hours->job_no_tue1 != null) {
                if (array_key_exists($hours->job_no_tue1, $projects)) {
                    $existingHours = $projects[$hours->job_no_tue1];
                    $projects[$hours->job_no_tue1] = $existingHours + $hours->tue1;
                } else {
                    $projects[$hours->job_no_tue1] = floatval($hours->tue1);
                }
            }
            if ($hours->job_no_tue2 != null) {
                if (array_key_exists($hours->job_no_tue2, $projects)) {
                    $existingHours = $projects[$hours->job_no_tue2];
                    $projects[$hours->job_no_tue2] = $existingHours + $hours->tue2;
                } else {
                    $projects[$hours->job_no_tue2] = floatval($hours->tue2);
                }
            }
            if ($hours->job_no_tue3 != null) {
                if (array_key_exists($hours->job_no_tue3, $projects)) {
                    $existingHours = $projects[$hours->job_no_tue3];
                    $projects[$hours->job_no_tue3] = $existingHours + $hours->tue3;
                } else {
                    $projects[$hours->job_no_tue3] = floatval($hours->tue3);
                }
            }

            if ($hours->job_no_wed1 != null) {
                if (array_key_exists($hours->job_no_wed1, $projects)) {
                    $existingHours = $projects[$hours->job_no_wed1];
                    $projects[$hours->job_no_wed1] = $existingHours + $hours->wed1;
                } else {
                    $projects[$hours->job_no_wed1] = floatval($hours->wed1);
                }
            }
            if ($hours->job_no_wed2 != null) {
                if (array_key_exists($hours->job_no_wed2, $projects)) {
                    $existingHours = $projects[$hours->job_no_wed2];
                    $projects[$hours->job_no_wed2] = $existingHours + $hours->wed2;
                } else {
                    $projects[$hours->job_no_wed2] = floatval($hours->wed2);
                }
            }
            if ($hours->job_no_wed3 != null) {
                if (array_key_exists($hours->job_no_wed3, $projects)) {
                    $existingHours = $projects[$hours->job_no_wed3];
                    $projects[$hours->job_no_wed3] = $existingHours + $hours->wed3;
                } else {
                    $projects[$hours->job_no_wed3] = floatval($hours->wed3);
                }
            }

            if ($hours->job_no_thu1 != null) {
                if (array_key_exists($hours->job_no_thu1, $projects)) {
                    $existingHours = $projects[$hours->job_no_thu1];
                    $projects[$hours->job_no_thu1] = $existingHours + $hours->thu1;
                } else {
                    $projects[$hours->job_no_thu1] = floatval($hours->thu1);
                }
            }
            if ($hours->job_no_thu2 != null) {
                if (array_key_exists($hours->job_no_thu2, $projects)) {
                    $existingHours = $projects[$hours->job_no_thu2];
                    $projects[$hours->job_no_thu2] = $existingHours + $hours->thu2;
                } else {
                    $projects[$hours->job_no_thu2] = floatval($hours->thu2);
                }
            }
            if ($hours->job_no_thu3 != null) {
                if (array_key_exists($hours->job_no_thu3, $projects)) {
                    $existingHours = $projects[$hours->job_no_thu3];
                    $projects[$hours->job_no_thu3] = $existingHours + $hours->thu3;
                } else {
                    $projects[$hours->job_no_thu3] = floatval($hours->thu3);
                }
            }

            if ($hours->job_no_fri1 != null) {
                if (array_key_exists($hours->job_no_fri1, $projects)) {
                    $existingHours = $projects[$hours->job_no_fri1];
                    $projects[$hours->job_no_fri1] = $existingHours + $hours->fri1;
                } else {
                    $projects[$hours->job_no_fri1] = floatval($hours->fri1);
                }
            }
            if ($hours->job_no_fri2 != null) {
                if (array_key_exists($hours->job_no_fri2, $projects)) {
                    $existingHours = $projects[$hours->job_no_fri2];
                    $projects[$hours->job_no_fri2] = $existingHours + $hours->fri2;
                } else {
                    $projects[$hours->job_no_fri2] = floatval($hours->fri2);
                }
            }
            if ($hours->job_no_fri3 != null) {
                if (array_key_exists($hours->job_no_fri3, $projects)) {
                    $existingHours = $projects[$hours->job_no_fri3];
                    $projects[$hours->job_no_fri3] = $existingHours + $hours->fri3;
                } else {
                    $projects[$hours->job_no_fri3] = floatval($hours->fri3);
                }
            }

            if ($hours->job_no_sat1 != null) {
                if (array_key_exists($hours->job_no_sat1, $projects)) {
                    $existingHours = $projects[$hours->job_no_sat1];
                    $projects[$hours->job_no_sat1] = $existingHours + $hours->sat1;
                } else {
                    $projects[$hours->job_no_sat1] = floatval($hours->sat1);
                }
            }
            if ($hours->job_no_sat2 != null) {
                if (array_key_exists($hours->job_no_sat2, $projects)) {
                    $existingHours = $projects[$hours->job_no_sat2];
                    $projects[$hours->job_no_sat2] = $existingHours + $hours->sat2;
                } else {
                    $projects[$hours->job_no_sat2] = floatval($hours->sat2);
                }
            }
            if ($hours->job_no_sat3 != null) {
                if (array_key_exists($hours->job_no_sat3, $projects)) {
                    $existingHours = $projects[$hours->job_no_sat3];
                    $projects[$hours->job_no_sat3] = $existingHours + $hours->sat3;
                } else {
                    $projects[$hours->job_no_sat3] = floatval($hours->sat3);
                }
            }

            if ($hours->job_no_sun1 != null) {
                if (array_key_exists($hours->job_no_sun1, $projects)) {
                    $existingHours = $projects[$hours->job_no_sun1];
                    $projects[$hours->job_no_sun1] = $existingHours + $hours->sun1;
                } else {
                    $projects[$hours->job_no_sun1] = floatval($hours->sun1);
                }
            }
            if ($hours->job_no_sun2 != null) {
                if (array_key_exists($hours->job_no_sun2, $projects)) {
                    $existingHours = $projects[$hours->job_no_sun2];
                    $projects[$hours->job_no_sun2] = $existingHours + $hours->sun2;
                } else {
                    $projects[$hours->job_no_sun2] = floatval($hours->sun2);
                }
            }
            if ($hours->job_no_sun3 != null) {
                if (array_key_exists($hours->job_no_sun3, $projects)) {
                    $existingHours = $projects[$hours->job_no_sun3];
                    $projects[$hours->job_no_sun3] = $existingHours + $hours->sun3;
                } else {
                    $projects[$hours->job_no_sun3] = floatval($hours->sun3);
                }
            }
        }
        return $projects;
    }
}
