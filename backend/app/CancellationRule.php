<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CancellationRule extends Model
{
    protected $fillable = [
        'before_day_num',
        'percentage'
    ];
}
