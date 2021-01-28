<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    protected $fillable = [
        'name'
    ];

    public function plans()
    {
        return $this->hasMany('App\Plan');
    }

    public function room_types()
    {
        return $this->hasMany('App\RoomType');
    }
}
