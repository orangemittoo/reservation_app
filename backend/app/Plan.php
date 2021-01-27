<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public function room_types()
    {
        return $this->belongsToMany('App\RoomType');
    }

    public function plan_fees()
    {
        return $this->hasMany('App\PlanFee');
    }

    public function plan_stocks()
    {
        return $this->hasMany('App\PlanStock');
    }

    public function cancellation_rules()
    {
        return $this->hasMany('App\CancellationRule');
    }
}
