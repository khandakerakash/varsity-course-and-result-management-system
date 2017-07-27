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
            <form class="form-horizontal" action="{{ url('http://varsity.dev/admin/course_assign_teacher/add') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="department" class="col-sm-2 control-label">Department:</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="department" id="department">
                            <option id="department_id">Select Department Name</option>
                            @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="teacher_id" class="col-sm-2 control-label">Teacher:</label>
                    <div class="col-sm-7">
                        <select class="form-control" name="teacher" id="teacher">
                            <option value=""></option>
                        </select>
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

@section('mYscript')
    <script>
        $('#department').on('change', function (e) {
                //console.log(e);

            var department_id = e.target.value;

            //ajax
            $.get('/ajaxTeacher?department_id=' + department_id, function (data) {
                //success data
                $('#teacher').empty();
                $.each(data, function (index, teacherObj) {

                    $('#teacher').append('<option value="'+teacherObj.id+'teacherObj.name'+'"></option>')
                });

            });

        });

        /* Add successful message function */
        setTimeout(function () {
            $('#success_msg_id').remove();
        }, 1000);
    </script>
@endsection
