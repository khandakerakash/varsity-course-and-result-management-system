<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\RegisteredStudent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RegisterStudentController extends Controller
{
    public function index()
    {
        $registered_students = RegisteredStudent::with('department')->orderBy('created_at', 'desc')->paginate(5);

        $departments = Department::all();

        return view('admin.register_students.index', compact(['registered_students', $registered_students, 'departments', $departments]));
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'student_name' => 'required',
            'student_email' => 'required|unique:registered_students,student_email',
            'student_contact_no' => 'required|unique:registered_students,student_contact_no',
            'student_reg_date' => 'required',
            'student_address' => 'required',
            'department_id' => 'required',
        ]);

        $register_students = new RegisteredStudent();


        $register_students->student_name = $request->student_name;
        $register_students->student_email = $request->student_email;
        $register_students->student_contact_no = $request->student_contact_no;
        $register_students->student_reg_date = $request->student_reg_date;
        $register_students->student_address = $request->student_address;
        $register_students->department_id = $request->department_id;

        $register_students->save();

        $dept_id = $request->department_id;
        $student_department = Department::findOrfail($dept_id);
        $get_student_id = $register_students->id;

        $registration_number = $student_department->code."-".date("Y")."-"."00".$get_student_id;


        DB::table('registered_students')
            ->where('id',$get_student_id)
            ->update([
                'registration_number'=>$registration_number
            ]);

        return redirect()->route('admin.register_students.all')
            ->with('success', 'Student Added Successfully! And Your Reg. No.    '.$registration_number);
    }

    /*
     * View student data
     */
    public function view(Request $request)
    {
        if ($request->ajax()){

            $id = $request->id;
            $info = RegisteredStudent::with('department')->find($id);

            return response()->json($info);
        }
    }

    /*
     * Student edit form
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'student_name' => 'required',
            'student_email' => 'required',
            'student_contact_no' => 'required',
            'student_reg_date' => 'required',
            'student_address' => 'required',
            'department_id' => 'required',
        ]);

        $id = $request->id;
        $register_students = RegisteredStudent::find($id);

        //dd($register_students);

        $register_students->student_name = $request->student_name;
        $register_students->student_email = $request->student_email;
        $register_students->student_contact_no = $request->student_contact_no;
        $register_students->student_reg_date = $request->student_reg_date;
        $register_students->student_address = $request->student_address;
        $register_students->department_id = $request->department_id;

        $register_students->save();


        return redirect()->route('admin.register_students.all')
            ->with('success', 'Register Studnets Updated Successfully!');
    }

    /*
     * Delete teacher data
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $teacher = RegisteredStudent::find($id);

        $response = $teacher->delete();

        if ($response)
            echo "Register Student Deleted Successfully!";
        else
            echo "There was a problem. Please try again later.";
    }

}
