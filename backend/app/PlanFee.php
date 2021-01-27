<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanFee extends Model
{
    public function plan()
    {
        return $this->belongsTo('App\Plan');
    }
}
