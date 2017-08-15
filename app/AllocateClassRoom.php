<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllocateClassRoom extends Model
{
    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function room_nos()
    {
        return $this->belongsToMany(RoomNo::class);
    }

    public function days()
    {
        return $this->belongsToMany(Day::class);
    }
}
