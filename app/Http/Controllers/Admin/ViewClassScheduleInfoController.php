<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ViewClassScheduleInfoController extends Controller
{
    public function index()
    {
        $departments = Department::all();

        return view('admin.view_class_schedule_allocation_room_Info.index')
            ->with('departments', $departments);
    }

    public function ajaxDepartmentClassSchedule($id)
    {
        $class_schedule_info = DB::table('departments')
            ->join('allocate_class_rooms', 'departments.id', '=', 'allocate_class_rooms.department_id')
            ->where('departments.id',$id)
            ->get();

//        dd($class_schedule_info);
//
        return $class_schedule_info;

//        return $data = ['class_schedule_info', $class_schedule_info];
    }
}
