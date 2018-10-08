@extends('layouts.app')

@section('content')
<div class="container">
  <a href="/home" class="btn btn-secondary">Go back</a>
  <a href="/attendance/create" class="btn btn-primary">Take Attendance</a> <br/><br/>

  @if(count($dates) > 0)

    <table class="table table-striped">
      <tr>
        <th>Dates</th>
        <th></th>
      </tr>
    @foreach($dates as $date)
    <tr>
      <td>{{$date->date}}</td>
      <td>
        <a href="/attendance/{{$date->date}}" class="btn btn-primary">View Attendance</a>
      </td>
    </tr>
    @endforeach
  </table>


  @else
    <p>No records found</p>
  @endif
</div>
@endsection
