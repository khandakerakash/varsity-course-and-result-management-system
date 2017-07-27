<?php

namespace App\Http\Controllers\Admin;

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

        return view('admin.course_assign_teachers.index')->with('departments', $departments);
    }

    public function ajaxTeacher()
    {
        $department_id = Input::get('department_id');

        $teachers = Teacher::where('department_id', '=', $department_id)->get();

        return Response::json($teachers);
    }

//    public function add(Request $request)
//    {
//        return view('course_assign_teacher.index');
//    }
}
