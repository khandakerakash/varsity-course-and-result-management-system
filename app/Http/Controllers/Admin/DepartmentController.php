<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /*
    * View all departments data
    */
    public function departments()
    {
        $departments = DB::table('departments')->orderBy('created_at', 'desc')->paginate(5);
        return view('admin.departments.departments', ['departments' => $departments]);
    }

    /*
     * Add department data
     */
    public function add(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:departments,code|max:7',
            'name' => 'required|unique:departments,name|max:100',
        ]);

        $department = new Department();
        $department->name = $request->name;
        $department->code = $request->code;

        $department->save();

        return back()
            ->with('success', 'Department Added Successfully!');
    }

    /*
     * View department data
     */
    public function view(Request $request)
    {
        if ($request->ajax()){

            $id = $request->id;
            $info = Department::find($id);

            return response()->json($info);
        }
    }

    /*
     * Edit department data
     */
    public function update(Request $request)
    {

        $id = $request->edit_id;
        $department = Department::find($id);

        $department->code = $request->edit_code;
        $department->name = $request->edit_name;

        $department->save();


        return back()
            ->with('success', 'Department Updated Successfully!');

    }

    /*
     * Delete department data
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $department = Department::find($id);

        $response = $department->delete();

        if ($response)
            echo "Department Deleted Successfully!";
        else
            echo "There was a problem. Please try again later.";
    }
}
