<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomNo extends Model
{
    public function allocate_class_rooms()
    {
        return $this->belongsToMany(AllocateClassRoom::class);
    }
}
