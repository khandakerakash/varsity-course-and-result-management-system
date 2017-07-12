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
            <a href="{{route('admin.teacher.teacherAddForm')}}" type="button" class="btn btn-info btn-sm pull-right">Add new teacher</a>
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
                                <button class="btn btn-info" data-toggle="modal" data-target="#viewModal" onclick="fun_view('{{$teacher -> id}}')">View</button>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#editModal" onclick="fun_edit('{{$teacher -> id}}')">Edit</button>
                                <button class="btn btn-danger" onclick="fun_delete('{{$teacher -> id}}')">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $teachers->links() }}

        <input type="hidden" name="hidden_view" id="hidden_view" value="{{url('http://varsity.dev/admin/teacher/view')}}">
        <input type="hidden" name="hidden_delete" id="hidden_delete" value="{{url('http://varsity.dev/admin/teacher/delete')}}">


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
                        <h4 class="modal-title">Edit department</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('http://varsity.dev/admin/department/update') }}" method="post">
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

                            <button type="submit" class="btn btn-default">Update</button>
                            <input type="hidden" id="edit_id" name="id">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        function fun_view(id)
        {
            var view_url = $("#hidden_view").val();
            $.ajax({
                url: view_url,
                type:"GET",
                data: {"id":id},
                success: function(result){
                    console.log(result);
                    $("#view_name").text(result.name);
                    $("#view_designation").text(result.designation_id);
                    $("#view_department").text(result.department_id);
                    $("#view_credit").text(result.credit);
                    $("#view_address").text(result.address);
                    $("#view_email").text(result.email);
                    $("#view_contact_no").text(result.contact_no);
                }
            });
        }

        {{--/* Department edit function */--}}
        {{--function fun_edit(id)--}}
        {{--{--}}
            {{--var view_url = $("#hidden_view").val();--}}
            {{--$.ajax({--}}
                {{--url: view_url,--}}
                {{--type:"GET",--}}
                {{--data: {"id":id},--}}
                {{--success: function(result){--}}
                    {{--//console.log(result);--}}
                    {{--$("#edit_id").val(result.id);--}}
                    {{--$("#edit_code").val(result.code);--}}
                    {{--$("#edit_name").val(result.name);--}}
                {{--}--}}
            {{--});--}}
        {{--}--}}

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


        /* Department Add successful message function */
        setTimeout(function(){
            $('#success_msg_id').remove();
        }, 1000);
    </script>
@endsection