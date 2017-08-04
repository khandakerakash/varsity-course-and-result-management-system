@extends('layouts.admin_master')

@section('title', 'Teachers')

@section('content')
    <div class="col-lg-12">
        <h4 class="page-header title text-muted">Faculty Members</h4>
        @if ($message = Session::get('success'))
            <div id="success_msg_id" class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="table-responsive">
            <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#addModal">
                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add
            </button>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Department</th>
                    <th>Credit</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($teachers as $key => $teacher)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$teacher->name}}</td>
                        <td>{{$teacher->designation->title}}</td>
                        <td>{{$teacher->department->name}}</td>
                        <td>{{$teacher->credit}}</td>
                        <td>{{$teacher->address}}</td>
                        <td>{{$teacher->email}}</td>
                        <td>{{$teacher->contact_no}}</td>
                        <td>
                            <button class="btn btn-info" data-toggle="modal" data-target="#viewModal"
                                    onclick="fun_view('{{$teacher -> id}}')"><i class="fa fa-eye"
                                                                                aria-hidden="true"></i> View
                            </button>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#editModal"
                                    onclick="fun_edit('{{$teacher -> id}}')"><i class="fa fa-pencil-square-o"
                                                                                aria-hidden="true"></i> Edit
                            </button>
                            <button class="btn btn-danger" onclick="fun_delete('{{$teacher -> id}}')"><i
                                        class="fa fa-trash-o" aria-hidden="true"></i> Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $teachers->links() }}

        <input type="hidden" name="hidden_view" id="hidden_view"
               value="{{url('http://varsity.dev/admin/teacher/view')}}">
        <input type="hidden" name="hidden_delete" id="hidden_delete"
               value="{{url('http://varsity.dev/admin/teacher/delete')}}">

        <!-- Add modal code start -->
        <div class="modal fade" id="addModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add new teacher</h4>
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
                        <form action="{{ url('http://varsity.dev/admin/teacher/add') }}" method="post"
                              class="department-validate-form">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="name" class="control-label col-sm-2">Name:</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="name"
                                           placeholder="Write a teacher name" required="required">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="control-label col-sm-2">Address:</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="address" rows="3"
                                              placeholder="Write an address" required="required"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="control-label col-sm-2">Email:</label>
                                <div class="col-sm-7">
                                    <input type="email" class="form-control" name="email" placeholder="Write an email"
                                           required="required">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="contact_no" class="control-label col-sm-2">Contact:</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="contact_no"
                                           placeholder="Write a contact number" required="required">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="designation_id" class="control-label col-sm-2">Designation:</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="designation_id">
                                        <option>Select Designations Title</option>
                                        @foreach($designations as $designation)
                                            <option name="designation_id"
                                                    value="{{$designation->id}}">{{$designation->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="department_id" class="control-label col-sm-2">Department:</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="department_id">
                                        <option>Select Department Name</option>
                                        @foreach($departments as $department)
                                            <option name="department_id"
                                                    value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="credit" class="control-label col-sm-2">Credit to be taken:</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" name="credit" placeholder="Write credit"
                                           required="required">
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
                        <p><b>Name: </b><span id="view_name" class="text-success"></span></p>
                        <p><b>Designation: </b><span id="view_designation" class="text-success"></span></p>
                        <p><b>Department: </b><span id="view_department" class="text-success"></span></p>
                        <p><b>Credit: </b><span id="view_credit" class="text-success"></span></p>
                        <p><b>Address: </b><span id="view_address" class="text-success"></span></p>
                        <p><b>Email: </b><span id="view_email" class="text-success"></span></p>
                        <p><b>Contact: </b><span id="view_contact_no" class="text-success"></span></p>
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
                        <h4 class="modal-title">Edit teacher</h4>
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
                        <form action="{{ url('http://varsity.dev/admin/teacher/update') }}" method="post"
                              class="department-validate-form">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="name" class="control-label col-sm-2">Name:</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="edit_name" name="name"
                                           placeholder="Write a teacher name" required="required">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="control-label col-sm-2">Address:</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="address" id="edit_address" rows="3"
                                              placeholder="Write an address" required="required"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="control-label col-sm-2">Email:</label>
                                <div class="col-sm-7">
                                    <input type="email" class="form-control" id="edit_email" name="email"
                                           placeholder="Write an email" required="required">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="contact_no" class="control-label col-sm-2">Contact:</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="edit_contact_no" name="contact_no"
                                           placeholder="Write a contact number" required="required">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="designation_id" class="control-label col-sm-2">Designation:</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="designation_id">
                                        <option id="edit_designation_id">Select Designations Title</option>
                                        @foreach($designations as $designation)
                                            <option value="{{$designation->id}}">{{$designation->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="department_id" class="control-label col-sm-2">Department:</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="department_id">
                                        <option id="edit_department_id">Select Department Name</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="credit" class="control-label col-sm-2">Credit to be taken:</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="edit_credit" name="credit"
                                           placeholder="Write credit" required="required">
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

        /* Teacher view function */
        function fun_view(id) {
            var view_url = $("#hidden_view").val();
            $.ajax({
                url: view_url,
                type: "GET",
                data: {"id": id},
                success: function (result) {
                    //console.log(result);
                    $("#view_name").text(result.name);
                    $("#view_designation").text(result.designation.title);
                    $("#view_department").text(result.department.name);
                    $("#view_credit").text(result.credit);
                    $("#view_address").text(result.address);
                    $("#view_email").text(result.email);
                    $("#view_contact_no").text(result.contact_no);
                }
            });
        }

        /* Teacher edit function */
        function fun_edit(id) {
            var view_url = $("#hidden_view").val();
            $.ajax({
                url: view_url,
                type: "GET",
                data: {"id": id},
                success: function (result) {
                    //console.log(result);
                    $("#edit_id").val(result.id);
                    $("#edit_name").val(result.name);
                    $("#edit_address").val(result.address);
                    $("#edit_email").val(result.email);
                    $("#edit_contact_no").val(result.contact_no);
                    $("#edit_designation_id").val(result.designation.title);
                    $("#edit_department_id").val(result.department.name);
                    $("#edit_credit").val(result.credit);
                }
            });
        }

        /* Teacher delete function */
        function fun_delete(id) {
            var conf = confirm("Are you sure want to delete??");
            if (conf) {
                var delete_url = $("#hidden_delete").val();
                $.ajax({
                    url: delete_url,
                    type: "POST",
                    data: {"id": id, _token: "{{ csrf_token() }}"},
                    success: function (response) {
                        alert(response);
                        location.reload();
                    }
                });
            }
            else {
                return false;
            }
        }

        // validate teacher add form on keyup and submit
        $(".department-validate-form").validate({
            rules: {
                name: "required",
                address: "required",
                email: {
                    required: true,
                    email: true
                },
                contact_no: "required",
                designation_id: "required",
                department_id: "required",
                credit: "required"
            },
            messages: {
                name: "Please enter teacher name",
                address: "Please enter an address",
                email: "Please enter a valid email address",
                contact_no: "Please enter contact number",
                designation_id: "Please enter designation title",
                department_id: "Please enter department name",
                credit: "Please enter credit",
            }
        });


        /* Add successful message function */
        setTimeout(function () {
            $('#success_msg_id').remove();
        }, 1000);
    </script>
@endsection