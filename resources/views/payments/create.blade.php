@extends('layouts.app')

@section('content')

  <div class="container">

  <a href="/payments" class="btn btn-secondary">Go back</a>

  <h1>Add Payment</h1>

  {!! Form::open(['action' => 'PaymentsController@store', 'method' => "POST"]) !!}

  <!--Student dropdown list-->
  <div class="form-group">
    <label for="sel">Select Student:</label>
    <select name="student" class="form-control" id="sel">
      <option value="0">Select a student</option>
      @foreach ($students as $student)
        <option value="{{$student->id}}">{{$student->name}} </option>
      @endforeach
    </select>
  </div>

    <!--Types of packages-->
    <div class="form-group" >
      <label for="pack">Select Packages/lessons: </label>
      <select name="package" id="package" class="form-control" onchange="changeAmount()">
        <option value="0">Select a Package</option>
        <option value="Individual Package">Individual Package($250)</option>
        <option value="Buddy Package">Buddy Package($450)</option>
        <option value="Multi-Term Package">Multi-Term Package($500)</option>
        <option value="First Trial Class">First Trial Class($30)</option>
        <option value="Subsequent Trial Class">Subsequent Trial Class($35)</option>
      </select>
    </div>

    <!--Quantity input-->
    <div class="form-group">
    <label for="sel">Quantity: </label>
        <input type="number" step="1" name="quantity" id="quantity" value="1" class="form-control" onchange="changeAmount()">
    </div>

    <!--Amount input-->
    <div class="form-group">
    <label for="sel">Amount: </label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">$</span>
        </div>
        <input type="number" step="any" name="amount" id="amount" class="form-control">
      </div>
    </div>
    {{Form::submit('submit', ['class'=>'btn btn-success'])}}
  {!! Form::close() !!}
</div>
@endsection

<script type="text/javascript">
  function changeAmount(){
    var dropdown = document.getElementById('package');
    var amount =  document.getElementById('amount');
    var quantity =  document.getElementById('quantity');
    if(dropdown.selectedIndex == 1){
      amount.value = 250 * quantity.value;
    }
    else if(dropdown.selectedIndex == 2){
      amount.value = 450 * quantity.value;
    }
    else if(dropdown.selectedIndex == 3){
      amount.value = 500 * quantity.value;
    }
    else if(dropdown.selectedIndex == 4){
      amount.value = 30 * quantity.value;
    }
    else if(dropdown.selectedIndex == 5){
      amount.value = 35 * quantity.value;
    }
  }
</script>
