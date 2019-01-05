@extends('layouts.app')

@section('content')

<div class="container">
<a href="/payments" class="btn btn-secondary">Go back</a>

<!--Edit button-->
<a href="/payments/{{$payment->id}}/edit" class="btn btn-primary">Edit</a>


<!--Delete button-->
{!!Form::open(['action' => ['PaymentsController@destroy', $payment->id], 'method' => 'POST', 'class' => 'float-right'])!!}
  {{Form::hidden('_method', 'DELETE')}}
  {{Form::submit('delete', ['class' => 'btn btn-danger'])}} {{--Disable the delete button to prevent accidental delete--}}
{!!Form::close()!!}

<br/><br/>

  <table class="table table-striped table-bordered">

    <tr>
      <td>Student name:</td> <td>{{$payment->student->name}}</td>
    </tr>

    <tr>
      <td>Packages/Items:</td> <td>{{$payment->package}}</td>
    </tr>

    <tr>
      <td>Quantity:</td> <td>{{$payment->quantity}}</td>
    </tr>

    <tr>
      <td>Amount:</td> <td>{{$payment->amount}}</td>
    </tr>

    <tr>
      <td>Lessons bought:</td> <td>{{$payment->lessons_bought}}</td>
    </tr>

    <tr>
      <td>Created at:</td> <td>{{$payment->created_at}}</td>
    </tr>

    <tr>
      <td>Updated at:</td> <td>{{$payment->updated_at}}</td>
    </tr>


  </table>
</div>

@endsection
