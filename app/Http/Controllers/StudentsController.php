<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Attendance;
use App\Payment;

class StudentsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['create', 'success', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $students = Student::orderBy('name')->paginate(50);
      return view('students.index')->with('students', $students);
    }

    //Search function
    public function search(Request $request){
      $search = $request->get('search');
      $students = Student::where('name', 'like', "%$search%")->paginate(50);;
      return view('students.index')->with('students', $students);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      //Check for duplicate name
      if (Student::where([
        ['name', '=', $request->name]
        ])->exists()) {
        return redirect('/students/create')->with('error', 'Student has already been registered');
      }

      $this->validate($request, [
        'name' => 'required',
        'type' => 'required',
        'dob' => 'required',
        'number' => 'required',
        'email' => 'required',
        'address' => 'required',
        'gender' => 'nullable',
        'emergencyname' => 'required',
        'emergencynumber' => 'required',
        'relationship' => 'required'
      ]);

      //Ensure the checkbox is checked
      if($request->input('agreement') != 1){
        return redirect('/students/create')->with('error', 'Please check the checkbox');
      }
        $student = new Student;
        $student->name = $request->input('name');
        $student->type = $request->input('type');
        $student->dob = $request->input('dob');
        $student->number = $request->input('number');
        $student->email = $request->input('email');
        $student->address = $request->input('address');
        $student->gender = $request->input('gender');
        $student->emergencyname = $request->input('emergencyname');
        $student->emergencynumber = $request->input('emergencynumber');
        $student->relationship = $request->input('relationship');
        $student->active = 1;
        //$student->active = $request->input('activeStatus');
        //$student->user_id = auth()->user()->id;
        $student->save();

        return redirect('/createSuccess');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        $attendances = Attendance::where('student_id', '=', $id)->get();
        $payments = Payment::where('student_id', '=', $id)->latest()->get();

        return view('students.show')->with('student', $student)->with('attendances', $attendances)->with('payments', $payments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $student = Student::find($id);
      return view('students.edit')->with('student', $student);
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
          'name' => 'required',
          'type' => 'required',
          'dob' => 'nullable',
          'number' => 'nullable',
          'email' => 'nullable',
          'address' => 'nullable',
          'gender' => 'nullable',
          'emergencyname' => 'nullable',
          'emergencynumber' => 'nullable',
          'relationship' => 'nullable'
        ]);
        $student = Student::find($id);
        $student->name = $request->input('name');
        $student->type = $request->input('type');
        $student->dob = $request->input('dob');
        $student->number = $request->input('number');
        $student->email = $request->input('email');
        $student->address = $request->input('address');
        $student->gender = $request->input('gender');
        $student->emergencyname = $request->input('emergencyname');
        $student->emergencynumber = $request->input('emergencynumber');
        $student->relationship = $request->input('relationship');
        $student->active = $request->input('activeStatus');
        $student->save();

        return redirect('/students')->with('success', 'Student updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $attendance = Attendance::where('student_id', "=", $id);

        $student->delete();
        $attendance->delete();

        return redirect('/students')->with('success', 'Student removed');
    }

    public function findStudentName(Request $request){
      //$data=Student::select('id', 'name')->where('type', $request->id)->take(100)->get();
      $data=Student::select('id', 'name')->where([
        ['type', '=', $request->id], ['active', '=', 1]
        ])->take(100)->orderBy("name")->get();
      return response()->json($data);
    }

}
