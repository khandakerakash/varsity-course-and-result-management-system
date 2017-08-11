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
        $data = ["teacher"=>$teachers,"course"=>$courses];

        return $data;
    }

    // For Teacher wise teacher credit information
    public function ajaxTeacherCredit($id)
    {
        $users = DB::table('teachers')
            ->leftJoin('course_assign_teachers', 'teachers.id', '=', 'course_assign_teachers.teacher_id')
            ->leftJoin('courses', 'courses.id', '=', 'course_assign_teachers.course_id')
            ->where('teachers.id',$id)
            ->select(DB::raw('IFNULL(sum(courses.credit),0),teachers.id,teachers.credit'))
            ->groupBy('teachers.id')
            ->get();


        dd($users);

//        if(count($teacher)>0){
//
//            return $teacher;
//        }

        return ["error"=>true,"msg"=>"No credit appointed for this teacher!"];
    }

    // For Teacher wise teacher remaining credit information
    public function ajaxTeacherRemainingCredit($id)
    {
        $teacher = Teacher::find($id);

        $taken_credit = $teacher->credit;

        $remaining_credit_info = CourseAssignTeacher::find($id);

        foreach ($remaining_credit_info as $item){

            $left_credit = $item->remaining_credit;

            if ($left_credit == 0) {

                $rcredit = $taken_credit;

                return ["msg"=>$rcredit];
            }

            else {

                $rcredit = $taken_credit - $left_credit;

                return ["msg"=>$rcredit];
            }
        }
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
            'credit_taken' => 'required',
//            'remaining_credit' => 'required',
            'course_id' => 'required|unique:course_assign_teachers,teacher_id',
            'course_name' => 'required',
            'course_credit' => 'required',
        ]);

        $course_assign_teacher = new CourseAssignTeacher();

        $course_assign_teacher->department_id = $request->department_id;
        $course_assign_teacher->teacher_id = $request->teacher_id;
        $course_assign_teacher->credit_taken = $request->credit_taken;
        $course_assign_teacher->remaining_credit = $request->remaining_credit;
        $course_assign_teacher->course_id = $request->course_id;
        $course_assign_teacher->course_name = $request->course_name;
        $course_assign_teacher->course_credit = $request->course_credit;

        //dd($course_assign_teacher);

        $course_assign_teacher->save();

        return redirect()->route('admin.course_assign_teacher.all')
            ->with('success', 'Course Added Successfully!');
    }
}
