<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseAssignTeacher extends Model
{
    protected $fillable = [
        'department_id', 'teacher_id', 'credit_taken', 'remaining_credit', 'course_id', 'course_name', 'course_credit',
    ];

    public function department()
    {
        return $this->belongsTo('Department');
    }

    public function course()
    {
        return $this->belongsTo('Course');
    }

    public function teacher()
    {
        return $this->belongsTo('Teacher');
    }
}
