@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
    <a href="/home" class="btn btn-secondary">Go back</a>
    <a href="/students/create" class="btn btn-primary">Add Student</a>
  </div>

    {{-- Search bar --}}
    <div class="col-md-6">
    <form action="/search" method="get">
      <div class="input-group">
        <input type="search" name="search" class="form-control"/>
        <span class="input-group-btn">
          <button type="submit" class="btn btn-primary">Search</button>
        </span>
      </div>
    </form>
  </div>

</div> {{--closes row div --}}

  <h1>Students</h1>
  @if(count($students) > 0)

    <table class="table table-striped">

      <tr><th>Student Name</th></tr>
    @foreach($students as $student)
      <div class="well">
        <tr>
          <td><a href="/students/{{$student->id}}"> {{$student->name}} </a></td>
        </tr>

        {{--
        <h3> <a href="/students/{{$student->id}}"> {{$student->name}} </a></h3>
        <h3>{{$student->dob}} </h3>
        <h3>{{$student->number}} </h3>
        <h3>{{$student->email}} </h3>
        <small>Created on {{$student->created_at}}</small>
        --}}

      </div>
    @endforeach

  </table>
    {{$students->links()}}
  @else
    <p>No students found</p>
  @endif
</div>
@endsection
