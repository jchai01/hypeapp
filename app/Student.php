<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //Table namespace
    protected $table = "students";

    //Primary Key
    public  $primaryKey = 'id';

    //timestamps
    public $timestamps = true;

    public function user(){
      return $this->belongsTo('App\user');
    }

    
}
