<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Student;

class Group extends Model
{
    public $primaryKey = "group_id";
    protected $fillable = ["group_name" , "group_description" , "group_dates" , "group_times" , "price"];
    protected $appends = ["displayed_group_dates"];

public function getGroupDatesAttribute($value){
          $return ="";
          $days = [
                     0 =>"sunday"   , 1 =>"monday" , 2 =>"Tuesday" , 3 =>"wednesday" ,
                     4 =>"Thursday" , 5 =>"Friday" , 6 =>"Saturday"
          ];
          $values = explode("," , $value);
          foreach ($values as $value){
              $return .= $days[intval($value)]." - ";
          }
      $return =  Str::substr($return , 0 , -2);
          return $return;
}

public function getDisplayedGroupDatesAttribute(){
    $explode = explode("," , $this->attributes["group_dates"]);
    foreach($explode as $value){
        $array[] = trim($value);
    }
    return $this->attributes["displayed_group_dates"] = $array;
}

public function students(){
    return $this->hasMany("App\Student");
}

    public function tasks(){
        return $this->hasMany("App\Task");
    }
}
