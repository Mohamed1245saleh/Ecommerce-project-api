<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $primaryKey = "student_id";
    protected $fillable = ["student_id" ,"group_id" , "student_name" , "paid"];
    public function groups(){
        return $this->belongsTo("App\Group" ,'group_id' ,'group_id');
    }
}
