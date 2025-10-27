<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    protected $connection = 'site';
    protected $table = 'timesheets';
}
