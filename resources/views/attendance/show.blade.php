@extends('layouts.app')

@section('content')
<div class="container">
<a href="/attendance" class="btn btn-secondary">Go back</a>

<!--Delete button-->
{!!Form::open(['action' => ['AttendanceController@destroy', $date], 'method' => 'POST', 'class' => 'float-right'])!!}
  {{Form::hidden('_method', 'DELETE')}}
  {{Form::submit('delete', ['class' => 'btn btn-danger'])}}
{!!Form::close()!!}

<h1>{{count($attendances)}} Student(s) present on {{ $date }}</h1>

@if(count($attendances) > 0)
  <h3>Attendance taken by: {{$attendances[0]->user->name}}</h3>
  @if ($attendances[0]->remark != "")
    <h3>Remark: {{$attendances[0]->remark}}</h3>
  @endif

  <table class="table table-striped">
    <tr>
      <th>Student Name</th>
    </tr>
    @foreach($attendances as $attendance)
      <tr>
        <td>
          <a href="/students/{{$attendance->student->id}}"> {{$attendance->student->name}} </a>
          @if ($attendance->student->type == 'trial')
            (Trial Student)
          @elseif ($attendance->student->type == 'private')
            (Private Student)
          @endif
        </td>

      </tr>
    @endforeach

@else
  <h1>No records</h1>
@endif
</div>
@endsection
