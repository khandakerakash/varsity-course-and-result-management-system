@extends('layouts.admin_master')

@section('title', 'Course Assign Teacher')

@section('content')
    <div class="col-lg-12">
        <h4 class="page-header title text-muted">Course Assign To Teacher</h4>
        @if ($message = Session::get('success'))
            <div id="success_msg_id" class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="coursr_assign_teacher">
            <form class="form-horizontal" action="{{ url('http://varsity.dev/admin/course_assign_teacher/add') }}"
                  method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="department" class="col-sm-2 control-label">Department:</label>
                    <div class="col-sm-7">
                        <select class="form-control department_id" name="department_id" id="department_id">
                            <option id="department_id">Select Department Name</option>
                            @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="teacher_id" class="col-sm-2 control-label ">Teacher:</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="teacher" id="teacher_id" disabled>
                            <option value="">Select Teacher Name</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="credit" class="col-sm-2 control-label ">Credit to be taken:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="teacher_credit" id="teacher_credit" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="credit" class="col-sm-2 control-label ">Remaining Credit:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="teacher_remaining_credit"
                               id="teacher_remaining_credit" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="courses_id" class="col-sm-2 control-label ">Course Code:</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="courses" id="courses_id">
                            <option value="">Select Course Code</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="courses_id" class="col-sm-2 control-label ">Name:</label>
                    <div class="col-sm-7">
                        <input class="form-control" name="course_name" id="course_name" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="courses_id" class="col-sm-2 control-label ">Credit:</label>
                    <div class="col-sm-7">
                        <input class="form-control" name="course_credit" id="course_credit" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-offset-2 col-sm-7">
                        <button type="submit" class="btn btn-primary">Assign</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('myScript')
    <script type="text/javascript">
        /* Department wise dropdown view */
        $('#department_id').on('change', function (e) {

            var department_id = e.target.value;

            $('#teacher_id').removeAttr('disabled');

            $.get('../admin/ajaxTeacher?department_id=' + department_id, function (data) {

//                $('#teacher_id').empty();
//                $('#credit_id').empty();

                $.each(data.teacher, function (index, teacherObj) {

                    $('#teacher_id').append('<option value="' + teacherObj.id + '">' + teacherObj.name + '</option>');
//                    $('#teacher_id').append('<input +teacherObj.credit+>');
                });
                $.each(data.course, function (index, courseObj) {

//                    if ($.isEmptyObject(courseObj)){
//
//                        $('#courses_id').attr('disabled');
//                    }

                    $('#courses_id').append('<option value="' + courseObj.id + '">' + courseObj.code + '</option>');

                });

            })
        });


        $('#courses_id').on('change', function (e) {

            //  debugger;
            var course_id = e.target.value;

            $.ajax({
                //admin.course_assign_teacher.ajaxCourseName
                type: "GET",
                url: '/admin/ajaxCourseName/' + course_id,
                success: function (data) {
                    console.log(data);
                    $("#course_name").val(data.name);
                    $("#course_credit").val(data.credit);

                    // $("#task" + task_id).remove();
                },
                error: function (data) {
                    // console.log('Error:', data);
                }
            });


        });

        $('#teacher_id').on('change', function (e) {

            //  debugger;
            var teacher_id = e.target.value;

            $.ajax({
                //admin.course_assign_teacher.ajaxCourseName
                type: "GET",
                url: '/admin/ajaxCourseCode/' + teacher_id,
                success: function (data) {
                    if(data.hasOwnProperty("error")){
                        alert("data not found");
                    }else{
                        alert("data  found");
                    }


                    // $("#task" + task_id).remove();
                },
                error: function (data) {
                    // console.log('Error:', data);
                }
            });


        });


        /* Add successful message function */
        setTimeout(function () {
            $('#success_msg_id').remove();
        }, 1000);
    </script>
@endsection