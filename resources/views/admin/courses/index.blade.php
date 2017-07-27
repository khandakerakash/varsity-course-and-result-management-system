@extends('layouts.admin_master')

@section('title', 'Course')

@section('content')
    <div class="col-lg-12">
        <h4 class="page-header title text-muted">Course Information</h4>
        @if ($message = Session::get('success'))
            <div id="success_msg_id" class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="table-responsive">
            <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</button>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Credit</th>
                    <th>Description</th>
                    <th>Department</th>
                    <th>Semester</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($courses as $key => $course)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$course->code}}</td>
                        <td>{{$course->name}}</td>
                        <td>{{$course->credit}}</td>
                        <td>{{$course->description}}</td>
                        <td>{{$course->department->name}}</td>
                        <td>{{$course->semester->title}}</td>
                        <td>
                            <button class="btn btn-info" data-toggle="modal" data-target="#viewModal" onclick="fun_view('{{$course -> id}}')"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick="fun_edit('{{$course -> id}}')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                            <button class="btn btn-danger" onclick="fun_delete('{{$course -> id}}')"><i
                                        class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $courses->links() }}

        <input type="hidden" name="hidden_view" id="hidden_view" value="{{url('http://varsity.dev/admin/course/view')}}">
        <input type="hidden" name="hidden_delete" id="hidden_delete" value="{{url('http://varsity.dev/admin/course/delete')}}">

        <!-- Add modal code start -->
        <div class="modal fade" id="addModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add new course</h4>
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
                        <form action="{{ url('http://varsity.dev/admin/course/add') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                {{Form::label('code', 'Code', ['class' => 'col-sm-2', 'control-label'])}}
                                <div class="col-sm-7">
                                    {{ Form::text('code', null, ['class' => 'form-control', 'placeholder' => 'Write a subject code']) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('name', 'Name', ['class' => 'col-sm-2', 'control-label'])}}
                                <div class="col-sm-7">
                                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Write a subject name']) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('credit', 'Credit', ['class' => 'col-sm-2', 'control-label'])}}
                                <div class="col-sm-7">
                                    {{ Form::text('credit', null, ['class' => 'form-control', 'placeholder' => 'Write a subject credit']) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('description', 'Description', ['class' => 'col-sm-2', 'control-label'])}}
                                <div class="col-sm-7">
                                    {{ Form::textarea('description', null, ['class' => 'form-control',  'rows' => '3', 'placeholder' => 'Write a subject description']) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('department_id', 'Department', ['class' => 'col-sm-2', 'control-label'])}}
                                <div class="col-sm-7">
                                    <select class="form-control" name="department_id">
                                        <option>Select Department Name</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('semester_id', 'Semester', ['class' => 'col-sm-2', 'control-label'])}}
                                <div class="col-sm-7">
                                    {{--{{Form::select('designation', ['L' => 'Large', 'S' => 'Small'], null, ['class' => 'form-control', 'placeholder' => 'Select Designation Title'])}}--}}
                                    <select class="form-control" name="semester_id">
                                        <option>Select Designations Title</option>
                                        @foreach($semesters as $semester)
                                            <option value="{{$semester->id}}">{{$semester->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-offset-2 col-sm-7">
                                    <button type="submit" class="btn btn-primary">Save</button>
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
                        <h4 class="modal-title">A single teacher profile</h4>
                    </div>
                    <div class="modal-body">
                        <p><b>Code: </b><span id="view_code" class="text-success"></span></p>
                        <p><b>Name: </b><span id="view_name" class="text-success"></span></p>
                        <p><b>Credit: </b><span id="view_credit" class="text-success"></span></p>
                        <p><b>Description: </b><span id="view_description" class="text-success"></span></p>
                        <p><b>Department: </b><span id="view_department" class="text-success"></span></p>
                        <p><b>Semester: </b><span id="view_semester" class="text-success"></span></p>
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
                        <h4 class="modal-title">Edit course</h4>
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
                        <form action="{{ url('http://varsity.dev/admin/course/update') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                {{Form::label('code', 'Code', ['class' => 'col-sm-2', 'control-label'])}}
                                <div class="col-sm-7">
                                    {{ Form::text('code', null, ['id' => 'edit_code', 'class' => 'form-control', 'placeholder' => 'Write a subject code']) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('name', 'Name', ['class' => 'col-sm-2', 'control-label'])}}
                                <div class="col-sm-7">
                                    {{ Form::text('name', null, ['id' => 'edit_name', 'class' => 'form-control', 'placeholder' => 'Write a subject name']) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('credit', 'Credit', ['class' => 'col-sm-2', 'control-label'])}}
                                <div class="col-sm-7">
                                    {{ Form::text('credit', null, ['id' => 'edit_credit', 'class' => 'form-control', 'placeholder' => 'Write a subject credit']) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('description', 'Description', ['class' => 'col-sm-2', 'control-label'])}}
                                <div class="col-sm-7">
                                    {{ Form::textarea('description', null, ['id' => 'edit_description', 'class' => 'form-control',  'rows' => '3', 'placeholder' => 'Write a subject description']) }}
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('department_id', 'Department', ['class' => 'col-sm-2', 'control-label'])}}
                                <div class="col-sm-7">
                                    <select class="form-control" name="department_id">
                                        <option id="edit_department">Select Department Name</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                {{Form::label('semester_id', 'Semester', ['class' => 'col-sm-2', 'control-label'])}}
                                <div class="col-sm-7">
                                    <select class="form-control" name="semester_id">
                                        <option id="edit_semester">Select Designations Title</option>
                                        @foreach($semesters as $semester)
                                            <option value="{{$semester->id}}">{{$semester->title}}</option>
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
    <!-- /.col-lg-12 -->
@endsection

@section('myScript')
    <script type="text/javascript">

        /* Course view function */
        function fun_view(id)
        {
            var view_url = $("#hidden_view").val();
            $.ajax({
                url: view_url,
                type:"GET",
                data: {"id":id},
                success: function(result){
                    //console.log(result);
                    $("#view_code").text(result.code);
                    $("#view_name").text(result.name);
                    $("#view_credit").text(result.credit);
                    $("#view_description").text(result.description);
                    $("#view_department").text(result.department.name);
                    $("#view_semester").text(result.semester.title);
                }
            });
        }

        /* Course edit function */
        function fun_edit(id)
        {
            var view_url = $("#hidden_view").val();
            $.ajax({
                url: view_url,
                type:"GET",
                data: {"id":id},
                success: function(result){
                    //console.log(result);
                    $("#edit_code").val(result.code);
                    $("#edit_name").val(result.name);
                    $("#edit_credit").val(result.credit);
                    $("#edit_description").val(result.description);
                    $("#edit_department").val(result.department.name);
                    $("#edit_semester").val(result.semester.title);
                }
            });
        }

        /* Course delete function */
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

        /* Add successful message function */
        setTimeout(function(){
            $('#success_msg_id').remove();
        }, 1000);

    </script>
@endsection