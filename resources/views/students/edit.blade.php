@extends('layouts.app')

@section('content')

<div class="container">
  <a href="/students/{{$student->id}}" class="btn btn-secondary">Go back</a>
  <h1>Update Student</h1>

  {!! Form::open(['action' => ['StudentsController@update', $student->id], 'method' => "POST"]) !!}
    <div class="form-group">
      {{Form::label('name', 'Name, As in NRIC')}}
      {{Form::text ('name', $student->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
    </div>

    <div class="form-group">
      <label>Type: </label> <br/>

      <label class="radio-inline">
        <input type="radio" name="type" value="tht"
        @if($student->type == "tht") {
        checked="checked" }
        @endif
        />
        THT Student
      </label>

      <label class="radio-inline">
        <input type="radio" name="type" value="private"
        @if($student->type == "private") {
          checked="checked" }
        @endif
        />
        Private Student
      </label>

      <label class="radio-inline">
        <input type="radio" name="type" value="trial"
        @if($student->type == "trial") {
          checked="checked" }
        @endif
        />
        Trial Student
      </label>
    </div>

    <div class="form-group">
      <label for="dob">Date Of Birth </label>
      <input type="date" name="dob" value="{{$student->dob}}" class="form-control"/>
    </div>

    <div class="form-group">
      {{Form::label('number', 'Contact number')}}
      {{Form::text ('number', $student->number, ['class' => 'form-control', 'placeholder' => 'Contact number'])}}
    </div>

    <div class="form-group">
      {{Form::label('email', 'Email: ')}}
      {{Form::text ('email', $student->email, ['class' => 'form-control', 'placeholder' => 'Email'])}}
    </div>

    <div class="form-group">
      {{Form::label('address', 'Address')}}
      {{Form::text ('address', $student->address, ['class' => 'form-control', 'placeholder' => 'Address'])}}
    </div>

    <div class="form-group">
      {{Form::label('gender', 'Gender: ')}}
      {{Form::text ('gender', $student->gender, ['class' => 'form-control', 'placeholder' => 'Gender'])}}
    </div>

    <div class="form-group">
      {{Form::label('emergencyname', 'Emergency Name')}}
      {{Form::text ('emergencyname', $student->emergencyname, ['class' => 'form-control', 'placeholder' => 'Name of emergency contact'])}}
    </div>

    <div class="form-group">
      {{Form::label('emergencynumber', 'Emergency Contact Number')}}
      {{Form::text ('emergencynumber', $student->emergencynumber, ['class' => 'form-control', 'placeholder' => 'Emergency Contact Number'])}}
    </div>

    <div class="form-group">
      {{Form::label('relationship', 'Relationship To Participant')}}
      {{Form::text ('relationship', $student->relationship, ['class' => 'form-control', 'placeholder' => ''])}}
    </div>

    <div class="form-group">
      <label for="status">Student status: </label>
      <input type="radio" name="activeStatus" value="1"
      @if($student->active == 1){
        checked="checked"
      }
      @endif
      />

      <label for="active">Active </label>
      <input type="radio" name="activeStatus" value="0"
      @if($student->active == 0){
        checked="checked"
      }
      @endif
      />
      <label for="active">Inactive </label>
    </div>

    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('submit', ['class'=>'btn btn-success'])}}

  {!! Form::close() !!}
</div>
@endsection
