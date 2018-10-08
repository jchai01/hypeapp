<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
  //Table namespace
  protected $table = "attendances";

  //Primary Key
  public  $primaryKey = 'id';

  //timestamps
  public $timestamps = true;

  public function student(){
    return $this->belongsTo('App\Student');
    //return Student::where('id', $this->student_id)->first()->name;
  }

  public function user(){
    return $this->belongsTo('App\User');
    //return Student::where('id', $this->student_id)->first()->name;
  }
}
