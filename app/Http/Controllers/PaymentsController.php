<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Payment;
use App\Student;

class PaymentsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $payments = Payment::latest()->paginate(15);
      return view('payments.index')->with('payments', $payments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $students = Student::orderBy('name')->get();
      return view('payments.create')->with('students', $students);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //Check if student is selected from dropdown
      if ($request->input('student') == "0"){
        return redirect('/payments/create')->with('error', 'Please select a student');
      }

      //Check if package is selected from dropdown
      else if ($request->input('package') == "0"){
        return redirect('/payments/create')->with('error', 'Please select a package/lesson');
      }

      $payment = new Payment;
      $payment->student_id = $request->input('student');
      $payment->user_id = auth()->user()->id;
      $payment->quantity = $request->input('quantity');
      $payment->package = $request->input('package');
      $payment->amount = $request->input('amount');
      $payment->lessons_bought = $request->input('lessons');
      $payment->save();

      return redirect('/payments')->with('success', 'Payment Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $payment = Payment::find($id);

      return view('payments.show')->with('payment', $payment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $students = Student::orderBy('name')->get();
      $payment = Payment::find($id);
      return view('payments.edit')->with('payment', $payment)->with('students', $students);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'student' => 'required',
        'package' => 'required',
        'quantity' => 'nullable',
        'amount' => 'nullable',
        'lessons' => 'nullable',
      ]);

      $payment = Payment::find($id);
      $payment->student_id = $request->input('student');
      $payment->quantity = $request->input('quantity');
      $payment->package = $request->input('package');
      $payment->amount = $request->input('amount');
      $payment->lessons_bought = $request->input('lessons');
      $payment->save();

      return redirect('/payments')->with('success', 'Payment record updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $payment = Payment::find($id);
      $payment->delete();

      return redirect('/payments')->with('success', 'Payment record removed');
    }
}
