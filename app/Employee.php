<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    //return salary of the employee from it's department
    public function salary(){
    	return $this->hasOne('App\Department','user_id');
    }
}
