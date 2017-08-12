@extends('layouts.admin_master')

@section('title', 'Register Studnet')

@section('content')
    <div class="col-lg-12">
        <h4 class="page-header title text-muted">Register Students</h4>
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
            <form class="form-horizontal validate-form" action="{{route('admin.register_students.add')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="student_name" class="col-sm-2 control-label ">Name:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="student_name" id="student_name" placeholder="Write a student name" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="student_email" class="col-sm-2 control-label ">Email:</label>
                    <div class="col-sm-7">
                        <input type="email" class="form-control" name="student_email" id="student_email" placeholder="Write an email address" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="student_contact_no" class="col-sm-2 control-label ">Contact No:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="student_contact_no" id="student_contact_no" placeholder="Write a contact number" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="student_reg_date" class="col-sm-2 control-label ">Date:</label>
                    <div class="col-sm-7">
                        {{--<input type="date" class="form-control" name="student_reg_date" id="student_reg_date">--}}
                        <div class='input-group date'  id='student_datetimepicker'>
                            <input type='text' class="form-control" name="student_reg_date" id="student_reg_date">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="student_address" class="col-sm-2 control-label ">Address:</label>
                    <div class="col-sm-7">
                        <textarea class="form-control" name="student_address" id="student_address" rows="3" placeholder="Write an address" required="required"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="department_id" class="col-sm-2 control-label">Department:</label>
                    <div class="col-sm-7">
                        <select class="form-control department_id" name="department_id" id="department_id">
                            <option id="department_id">Select Department Name</option>
                            @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-offset-2 col-sm-7">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('myScript')
    <script type="text/javascript">
        $(function () {
            $('#student_datetimepicker').datetimepicker({
                viewMode: 'years'
            });
        });
    </script>
@endsection
