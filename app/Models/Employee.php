<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $connection = 'mysql';
    protected $table = 'employees';
    protected $guarded = [];
}
