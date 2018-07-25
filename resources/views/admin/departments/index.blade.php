@extends('layouts.admin_master')

@section('title', 'Departments')

@section('content')
    <div class="col-lg-12">
        <h4 class="page-header title text-muted">Departments Information</h4>
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
                    <th>Name of the Department</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($departments as $key => $department)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$department->code}}</td>
                        <td>{{$department->name}}</td>
                        <td>
                            <button class="btn btn-info" data-toggle="modal" data-target="#viewModal" onclick="fun_view('{{$department -> id}}')"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick="fun_edit('{{$department -> id}}')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                            <button class="btn btn-danger" onclick="fun_delete('{{$department -> id}}')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $departments->links() }}

        <input type="hidden" name="hidden_view" id="hidden_view" value="{{url('http://vcrms.test/admin/department/view')}}">
        <input type="hidden" name="hidden_delete" id="hidden_delete" value="{{url('http://vcrms.test/admin/department/delete')}}">

        <!-- Add modal code start -->
        <div class="modal fade" id="addModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add new department</h4>
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
                        <form action="{{ url('http://vcrms.test/admin/department/add') }}" method="post" class="department-validate-form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="code">Code:</label>
                                    <input type="text" class="form-control" id="code" name="code" required="required" placeholder="Write department code">
                                </div>
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" required="required" placeholder="Write department name">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Add</button>
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
                        <h4 class="modal-title">View</h4>
                    </div>
                    <div class="modal-body">
                        <p><b>Code: </b><span id="view_code" class="text-success"></span></p>
                        <p><b>Name: </b><span id="view_name" class="text-success"></span></p>
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
                        <h4 class="modal-title">Edit department</h4>
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
                        <form action="{{ url('http://vcrms.test/admin/department/update') }}" method="post" class="department-validate-form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="code">Code:</label>
                                    <input type="text" class="form-control" id="edit_code" name="code">
                                </div>
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="edit_name" name="name">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Save Change</button>
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

        /* Department view function */
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
                }
            });
        }

        /* Department edit function */
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
                    $("#edit_code").val(result.code);
                    $("#edit_name").val(result.name);
                }
            });
        }

        /* Department delete function */
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

        // validate departmetn add form on keyup and submit
        $(".department-validate-form").validate({
            rules: {
                code: "required",
                name: "required"
            },
            messages: {
                code: "Please enter department code",
                name: "Please enter department name"
            }
        });



        /* Department Add successful message function */
        setTimeout(function(){
            $('#success_msg_id').remove();
        }, 1000);
    </script>
@endsection