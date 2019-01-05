@extends('layouts.app')

@section('content')
<div class="container">
  <a href="/home" class="btn btn-secondary">Go back</a>
  <a href="/payments/create" class="btn btn-primary">Add Payment</a>
  <h1>Payments</h1>
  @if(count($payments) > 0)

    <table class="table table-striped">

      <tr><th>Student Name</th><th>Packages/Items</th><th>Quantity</th><th>Amount</th><th>No. of lessons paid</th><th>Recorded by</th> <th>Show</th></tr>
    @foreach($payments as $payment)
        <tr>
          <td>{{$payment->student->name}}</td>
          <td>{{$payment->package}}</td>
          <td>{{$payment->quantity}}</td>
          <td>${{$payment->amount}}</td>
          <td>{{$payment->lessons_bought}}</td>
          <td>{{$payment->user->name}}</td>
          <td><a href="/payments/{{$payment->id}}" class="btn btn-primary">Show</a></td>
        </tr>

    @endforeach

  </table>
    {{$payments->links()}}
  @else
    <p>No payments found</p>
  @endif
</div>
@endsection
