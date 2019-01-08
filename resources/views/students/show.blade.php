@extends('layouts.app')

@section('content')

  {{--Unused section to declare variables--}}
  @section('variableSection')

    {{--Declarations and initialisations--}}
    {{$totalLessonsPaidFor = 0}}
    {{ $totalLessonsAttended = count($attendances) }}

    {{--Loop though all payments made by this student and adds up the total number of lessons bought--}}
    @foreach ($payments as $payment)
      {{$totalLessonsPaidFor = $totalLessonsPaidFor + $payment->lessons_bought}}
    @endforeach

  @endsection

<div class="container">
<a href="/students" class="btn btn-secondary">Go back</a>
<!--Edit button-->
<a href="/students/{{$student->id}}/edit" class="btn btn-primary">Edit</a>

<!--Delete button-->
{!!Form::open(['action' => ['StudentsController@destroy', $student->id], 'method' => 'POST', 'class' => 'float-right'])!!}
  {{Form::hidden('_method', 'DELETE')}}
  {{Form::submit('delete', ['class' => 'btn btn-danger' , 'disabled'])}} {{--Disable the delete button to prevent accidental delete--}}
{!!Form::close()!!}

<br/><br/>

  <h2>Student Name: {{$student->name}}</h2>

  <table class="table table-striped table-bordered">

    <tr>
      <td>Status:</td>
      <td>
        @if ($student->active==0)
          Inactive
        @else
          Active
        @endif
      </td>
    </tr>

    <tr>
      <td>Type:</td>
      <td>
        @if ($student->type=="tht")
          The Hype tribe Student
        @elseif($student->type=="private")
          Private Student
        @else
          Trial Student
        @endif
      </td>
    </tr>

    <tr>
      <td>Date of birth:</td> <td>{{$student->dob}}</td>
    </tr>

    <tr>
      <td>Contact number:</td> <td>{{$student->number}}</td>
    </tr>

    <tr>
      <td>Email:</td> <td>{{$student->email}}</td>
    </tr>

    <tr>
      <td>Address:</td> <td>{{$student->address}}</td>
    </tr>

    <tr>
      <td>Gender:</td> <td>{{$student->gender}}</td>
    </tr>

    <tr>
      <td>Emergency Contact Name:</td> <td>{{$student->emergencyname}} ({{$student->relationship}})</td>
    </tr>

    <tr>
      <td>Emergency Contact Number:</td> <td>{{$student->emergencynumber}}</td>
    </tr>

    <tr>
      <td>Created on:</td> <td>{{$student->created_at->toDateString()}}</td>
    </tr>

    <tr>
      <td>Total number of lessons paid for:</td><td> {{$totalLessonsPaidFor}} </td>
    </tr>
    <tr>
      <td>Lesson(s) left:</td><td>{{($totalLessonsPaidFor-$totalLessonsAttended)}}</td>
    </tr>

  </table>

  @if(count($payments) > 0)
    <table class="table table-striped">
      <tr>
        <th colspan="6">Number of payment records: {{count($payments)}}</th>
      </tr>

      <tr>
        <th>Date (Y-m-d)</th><th>Packages/Lessons/Items</th><th>Quantity</th><th>Amount</th><th>No. of lessons paid</th><th>Recorded by</th>
      </tr>
    @foreach ($payments as $payment)
      <tr>
        <td>{{$payment->created_at->toDateString()}}</td>
        <td>{{$payment->package}}</td>
        <td>{{$payment->quantity}}</td>
        <td>{{$payment->amount}}</td>
        <td>{{$payment->lessons_bought}}</td>
        <td>{{$payment->user->name}}</td>
      </tr>

    @endforeach
  @endif

    @if(count($attendances) > 0)
      <table class="table table-striped">
        <tr>
          <th colspan="2">Number of lesson attended: {{count($attendances)}}</th>
        </tr>

      @foreach ($attendances as $attendance)
        <tr>
          <td>{{$attendance->date}}</td>
          <td>
            <a href="/attendance/{{$attendance->date}}" class="btn btn-primary">View Attendance</a>
          </td>

        </tr>
      @endforeach
    @endif

</div>

@endsection
