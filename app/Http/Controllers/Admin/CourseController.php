<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Department;
use App\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /*
     * View all course data
     */
    public function index()
    {
        $courses = Course::with('department','semester')->orderBy('created_at', 'desc')->paginate(4);
        $departments = Department::all(['id', 'name']);
        $semesters = Semester::all(['id', 'title']);
        return view('admin.courses.index', compact(['courses', $courses, 'departments', $departments, 'semesters', $semesters]));
    }

    /*
     * Add teacher data
     */
    public function add(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:courses,code',
            'name' => 'required',
            'credit' => 'required',
            'description' => 'required',
            'department_id' => 'required',
            'semester_id' => 'required',
        ]);

        $course = new Course();

        $course->code = $request->code;
        $course->name = $request->name;
        $course->credit = $request->credit;
        $course->description = $request->description;
        $course->department_id = $request->department_id;
        $course->semester_id = $request->semester_id;

        $course->save();

        return back()
            ->with('success', 'Course Added Successfully!');
    }

    /*
     * View course data
     */
    public function view(Request $request)
    {
        if ($request->ajax()){

            $id = $request->id;
            $info = Course::with('department', 'semester')->find($id);

            return response()->json($info);
        }
    }

    /*
     *  Edit Course data
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'name' => 'required',
            'credit' => 'required',
            'description' => 'required',
            'department_id' => 'required',
            'semester_id' => 'required',
        ]);

        $id = $request->id;
        $course = Course::find($id);

        $course->code = $request->code;
        $course->name = $request->name;
        $course->credit = $request->credit;
        $course->description = $request->description;
        $course->department_id = $request->department_id;
        $course->semester_id = $request->semester_id;

        $course->save();

        return redirect()->route('admin.course.all')
            ->with('success', 'Course Updated Successfully!');
    }

    /*
     * Delete course data
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $course = Course::find($id);

        $response = $course->delete();

        if ($response)
            echo "Teacher Deleted Successfully!";
        else
            echo "There was a problem. Please try again later.";
    }
}
