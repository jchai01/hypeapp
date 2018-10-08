@extends('layouts.app')

@section('content')

  {{--Unused section to declare variables--}}
  @section('variableSection')

    {{--Declarations--}}
    {{$totalLessonsPaidFor = 0}}
    {{ $totalLessonsAttended = count($attendances) }}

    {{--Compute variable totalLessonsPaidFor --}}
    @foreach ($payments as $payment)
      @if($payment->package == "Individual Package" || $payment->package == "Buddy Package")
        {{ $totalLessonsPaidFor += (8 * $payment->quantity) }}
      @elseif($payment->package == "First Trial Class" || $payment->package == "Subsequent Trial Class")
        {{$totalLessonsPaidFor += 1}}
      @elseif($payment->package == "Multi-Term Package")
        {{$totalLessonsPaidFor += 16}}
      @endif
    @endforeach

  @endsection

<div class="container">
<a href="/students" class="btn btn-secondary">Go back</a>
<!--Edit button-->
<a href="/students/{{$student->id}}/edit" class="btn btn-primary">Edit</a>

<!--Delete button-->
{!!Form::open(['action' => ['StudentsController@destroy', $student->id], 'method' => 'POST', 'class' => 'float-right'])!!}
  {{Form::hidden('_method', 'DELETE')}}
  {{Form::submit('delete', ['class' => 'btn btn-danger'])}}
{!!Form::close()!!}

<br/><br/>

  <h2>Student Name: {{$student->name}}</h2>

  <table class="table table-striped table-bordered">
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
      <td>Created on:</td> <td>{{$student->created_at}}</td>
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
        <th colspan="4">Payment Records: {{count($payments)}}</th>
      </tr>

      <tr>
        <th>Date</th><th>Payments made</th><th>Quantity</th><th>Amount</th>
      </tr>
    @foreach ($payments as $payment)
      <tr>
        <td>{{$payment->created_at}}</td><td>{{$payment->package}}</td><td>{{$payment->quantity}}</td><td>{{$payment->amount}}</td>
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
