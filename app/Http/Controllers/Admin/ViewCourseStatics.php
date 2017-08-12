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


    public function ajaxDepartmentCourseStatics($id)
    {
//    	$department_id = Input::get('department_id');

//        $courses = Course::where('department_id', '=', $department_id)->get();

//        $course_status = Course::where('department_id', '=', $department_id)
//                ->join('course_assign_teachers', 'courses.id', '=', 'course_assign_teachers.id')
//                ->join('semesters', 'courses.id', '=', 'semesters.id')
//                ->select('courses.*', 'course_assign_teachers.teacher_id', 'semesters.title')
//                ->get();

        $course_status = DB::table('departments')
            ->leftjoin('courses', 'departments.id', '=', 'courses.department_id')
//            ->leftjoin('course_assign_teachers', 'courses.department_id', '=', 'course_assign_teachers.department_id')
//            ->leftJoin('courses', 'courses.id', '=', 'course_assign_teachers.course_id')
            ->rightjoin('teachers', 'departments.id', '=', 'teachers.department_id')
//            ->pluck('teachers')
//            ->values()
            ->leftjoin('semesters', 'courses.semester_id', '=', 'semesters.id')
            ->where('departments.id',$id)
            ->select('courses.*', 'departments.code', 'semesters.title', 'teachers.name')
//            ->groupBy('departments.id')
            ->first();

        dd($course_status);

//        $course_status_info = $course_status->where('department_id', '=', $department_id)->get();

//        dd($course_status_info);

//        return $course_status;
//        return $courses;
    }
}
