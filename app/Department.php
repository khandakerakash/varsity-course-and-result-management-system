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

    public function course_assign_teachers()
    {
        return $this->hasMany(CourseAssignTeacher::class);
    }

    public function register_students()
    {
        return $this->hasMany(RegisteredStudent::class);
    }

    public function allocate_class_rooms()
    {
        return $this->belongsToMany(AllocateClassRoom::class);
    }

}
