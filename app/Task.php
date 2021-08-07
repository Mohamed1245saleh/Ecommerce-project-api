<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $primaryKey = "task_id";
    protected $fillable = ["task_name" , "task_description" , "group_id" , "EDT" , "task_type"];

    public function getDeliveryDate1Attribute(){
        $explode = explode(" " , $this->attributes["EDT"]);
        $this->attributes["delivery_date"] = $explode[0];
        return $this->attributes["delivery_date"];
    }
    public function groups(){
        return $this->belongsTo("App\Group" ,'group_id' ,'group_id');
    }

    public function getTaskTypeAttribute(){
        if($this->attributes["task_type"] == 1){
            return "Task";
        }elseif ($this->attributes["task_type"] == 2){
            return "Quiz";
        }else{
            return "Exam";
        }
    }



    public function getEdtAttribute($value){
        $explode = explode(" " , $value);
        return $this->attributes["edt_time"] = $explode[1];
    }
}
