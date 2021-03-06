<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function course_assign_teachers()
    {
        return $this->hasMany(CourseAssignTeacher::class);
    }

    public function allocate_class_rooms()
    {
        return $this->belongsToMany(AllocateClassRoom::class);
    }
}
