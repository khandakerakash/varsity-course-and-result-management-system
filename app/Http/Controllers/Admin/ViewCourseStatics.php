<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\CourseAssignTeacher;
use App\Department;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;


class ViewCourseStatics extends Controller
{
    public function index()
    {
        $departments = Department::all();

        return view('admin.view_course_statics.index')
            ->with('departments', $departments);
    }


    public function ajaxDepartmentCourseStatics()
    {
    	$department_id = Input::get('department_id');

//        $courses = Course::where('department_id', '=', $department_id)->get();

//        $course_status = Course::where('department_id', '=', $department_id)
//                ->join('course_assign_teachers', 'courses.id', '=', 'course_assign_teachers.id')
//                ->join('semesters', 'courses.id', '=', 'semesters.id')
//                ->select('courses.*', 'course_assign_teachers.teacher_id', 'semesters.title')
//                ->get();

        $course_status = DB::table('courses')
//            ->join('departments', 'courses.department_id', '=', 'departments.id')
            ->join('course_assign_teachers', 'courses.department_id', '=', 'course_assign_teachers.department_id')
            ->join('semesters', 'courses.semester_id', '=', 'semesters.id')
            ->select('courses.*', 'course_assign_teachers.teacher_id', 'semesters.title')
            ->get();

//        $course_status_info = $course_status->where('department_id', '=', $department_id)->get();

//        dd($course_status_info);
//        dd($course_status);

        return $course_status;
//        return $courses;
    }
}
