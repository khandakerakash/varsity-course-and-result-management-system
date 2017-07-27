<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseAssignTeacher extends Model
{
    public function department()
    {
        return $this->belongsTo('Department');
    }

    public function course()
    {
        return $this->belongsTo('Course');
    }
}
