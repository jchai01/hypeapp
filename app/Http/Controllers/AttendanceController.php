<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Attendance;
//use DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //$students = Student::orderBy('created_at')->paginate(10);
      //return view('attendance.index')->with('students', $students);

      $dates = Attendance::groupBy('date')->latest('date')->paginate(10);
      return view('attendance.index')->with('dates', $dates);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $students = Student::where('active', '=', 1)->orderBy('created_at')->paginate(10);
      return view('attendance.takeAttendance')->with('students', $students);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //Validation
      $this->validate($request, [
          'date' => 'required|date',
      ]);

      //Check for duplicate date
      if (Attendance::where([
        ['date', '=', $request->date], ['type', '=', $request->type]
        ])->exists()) {
        return redirect('/attendance/create')->with('error', 'Attendance for this date already recorded');
      }

      $Attendance = [];

      //Get the field that is named "{{$student->id}}"
      $Students = $request->except('_token', 'student_id', 'date', 'status', 'remark', 'type');
      //dd($Students);

      foreach ($Students as $ID => $Status) {
          $Attendance[] = [
              'student_id' => $ID,
              'user_id' => auth()->user()->id,
              'date' => $request->date,
              'status' => $Status,
              'type' => $request->type,
              'remark' => $request->remark
          ];
      }
      //dd($Attendance);

      Attendance::insert($Attendance);
        return redirect('/attendance')->with('success', 'Attendance recorded');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $date
     * @return \Illuminate\Http\Response
     */
    public function show($date)
    {
      //Using SQL statement, unable to use model relationship
      //$attendances=DB::select('SELECT * FROM attendances WHERE date = ?', array($date));

      $attendances = Attendance::where([
          ['date', '=', $date],
          ['status', '=', '1']])->get();
      return view('attendance.show')->with('attendances', $attendances)->with('date', $date);
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
    public function destroy($date)
    {
        $attendance = Attendance::where('date', "=", $date);
        $attendance->delete();
        return redirect('/attendance')->with('success', 'Attendance for the date removed');
    }
}
