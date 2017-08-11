<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\RegisterStudent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterStudentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('admin.register_students.index', compact('departments', $departments));
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'student_name' => 'required',
            'student_email' => 'required|unique:register_students,student_email',
            'student_contact_no' => 'required|unique:register_students,student_contact_no',
            'student_reg_date' => 'required',
            'student_address' => 'required',
            'department_id' => 'required|unique:register_students,department_id',
        ]);

        $register_students = new RegisterStudent();

        $register_students->student_name = $request->student_name;
        $register_students->student_email = $request->student_email;
        $register_students->student_contact_no = $request->student_contact_no;
        $register_students->student_reg_date = $request->student_reg_date;
        $register_students->student_address = $request->student_address;
        $register_students->department_id = $request->department_id;

        $dept_id = $request->department_id;

        $student_department = Department::findOrfail($dept_id);

        dd($student_department->code);

//        $registration_number = $register_students->department_id."-".date("Y")."-".$register_students->register_students_id;
//
//        dd($registration_number);

//        ."-".$student_id

//        $register_students->registration_number = $request->registration_number;
    }
}
