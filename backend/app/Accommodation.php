<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    public function room_types()
    {
        return $this->hasMany('App\RoomType');
    }
}
