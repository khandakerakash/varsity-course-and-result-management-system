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
    public function index()
    {
        $teachers = Teacher::with('department','designation')->orderBy('created_at', 'desc')->paginate(3);
        $designations = Designation::all(['id', 'title']);
        $departments = Department::all(['id', 'name']);
        return view('admin.teachers.index', compact(['teachers', $teachers, 'departments', $departments, 'designations', $designations]));
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
            $info = Teacher::with('designation','department')->find($id);

            return response()->json($info);
        }
    }

    /*
     * Teacher edit form
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'contact_no' => 'required',
            'credit' => 'required',
        ]);

        $id = $request->id;
        $teacher = Teacher::find($id);

        $teacher->name = $request->name;
        $teacher->address = $request->address;
        $teacher->email = $request->email;
        $teacher->contact_no = $request->contact_no;
        $teacher->designation_id = $request->designation_id;
        $teacher->department_id = $request->department_id;
        $teacher->credit = $request->credit;

        $teacher->save();


        return back()
            ->with('success', 'Teacher Updated Successfully!');
    }

    /*
     * Delete teacher data
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
