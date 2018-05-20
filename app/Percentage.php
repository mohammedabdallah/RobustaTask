<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Percentage extends Model
{
    //
    protected $table='percentages';
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'percentage', 'employee_id',
    ];
    public function employee(){
    	return $this->belongsTo('App\Employee','employee_id');
    }
}
