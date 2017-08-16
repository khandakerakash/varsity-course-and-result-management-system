@extends('layouts.admin_master')

@section('title', 'Course Assign Teacher')

@section('content')
    <div class="col-lg-12">
        <h4 class="page-header title text-muted">View Class Schedule Allocation Room Information</h4>
        <div class="course-assign-teacher">
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
            </div><br><br><br>
            <div class="class-schedule-informations">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-data">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Course Code</th>
                            <th>Name</th>
                            <th>Schedule Info.</th>
                        </tr>
                        </thead>
                        <tbody class="tbody" id="class_schedule_id">

                        </tbody>
                    </table>
                </div>
                {{--{{ $teachers->links() }}--}}
            </div>
        </div>
    </div>
@endsection


@section('myScript')
    <script type="text/javascript">
        /* Department wise dropdown view */
        $('#department_id').on('change', function (e) {

            var department_id = e.target.value;

            $.ajax({
                type: "GET",
                url: '/admin/ajaxDepartmentClassSchedule/' + department_id,
                success: function (class_schedule_info) {

                    alert(class_schedule_info.course_id);

                    $("tbody.tbody").append("<tr><td>" +  ++$('tbody tr').length  + "</td><td>" + data.course_id + "</td><td>" + data.room_no_id + "</td></tr>");
                },
                error: function (class_schedule_info) {
                    // console.log('Error:', data);
                }
            });
        });

    </script>
@endsection