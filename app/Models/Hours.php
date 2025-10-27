<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hours extends Model
{
    protected $connection = 'mysql';
    protected $table = 'hours';
    protected $guarded = [];
}
