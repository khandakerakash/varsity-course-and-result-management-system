@extends('layouts.admin_master')

@section('title', 'Add New Teacher')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if ($message = Session::get('success'))
        <div id="success_msg_id" class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div>
        <h4 class="page-header title text-muted">Add new teacher</h4>
    </div>
    {!! Form::open(['route' => 'admin.teacher.add', 'files' => true, 'class' => 'form-horizontal']) !!}
    <div class="form-group row">
        {{Form::label('name', 'Name', ['class' => 'col-sm-2', 'control-label'])}}
        <div class="col-sm-7">
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Write a teacher name']) }}
        </div>
    </div>
    <div class="form-group row">
        {{Form::label('address', 'Address', ['class' => 'col-sm-2', 'control-label'])}}
        <div class="col-sm-7">
            {{ Form::textarea('address', null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Write an address']) }}
        </div>
    </div>
    <div class="form-group row">
        {{Form::label('email', 'Email', ['class' => 'col-sm-2', 'control-label'])}}
        <div class="col-sm-7">
            {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Write a teacher name']) }}
        </div>
    </div>
    <div class="form-group row">
        {{Form::label('contact_no', 'Contact', ['class' => 'col-sm-2', 'control-label'])}}
        <div class="col-sm-7">
            {{ Form::text('contact_no', null, ['class' => 'form-control', 'placeholder' => 'Write a contact number']) }}
        </div>
    </div>
    <div class="form-group row">
        {{Form::label('designation_id', 'Designation', ['class' => 'col-sm-2', 'control-label'])}}
        <div class="col-sm-7">
            {{--{{Form::select('designation', ['L' => 'Large', 'S' => 'Small'], null, ['class' => 'form-control', 'placeholder' => 'Select Designation Title'])}}--}}
            <select class="form-control" name="designation_id">
                <option>Select Designations Title</option>
                @foreach($designations as $designation)
                    <option value="{{$designation->id}}">{{$designation->title}}</option>
                @endforeach
            </select>
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
        {{Form::label('credit', 'Credit to be taken', ['class' => 'col-sm-2', 'control-label'])}}
        <div class="col-sm-7">
            {{ Form::text('credit', null, ['class' => 'form-control', 'placeholder' => 'Write a teacher credit']) }}
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-offset-2 col-sm-7">
            <button type="submit" class="btn btn-default">Save</button>
        </div>
    </div>
    {!! Form::close() !!}

@endsection

@section('page-script')
    <script type="text/javascript">
        setTimeout(function(){
            $('#success_msg_id').remove();
        }, 1000);
    </script>
@endsection