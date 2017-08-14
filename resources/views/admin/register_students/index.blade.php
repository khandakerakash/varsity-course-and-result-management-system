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
        <div class="table-responsive">
            <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</button>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th class="text-info">REG. NO.</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Address</th>
                        {{--<th>Reg. Date</th>--}}
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($registered_students as $key => $registered_student)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$registered_student->student_name}}</td>
                        <td>{{$registered_student->department->code}}</td>
                        <td class="text-success">{{$registered_student->registration_number}}</td>
                        <td>{{$registered_student->student_email}}</td>
                        <td>{{$registered_student->student_contact_no}}</td>
                        <td>{{$registered_student->student_address}}</td>
                        {{--<td>{{$registered_student->student_reg_date}}</td>--}}
                        <td>
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#viewModal" onclick="fun_view('{{$registered_student -> id}}')"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editModal" onclick="fun_edit('{{$registered_student -> id}}')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                            <button class="btn btn-sm btn-danger" onclick="fun_delete('{{$registered_student -> id}}')"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $registered_students->links() }}

        <input type="hidden" name="hidden_view" id="hidden_view" value="{{url('http://varsity.dev/admin/register_students/view')}}">
        <input type="hidden" name="hidden_delete" id="hidden_delete" value="{{url('http://varsity.dev/admin/register_students/delete')}}">

        <!-- Add modal code start -->
        <div class="modal fade" id="addModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add new student</h4>
                    </div>
                    <div class="modal-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
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
                                    <input type="date" class="form-control" name="student_reg_date" id="student_reg_date">
                                    {{--<div class='input-group date'  id='student_datetimepicker'>--}}
                                    {{--<input type='text' class="form-control" name="student_reg_date" id="student_reg_date">--}}
                                    {{--<span class="input-group-addon">--}}
                                    {{--<span class="glyphicon glyphicon-calendar"></span>--}}
                                    {{--</span>--}}
                                    {{--</div>--}}
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add modal code ends -->

        <!-- View Modal start -->
        <div class="modal fade" id="viewModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">A single student details</h4>
                    </div>
                    <div class="modal-body">
                        <p><b>Name: </b><span id="view_name" class="text-success"></span></p>
                        <p><b>Department: </b><span id="view_department" class="text-success"></span></p>
                        <p><b>REG. NO.: </b><span id="view_reg_no" class="text-success"></span></p>
                        <p><b>Email: </b><span id="view_email" class="text-success"></span></p>
                        <p><b>Contact: </b><span id="view_contact_no" class="text-success"></span></p>
                        <p><b>Address: </b><span id="view_address" class="text-success"></span></p>
                        <p><b>Reg. Date: </b><span id="view_reg_date" class="text-success"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- view modal ends -->

        <!-- Edit Modal start -->
        <div class="modal fade" id="editModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit student</h4>
                    </div>
                    <div class="modal-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="form-horizontal validate-form" action="{{route('admin.register_students.update')}}" method="post">
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
                                    <input type="date" class="form-control" name="student_reg_date" id="student_reg_date">
                                    {{--<div class='input-group date'  id='student_datetimepicker'>--}}
                                    {{--<input type='text' class="form-control" name="student_reg_date" id="student_reg_date">--}}
                                    {{--<span class="input-group-addon">--}}
                                    {{--<span class="glyphicon glyphicon-calendar"></span>--}}
                                    {{--</span>--}}
                                    {{--</div>--}}
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
                                    <button type="submit" class="btn btn-primary">Save Change</button>
                                </div>
                            </div>
                            <input type="hidden" id="edit_id" name="id">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit code ends -->
    </div>
@endsection

@section('myScript')
    <script type="text/javascript">

        /* Register Students view function */
        function fun_view(id) {
            var view_url = $("#hidden_view").val();
            $.ajax({
                url: view_url,
                type: "GET",
                data: {"id": id},
                success: function (result) {
                    //console.log(result);
                    $("#view_name").text(result.student_name);
                    $("#view_department").text(result.department.name);
                    $("#view_reg_no").text(result.registration_number);
                    $("#view_email").text(result.student_email);
                    $("#view_contact_no").text(result.student_contact_no);
                    $("#view_address").text(result.student_address);
                    $("#view_reg_date").text(result.student_reg_date);
                }
            });
        }

        /* Student edit function */
        function fun_edit(id)
        {
            var view_url = $("#hidden_view").val();
            $.ajax({
                url: view_url,
                type:"GET",
                data: {"id":id},
                success: function(result){
                    //console.log(result);
                    $("#edit_id").val(result.id);
                    $("#student_name").val(result.student_name);
                    $("#student_email").val(result.student_email);
                    $("#student_contact_no").val(result.student_contact_no);
                    $("#student_reg_date").val(result.student_reg_date);
                    $("#student_address").val(result.student_address);
                    $("#department_id").val(result.department_id);
                }
            });
        }

        /* Register Student delete function */
        function fun_delete(id)
        {
            var conf = confirm("Are you sure want to delete??");
            if(conf){
                var delete_url = $("#hidden_delete").val();
                $.ajax({
                    url: delete_url,
                    type:"POST",
                    data: {"id":id,_token: "{{ csrf_token() }}"},
                    success: function(response){
                        alert(response);
                        location.reload();
                    }
                });
            }
            else{
                return false;
            }
        }


        /* Date picker */
        $(function () {
            $('#student_datetimepicker').datetimepicker({
                viewMode: 'years'
            });
        });

        /* Add successful message function */
        setTimeout(function () {
            $('#success_msg_id').remove();
        }, 1000);
    </script>
@endsection
