<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanFee extends Model
{
    protected $fillable = [
        'fee',
        'date'
    ];

    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }
}
