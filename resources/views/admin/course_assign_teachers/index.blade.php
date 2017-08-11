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
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="coursr_assign_teacher">
            <form class="form-horizontal validate-form" action="{{route('admin.course_assign_teacher.add')}}" method="post">
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
                        <select class="form-control" name="teacher_id" id="teacher_id" disabled="disabled">
                            <option value="">Select Teacher Name</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="credit" class="col-sm-2 control-label ">Credit to be taken:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="credit_taken" id="teacher_credit" readonly="readonly" disabled="disabled">
                    </div>
                </div>
                <div class="form-group">
                    <label for="credit" class="col-sm-2 control-label ">Remaining Credit:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="remaining_credit"
                               id="teacher_remaining_credit" readonly="readonly" disabled="disabled">
                    </div>
                </div>
                <div class="form-group">
                    <label for="courses_id" class="col-sm-2 control-label ">Course Code:</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="course_id" id="courses_id" disabled="disabled">
                            <option value="">Select Course Code</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="courses_id" class="col-sm-2 control-label ">Name:</label>
                    <div class="col-sm-7">
                        <input class="form-control" name="course_name" id="course_name" readonly="readonly" disabled="disabled">
                    </div>
                </div>
                <div class="form-group">
                    <label for="courses_id" class="col-sm-2 control-label ">Credit:</label>
                    <div class="col-sm-7">
                        <input class="form-control" name="course_credit" id="course_credit" readonly="readonly" disabled="disabled">
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
            $('#courses_id').removeAttr('disabled');

            $.get('../admin/ajaxTeacherCourse?department_id=' + department_id, function (data) {

                $('#teacher_id').empty();
                $('#teacher_id').append('<option>Select Teacher Name</option>');
                $('#courses_id').empty();
                $('#courses_id').append('<option>Select Course Code</option>');

                $.each(data.teacher, function (index, teacherObj) {

                    $('#teacher_id').append('<option value="' + teacherObj.id + '">' + teacherObj.name + '</option>');

                });

                $.each(data.course, function (index, courseObj) {

                    $('#courses_id').append('<option value="' + courseObj.id + '">' + courseObj.code + '</option>');

                });

            })
        });


        /* Teacher wise credit */
        $('#teacher_id').on('change', function (e) {

            var teacher_id = e.target.value;

            $('#teacher_credit').removeAttr('disabled');
            $('#teacher_remaining_credit').removeAttr('disabled');

            $.ajax({
                type: "GET",
                url: '/admin/ajaxTeacherCredit/' + teacher_id,
                success: function (credit_data) {

                    $('#teacher_credit').val(credit_data.teacher_actual_credit);

                    $('#teacher_remaining_credit').val(credit_data.remaining_credit_result);

                },
                error: function ($credit_data) {
                    // console.log('Error:', data);
                }
            });
        });

        /* Course wise course name and credit */
        $('#courses_id').on('change', function (e) {

            var course_id = e.target.value;

            $('#course_name').removeAttr('disabled');
            $('#course_credit').removeAttr('disabled');

            $.ajax({
                type: "GET",
                url: '/admin/ajaxCourseName/' + course_id,
                success: function (data) {

                    $("#course_name").val(data.name);
                    $("#course_credit").val(data.credit);
                },
                error: function (data) {
                    // console.log('Error:', data);
                }
            });


        });

        // validate course assign to teacher add form on keyup and submit
        $(".validate-form").validate({
            rules: {
                department_id: "required",
                teacher_id: "required",
                credit_taken: "required",
                remaining_credit: "required",
                course_id: "required",
                course_name: "required",
                course_credit: "required"
            },
            messages: {
                department_id: "Please select department",
                teacher_id: "Please select teacher name",
                credit_taken: "Credit must be required",
                remaining_credit: "Credit must be required",
                course_id: "Please select course code",
                course_name: "Course name must be required",
                course_credit: "Course credit must be required"
            }
        });

        /* Add successful message function */
        setTimeout(function () {
            $('#success_msg_id').remove();
        }, 1000);
    </script>
@endsection