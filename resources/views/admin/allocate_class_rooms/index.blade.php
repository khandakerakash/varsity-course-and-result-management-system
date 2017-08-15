@extends('layouts.admin_master')

@section('title', 'Allocate Class Room')

@section('content')
    <div class="col-lg-12">
        <h4 class="page-header title text-muted">Allocate Class Rooms</h4>
        @if ($message = Session::get('success'))
            <div id="success_msg_id" class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <form action="{{ route('admin.allocate_class_rooms.add') }}" method="post"
              class="validate-form">
            {{ csrf_field() }}
            <div class="form-group row">
                <label for="department_id" class="control-label col-sm-2">Department</label>
                <div class="col-sm-7">
                    <select class="form-control" name="department_id" id="department_id">
                        <option>Select Department Name</option>
                        @foreach($departments as $department)
                            <option value="{{$department->id}}">{{$department->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="course_id" class="control-label col-sm-2">Course:</label>
                <div class="col-sm-7">
                    <select class="form-control" name="course_id" id="course_id">
                        <option>Select Course Name</option>
                        @foreach($courses as $course)
                            <option value="{{$course->id}}">{{$course->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="room_no_id" class="control-label col-sm-2">Room No.:</label>
                <div class="col-sm-7">
                    <select class="form-control" name="room_no_id" id="room_no_id">
                        <option>Select Room No.</option>
                        @foreach($rooms as $room)
                            <option value="{{$room->id}}">{{$room->room_code}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="semester_id" class="control-label col-sm-2">Day:</label>
                <div class="col-sm-7">
                    <select class="form-control" name="day_id" id="day_id">
                        <option>Select a Day Title</option>
                        @foreach($days as $day)
                            <option value="{{$day->id}}">{{$day->title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="start_time" class="control-label col-sm-2">From:</label>
                <div class="col-sm-7">
                    <input type="text" name="start_time" id="start_time" class="form-control"
                           required="required" placeholder="Write beginning time. For Example 09:00">
                    <label>
                        <input type="radio" name="start_time_radio" id="time_radio" value="1" checked>AM
                        <input type="radio" name="start_time_radio" id="time_radio" value="0" checked>PM
                    </label>
                </div>
            </div>
            <div class="form-group row">
                <label for="start_time" class="control-label col-sm-2">To:</label>
                <div class="col-sm-7">
                    <input type="text" name="end_time" id="end_time" class="form-control"
                           required="required" placeholder="Write ending time. For Example 10:00">
                    <label>
                        <input type="radio" name="end_time_radio" id="time_radio" value="1" checked>AM
                        <input type="radio" name="end_time_radio" id="time_radio" value="0" checked>PM
                    </label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-offset-2 col-sm-7">
                    <button type="submit" class="btn btn-primary">Allocate</button>
                </div>
            </div>
        </form>
    </div>
@endsection


@section('myScript')
    <script type="text/javascript">
        /* Department wise dropdown view */
//        $('#department_id').on('change', function (e) {
//
//            var department_id = e.target.value;
//
//            $('#teacher_id').removeAttr('disabled');
//            $('#courses_id').removeAttr('disabled');
//
//            $.get('../admin/ajaxTeacherCourse?department_id=' + department_id, function (data) {
//
//                $('#teacher_id').empty();
//                $('#teacher_id').append('<option>Select Teacher Name</option>');
//                $('#courses_id').empty();
//                $('#courses_id').append('<option>Select Course Code</option>');
//
//                $.each(data.teacher, function (index, teacherObj) {
//
//                    $('#teacher_id').append('<option value="' + teacherObj.id + '">' + teacherObj.name + '</option>');
//
//                });
//
//                $.each(data.course, function (index, courseObj) {
//
//                    $('#courses_id').append('<option value="' + courseObj.id + '">' + courseObj.code + '</option>');
//
//                });
//
//            })
//        });
//
//
//        /* Teacher wise credit */
//        $('#teacher_id').on('change', function (e) {
//
//            var teacher_id = e.target.value;
//
//            $('#teacher_credit').removeAttr('disabled');
//            $('#teacher_remaining_credit').removeAttr('disabled');
//
//            $.ajax({
//                type: "GET",
//                url: '/admin/ajaxTeacherCredit/' + teacher_id,
//                success: function (credit_data) {
//
//                    $('#teacher_credit').val(credit_data.teacher_actual_credit);
//
//                    $('#teacher_remaining_credit').val(credit_data.remaining_credit_result);
//
//                },
//                error: function ($credit_data) {
//                    // console.log('Error:', data);
//                }
//            });
//        });
//
//        /* Course wise course name and credit */
//        $('#courses_id').on('change', function (e) {
//
//            var course_id = e.target.value;
//
//            $('#course_name').removeAttr('disabled');
//            $('#course_credit').removeAttr('disabled');
//
//            $.ajax({
//                type: "GET",
//                url: '/admin/ajaxCourseName/' + course_id,
//                success: function (data) {
//
//                    $("#course_name").val(data.name);
//                    $("#course_credit").val(data.credit);
//                },
//                error: function (data) {
//                    // console.log('Error:', data);
//                }
//            });
//
//
//        });
//
        // validate allocate class rooms add form on keyup and submit
        $(".validate-form").validate({
            rules: {
                department_id: "required",
                course_id: "required",
                room_no_id: "required",
                day_id: "required",
                start_time: "required",
                start_time_radio: "required",
                end_time: "required",
                end_time_radio: "required"
            },
            messages: {
                department_id: "Please select department",
                course_id: "Please select course",
                room_no_id: "Please select room no",
                day_id: "Please select day",
                start_time: "Please write beginning time",
                start_time_radio: "Please checked beginning time AM/PM",
                end_time: "Please write ending time",
                end_time_radio: "Please checked ending time AM/PM"
            }
        });

        /* Add successful message function */
        setTimeout(function () {
            $('#success_msg_id').remove();
        }, 1000);
    </script>
@endsection