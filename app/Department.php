<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }

    public function semesters()
    {
        return $this->belongsToMany(Semester::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
