<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    public function allocate_class_rooms()
    {
        return $this->belongsToMany(AllocateClassRoom::class);
    }
}
