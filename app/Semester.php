<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
