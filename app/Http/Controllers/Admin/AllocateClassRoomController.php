<?php

namespace App\Http\Controllers\Admin;

use App\AllocateClassRoom;
use App\Course;
use App\Day;
use App\Department;
use App\RoomNo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllocateClassRoomController extends Controller
{
    public function index()
    {
        $departments = Department::all(['id', 'name']);

        $courses = Course::all('id', 'name');

        $rooms = RoomNo::all('id', 'room_code');

        $days = Day::all('id', 'title');

        return view('admin.allocate_class_rooms.index', compact(['departments', $departments, 'courses', $courses, 'rooms', $rooms, 'days', $days]));
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'department_id' => 'required',
            'course_id' => 'required',
            'room_no_id' => 'required',
            'day_id' => 'required',
            'start_time' => 'required',
            'start_time_radio' => 'required',
            'end_time' => 'required',
            'end_time_radio' => 'required',
        ]);

        $allocate_class_room = new AllocateClassRoom();

        $allocate_class_room->department_id = $request->department_id;
        $allocate_class_room->course_id = $request->course_id;
        $allocate_class_room->room_no_id = $request->room_no_id;
        $allocate_class_room->day_id = $request->day_id;
        $allocate_class_room->start_time = $request->start_time;
        $allocate_class_room->start_time_radio = $request->start_time_radio;
        $allocate_class_room->end_time = $request->end_time;
        $allocate_class_room->end_time_radio = $request->end_time_radio;

//        dd($allocate_class_room);

        $allocate_class_room->save();

        return redirect()->route('admin.allocate_class_rooms.all')
            ->with('success', 'Class Room Allocated Successfully!');
    }
}
