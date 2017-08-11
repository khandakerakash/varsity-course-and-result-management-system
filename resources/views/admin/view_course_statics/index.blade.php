@extends('layouts.admin_master')

@section('title', 'Course Assign Teacher')

@section('content')
    <div class="col-lg-12">
        <h4 class="page-header title text-muted">View Course Statics</h4>
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
            </div><br><br>
            <div class="course-informations">
                <h4 class="title text-muted">Course Informations</h4>
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-data">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Name / Title</th>
                            <th>Semester</th>
                            <th>Assigned To</th>
                        </tr>
                        </thead>
                        <tbody class="tbody" id="courses_id">

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

            alert(department_id);

//            $.get('../admin/ajaxDepartmentCourseStatics?department_id=' + department_id, function (courses) {
//
//                $('#courses_id').empty();
//
//                $.each(courses, function (index, coursesObj) {
//
//                    $("tbody.tbody").append("<tr><td>" +  ++$('tbody tr').length  + "</td><td>" + coursesObj.code + "</td><td>" + coursesObj.name + "</td><td>"+ coursesObj.semester_id +"</td></tr>");
//
//                });
//            })

            $.get('../admin/ajaxDepartmentCourseStatics?department_id=' + department_id, function (course_status) {

                $('#courses_id').empty();

                $.each(course_status, function (index, course_statusObj) {

                    $("tbody.tbody").append("<tr><td>" +  ++$('tbody tr').length  + "</td><td>" + course_statusObj.code + "</td><td>" + course_statusObj.name + "</td><td>" + course_statusObj.title + "</td><td>" + course_statusObj.teacher_id + "</td></tr>");

                });

            });
        });

//        $('#tableData').paging({limit:5});

    </script>
@endsection