<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Payment;
use App\Student;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $payments = Payment::latest()->paginate(10);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
