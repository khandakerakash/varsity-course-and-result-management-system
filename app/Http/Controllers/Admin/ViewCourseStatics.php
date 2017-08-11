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

//        $course_status = DB::table('departments')
//            ->leftjoin('departments', 'departments.id', '=', 'courses.department_id')
//            ->leftjoin('course_assign_teachers', 'course_assign_teachers.department_id', '=', 'courses.department_id')
//            ->leftjoin('teachers', 'teachers.department_id', '=', 'courses.department_id')
//            ->leftjoin('semesters', 'courses.semester_id', '=', 'semesters.id')
//            ->where('departments.id',$id)
//            ->select('courses.*', 'course_assign_teachers.teacher_id', 'teachers.name', 'semesters.title')
////            ->groupBy('departments.id')
//            ->get();


//        $course_status_info = $course_status->where('department_id', '=', $department_id)->get();

//        dd($course_status_info);
//        dd($course_status);

//        return $course_status;
//        return $courses;
    }
}
