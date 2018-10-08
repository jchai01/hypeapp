@extends('layouts.app')

@section('content')
<div class="container">
  <a href="/attendance" class="btn btn-secondary">Go back</a>

  <h1>Take Attendance</h1>

  <h3>Admin coach: {{auth()->user()->name}}</h3>

@if(count($students) > 0)

{!! Form::open(['action' => 'AttendanceController@store', 'method' => "POST"]) !!}

<div class="form-group">

<div class="btn-group btn-group-toggle" data-toggle="buttons" id="studentType">
  <label class="btn btn-outline-dark">
    <input type="radio" id="option1" name="type" autocomplete="off" value="tht"> THT Student
  </label>
  <label class="btn btn-outline-dark">
    <input type="radio" id="option2" name="type" autocomplete="off" value="private"> Private Students
  </label>
  <label class="btn btn-outline-dark">
    <input type="radio" id="option3" name="type" autocomplete="off" value="trial"> Trial Students
  </label>
</div>

</div>

<div class="form-group">
  <label for="date">Date: </label>
  <input type="date" id="date" name="date" class="form-control"/>
</div>

<div class="form-group">
  <label for="remark">Remarks: </label>
  <textarea class="form-control" id="remark" name="remark"></textarea>
</div>

    <table class="table table-striped" id="studentTable">
      <tr>
        <th>Student name</th>
        <th></th>
      </tr>

{{--
    @foreach($students as $student)
    <tr>
      <td>{{$student->name}}</td>
      <td>
        <input type="hidden" name="{{$student->id}}" value="0"/>
        <input type="checkbox" name="{{$student->id}}" value="1"/>
      </td>
    </tr>
    @endforeach
--}}

  </table>
  {{Form::submit('submit', ['class'=>'btn btn-success'])}}

{!! Form::close() !!}
  @else
    <p>No students found</p>
  @endif
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change', '#studentType', function(){

      //Find out which category was clicked
      var cat_id=$('#studentType input:radio:checked').val();
      //console.log(cat_id);

      $.ajax({
        type:'get',
        url:'{!!URL::to('findStudentName')!!}', //Call find student name in StudensController
        data:{'id':cat_id},
        success:function(data){
          //console.log('success');
          //console.log(data);

          var student_data = ''; // Data to be appended to the table

          for(var i=0; i<data.length;i++){
            student_data += '<tr class="myTableRow">';
            student_data += '<td>'+data[i].name + '</td>';
            student_data += '<td><input type="checkbox" name="' + data[i].id + '" value="1"/>'
            student_data += '</tr>';
          }
          $('.myTableRow').remove();
          $('#studentTable').append(student_data);

        },
        error:function(){

        }
      });
    });
  });


</script>

@endsection
