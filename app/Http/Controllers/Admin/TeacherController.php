<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Designation;
use App\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    /*
     * View all teachers data
     */
    public function teachers()
    {
        $teachers = Teacher::with('department','designation')->orderBy('created_at', 'desc')->paginate(3);
        return view('admin.teachers.teachers', ['teachers' => $teachers]);
    }

    /*
     * View teacher add form
     */
    public function teacherAddForm()
    {
        $designations = Designation::all(['id', 'title']);

        $departments = Department::all(['id', 'name']);

        return view('admin.teachers.add_new_teacher', compact(['departments', $departments, 'designations', $designations]));
    }


    /*
     * Add teacher data
     */
    public function add(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|unique:teachers,email',
            'contact_no' => 'required',
            'credit' => 'required',
        ]);

        $teacher = new Teacher();

        $teacher->name = $request->name;
        $teacher->address = $request->address;
        $teacher->email = $request->email;
        $teacher->contact_no = $request->contact_no;
        $teacher->designation_id = $request->designation_id;
        $teacher->department_id = $request->department_id;
        $teacher->credit = $request->credit;

        $teacher->save();

        return back()
            ->with('success', 'Teacher Added Successfully!');
    }

    /*
     * View teacher data
     */
    public function view(Request $request)
    {
        if ($request->ajax()){

            $id = $request->id;
            $info = Teacher::find($id);

            return response()->json($info);
        }
    }

    /*
     * Delete department data
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $teacher = Teacher::find($id);

        $response = $teacher->delete();

        if ($response)
            echo "Teacher Deleted Successfully!";
        else
            echo "There was a problem. Please try again later.";
    }
}
