@extends('layouts.app')

@section('content')

<div class="container">

  <h1>Registration and Indemnity</h1>

<p>
By signing up and using GymKraft's facilities and The Hype Tribe's services, you have agreed to the following Acknowledgement, Waiver and Release from Liability Agreement.

<br/><br/>
ACKNOWLEDGEMENT, WAIVER & RELEASE FROM LIABILITY AGREEMENT
THIS DOCUMENT IS A LEGALLY BINDING AGREEMENT. BY SIGNING THIS AGREEMENT, YOU ARE ACKNOWLEDGING THAT YOU HAVE READ, UNDERSTOOD AND ACCEPTED THE TERMS AND CONDITIONS STATED IN THIS AGREEMENT. YOU FURTHER ACKNOWLEDGE AND AGREE THAT YOU ARE WAIVING YOUR RIGHTS TO BRING ANY COURT ACTION TO RECOVER COMPENSATION OR OBTAIN ANY OTHER REMEDY FOR ANY INJURY TO YOURSELF OR YOUR PROPERTY.

<br/><br/>
ACKNOWLEDGEMENT<br/>
I acknowledge that there are significant elements of risk associated with the activities provided by GymKraft and The Hype Tribe. I further acknowledge the nature and extent of the risks inherent in the activities and the use of the facilities. I acknowledge that there are possible risks associated with the use of the facilities, and that other unknown and unanticipated risks may result in injury, illness or death.

<br/><br/>
RELEASE, ASSUMPTION OF RISK AND RESPONSIBILITY<br/>
In consideration of, and in recognitions of the inherent risks of the activities associated with the use of the facilities, I, and/or on behalf of any minor children for which I am responsible for, agree, on behalf of myself, my/our heirs, representatives, successors, executors, administrators and assigns, to hereby release, waive, discharge and agree not to sue its officers, directors, shareholders, agents and employees, for any and all claims or demands obligations and/or causes of action of any nature whatsoever which I may have against its officers, directors, shareholders, agents and employees, on account of any personal injury, property damage, death or accident of any kind, arising out of or in any way connected with use of the facilities or equipment, whether my/our use is supervised or unsupervised and I/we agree to indemnify and hold harmless the persons or entities mentioned in this paragraph from any and all liabilities or claims made by other individuals or entities as a result of my/our actions.

<br/><br/>
I further certify, acknowledge and agree on behalf of myself and/or any minor children for which I am responsible, that: I am (we are) physically and mentally capable of participating in the activity and/or use the equipment, I/we assume responsibility for and voluntarily assume the risks for any personal injury, death and related expenses involved with this activity, I/we assume responsibility for damage to my/our personal property, and I/we assume the risks for accidents or injury caused by the negligence of my fellow participants.

<br/><br/>
PHOTOGRAPH & VIDEO RELEASE FORM<br/>
I hereby grant permission to the rights of my image, likeness and sound of my voice as recorded on audio or any other medium without payment or any other consideration.  I understand that my image may be edited, copied, exhibited, published or distributed and waive the right to inspect or approve the finished product wherein my likeness appears. Additionally, I waive any right to royalties or other compensation arising or related to the use of my image or recording.

<br/><br/>
Photographic, audio or video recordings may be used for the following purposes: <br/>
<ul>
  <li>conference presentations</li>
  <li>educational presentations or courses</li>
  <li>informational presentations</li>
  <li>on-line educational courses</li>
  <li>educational videos</li>
  <li>marketing and promotional materials</li>
</ul>


By signing this release, I understand this permission signifies that photographic or video recordings of me may be electronically displayed via the Internet or any other medium or in any location.

<br/><br/>
I will be consulted about the use of the photographs or video recording for any purpose other than those listed above.

<br/><br/>
There is no time limit on the validity of this release nor is there any geographic limitation on where these materials may be distributed. My consent may be withdrawn at any time, by my sending an email to thehypetribee@gmail.com and referring specifically to this photograph and video release form.

<br/><br/>
If this release is obtained from a presenter under the age of 18, then the signature of that presenter’s parent or legal guardian is also required.

<br/><br/>
UNDERTAKING BY APPLICANT<br/>
I declare that I have read all the information above. Information provided above is true to the best of my knowledge and I did not withhold any vital information. I am currently not suffering from any acute ailment or diseases.
<br/>
</p>

<hr/>

  {!! Form::open(['action' => 'StudentsController@store', 'method' => "POST"]) !!}
    <div class="form-group">
      {{Form::label('name', 'Name')}}
      {{Form::text ('name', '', ['class' => 'form-control', 'placeholder' => 'Name'])}}
    </div>

    <div class="form-group">
      <label for="status">Type: </label> <br>

      <label class="radio-inline"><input type="radio" name="type" value="tht" checked="checked" /> THT Students </label>
      <label class="radio-inline"><input type="radio" name="type" value="private" />Private Student </label>
      <label class="radio-inline"> <input type="radio" name="type" value="trial" /> Trial Student </label>
    </div>

    <div class="form-group">
      <label for="dob">Date Of Birth </label>
      <input type="date" name="dob" class="form-control"/>
      {{--
      {{Form::label('dob', 'Date Of Birth:')}}
      {{Form::text ('dob', '', ['class' => 'form-control', 'placeholder' => 'Date of birth'])}}
      --}}
    </div>

    <div class="form-group">
      {{Form::label('number', 'Contact number')}}
      {{Form::text ('number', '', ['class' => 'form-control', 'placeholder' => 'Contact number'])}}
    </div>

    <div class="form-group">
      {{Form::label('email', 'Email: ')}}
      {{Form::text ('email', '', ['class' => 'form-control', 'placeholder' => 'Email'])}}
    </div>

    <div class="form-group">
      {{Form::label('address', 'Address')}}
      {{Form::text ('address', '', ['class' => 'form-control', 'placeholder' => 'Address'])}}
    </div>

    <div class="form-group">
      {{Form::label('gender', 'Gender: ')}} </br>
      <label class="radio-inline"><input type="radio" name="gender" value="Male" checked="checked" /> Male </label>
      <label class="radio-inline"><input type="radio" name="gender" value="Female" /> Female </label>

    </div>

    <div class="form-group">
      {{Form::label('emergencyname', 'Emergency Name')}}
      {{Form::text ('emergencyname', '', ['class' => 'form-control', 'placeholder' => 'Name of emergency contact'])}}
    </div>

    <div class="form-group">
      {{Form::label('emergencynumber', 'Emergency Contact Number')}}
      {{Form::text ('emergencynumber', '', ['class' => 'form-control', 'placeholder' => 'Emergency Contact Number'])}}
    </div>

    <div class="form-group">
      {{Form::label('relationship', 'Relationship To Participant')}}
      {{Form::text ('relationship', '', ['class' => 'form-control', 'placeholder' => 'Relationship'])}}
    </div>

    <div class="form-group">
    <input type="checkbox" name="agreement" value="1"/>
    I acknowledge that I have completely read and fully understand the above release and agree to be bound thereby. I hereby also release all claims against any person or organization utilizing this material for the purposes listed above.
    </div>

<!--
    <div class="form-group">
      <label for="status">Student status: </label>
      <input type="radio" name="activeStatus" value="1" checked="checked" />
      <label for="active">Active </label>

      <input type="radio" name="activeStatus" value="0" />
      <label for="active">Inactive </label>
    </div>
  -->

    {{Form::submit('submit', ['class'=>'btn btn-success'])}}

  {!! Form::close() !!}
</div>
@endsection
