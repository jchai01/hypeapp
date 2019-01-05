@extends('layouts.app')

@section('content')

  <div class="container">

  <a href="/payments" class="btn btn-secondary">Go back</a>

  <h1>Update Payment Record</h1>

  {!! Form::open(['action' => ['PaymentsController@update', $payment->id], 'method' => "POST"]) !!}

  <!--Student dropdown list-->
  <div class="form-group">
    <label for="sel">Select Student:</label>
    <select name="student" class="form-control" id="sel">
      <option value="0">Select a student</option>
      @foreach ($students as $student)
        <option value="{{$student->id}}"
          @if ($student->id == $payment->student_id)
            selected
          @endif
        >{{$student->name}} </option>
      @endforeach
    </select>
  </div>

    <!--Types of packages-->
    <div class="form-group" >
      <label for="pack">Select Packages/Lessons/Product: </label>
      <select name="package" id="package" class="form-control" onchange="changeAmount()">
        <option value="0">Select a Package</option>

        <option value="Individual Package"
        @if($payment->package == "Individual Package")
          selected
        @endif
        >Individual Package($160)</option>

        <option value="Buddy Package"
        @if($payment->package == "Buddy Package")
          selected
        @endif
        >Buddy Package($150 each)</option>

        <option value="Multi-Term Package"
        @if($payment->package == "Multi-Term Package")
          selected
        @endif
        >Multi-Term Package($300)</option>

        <option value="First Trial Class"
        @if($payment->package == "First Trial Class")
          selected
        @endif
        >First Trial Class($25)</option>

        <option value="Subsequent Class"
        @if($payment->package == "Subsequent Class")
          selected
        @endif
        >Subsequent Class($45)</option>

        <option value="Hype Tribe Shirt"
        @if($payment->package == "Hype Tribe Shirt")
          selected
        @endif
        >Hype Tribe Shirt($35)</option>

        <option value="STG Shirt"
        @if($payment->package == "STG Shirt")
          selected
        @endif
        >STG Shirt($35)</option>

        <option value="Others"
        @if($payment->package == "Others")
          selected
        @endif
        >Others</option>

      </select>

      <small class="p-2 mb-2 bg-warning text-dark" id="reminder" style="display:none;"> *Remember to make record for the other buddy </small>
    </div>

    <!--Quantity input-->
    <div class="form-group">
    <label for="sel">Quantity: </label>
        <input type="number" value="{{$payment->quantity}}" step="1" name="quantity" id="quantity" value="1" class="form-control" onchange="changeAmount()">
    </div>

    <!--Amount input-->
    <div class="form-group">
    <label for="sel">Amount: </label>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text">$</span>
        </div>
        <input type="number" value="{{$payment->amount}}" step="any" name="amount" id="amount" class="form-control">
      </div>
    </div>

    <!--Lessons bought input-->
    <div class="form-group">
    <label for="sel">Number of lessons bought: </label>
        <input type="number" value="{{$payment->lessons_bought}}" step="1" name="lessons" id="lessons" value="0" min="0" class="form-control">
    </div>

    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Update', ['class'=>'btn btn-success'])}}

  {!! Form::close() !!}
</div>
@endsection

<script type="text/javascript">
  function changeAmount(){

    //Link using getElementById
    var dropdown = document.getElementById('package');
    var amount =  document.getElementById('amount');
    var quantity =  document.getElementById('quantity');
    var lessonsBought =  document.getElementById('lessons');
    var reminder =  document.getElementById('reminder');

    reminder.style.display = "none"; //Removes reminder text initially

    if(dropdown.selectedIndex == 1){ //Individual package
      amount.value = 160 * quantity.value;
      lessonsBought.value = 4 * quantity.value;
    }
    else if(dropdown.selectedIndex == 2){ //Buddy package
      amount.value = 150 * quantity.value;
      lessonsBought.value = 4 * quantity.value;
      reminder.style.display = "block"; //Set reminder to make record for the other buddy
    }
    else if(dropdown.selectedIndex == 3){ //Multi-term package
      amount.value = 300 * quantity.value;
      lessonsBought.value = 8 * quantity.value;
    }
    else if(dropdown.selectedIndex == 4){ //First trial class
      amount.value = 25 * quantity.value;
      lessonsBought.value = 1 * quantity.value;
    }
    else if(dropdown.selectedIndex == 5){ //Subsequent class
      amount.value = 45 * quantity.value;
      lessonsBought.value = 1 * quantity.value;
    }
    else if(dropdown.selectedIndex == 6){ //Hype Tribe Shirt
      amount.value = 35 * quantity.value;
      lessonsBought.value = 0;
    }
    else if(dropdown.selectedIndex == 7){ //STG Shirt
      amount.value = 35 * quantity.value;
      lessonsBought.value = 0;
    }
    else if(dropdown.selectedIndex == 8){ //Others
      amount.value = 0;
      lessonsBought.value = 0;
    }
  }
</script>
