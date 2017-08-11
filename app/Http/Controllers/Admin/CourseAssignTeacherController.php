<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\CourseAssignTeacher;
use App\Department;
use App\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class CourseAssignTeacherController extends Controller
{
    public function index()
    {
        $departments = Department::all();

        return view('admin.course_assign_teachers.index')->with('departments', $departments);
    }

    // For Department wise teacher and course information
    public function ajaxTeacherCourse()
    {
        $department_id = Input::get('department_id');

        $teachers = Teacher::where('department_id', '=', $department_id)->get();
        $courses = Course::where('department_id', '=', $department_id)->get();

        return $data = ["teacher"=>$teachers,"course"=>$courses];
    }

    // For Teacher wise teacher credit information
    public function ajaxTeacherCredit($id)
    {
        $teachers_credit = DB::table('teachers')
            ->leftJoin('course_assign_teachers', 'teachers.id', '=', 'course_assign_teachers.teacher_id')
            ->leftJoin('courses', 'courses.id', '=', 'course_assign_teachers.course_id')
            ->where('teachers.id',$id)
            ->select(DB::raw('IFNULL(sum(courses.credit),0) as creditEmptyOrNot,teachers.id,teachers.credit'))
            ->groupBy('teachers.id')
            ->first();

        $has_credit_or_not = $teachers_credit->creditEmptyOrNot;
        $teacher_actual_credit = $teachers_credit->credit;

        if (!empty($has_credit_or_not)){

            $remaining_credit_result = $teacher_actual_credit - $has_credit_or_not;

        }else {

            $remaining_credit_result = $teacher_actual_credit;
        }

        return $credit_data = ['teacher_actual_credit'=>$teacher_actual_credit, 'remaining_credit_result'=>$remaining_credit_result];

//        dd($credit_data);
    }


    // For Course wise course name and credit
    public function ajaxCourseName($id)
    {
        return Course::find($id);
    }

    // For add course assign teacher
    public function add(Request $request)
    {
        $this->validate($request, [
            'department_id' => 'required',
            'teacher_id' => 'required',
            'course_id' => 'required|unique:course_assign_teachers,course_id',
        ]);

        $course_assign_teacher = new CourseAssignTeacher();

        $course_assign_teacher->department_id = $request->department_id;
        $course_assign_teacher->teacher_id = $request->teacher_id;
        $course_assign_teacher->course_id = $request->course_id;

        $course_assign_teacher->save();

        return redirect()->route('admin.course_assign_teacher.all')
            ->with('success', 'Course Added Successfully!');
    }
}
