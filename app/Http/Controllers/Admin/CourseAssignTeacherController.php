<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Department;
use App\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class CourseAssignTeacherController extends Controller
{
    public function index()
    {
        $departments = Department::all();

        return view('admin.course_assign_teachers.index2')->with('departments', $departments);
    }


    public function ajaxTeacher()
    {
        $department_id = Input::get('department_id');

        $teachers = Teacher::where('department_id', '=', $department_id)->get();
        $courses = Course::where('department_id', '=', $department_id)->get();

        $data = ["teacher"=>$teachers,"course"=>$courses];
        return $data;


//        return Response::json($teachers,$courses);
    }

    public function ajaxCourseCode($id)
    {


        $teacher = Teacher::find(3000);
        if(count($teacher)>0){
            return $teacher;
        }
        return ["error"=>true,"msg"=>"no data found"];
    }

    public function ajaxCourseName($id)
    {


        return Course::find($id);

       // return $course_name;
    }

//    public function add(Request $request)
//    {
//        return view('course_assign_teacher.index');
//    }
}
