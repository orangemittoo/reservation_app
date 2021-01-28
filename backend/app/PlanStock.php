<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanStock extends Model
{
    protected $fillable = [
        'remaining_num',
        'date'
    ];

    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }
}
