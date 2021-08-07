<?php

namespace App\Http\Controllers;

use App\Traits\errorSuccessTrait;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
class test1 extends Controller
{
    use errorSuccessTrait;
    public function index(){
        $users =  User::all();
        if($users){
            return $this->returnOnSuccessWithData("data" , $users,"Users Retrieved Successfully" , true );
        }
        return $this->returnOnError("failed to retrieve Users" , false , "U001");
    }

    public function index2() {
       $userArr = ["id" => "1" , "first_name" => "Mohamed" , "last_name" => "saleh" , "number" => "01029747963" ,
            "address" => "kornish ElMaadi" , "password" => app('hash')->make('1234569847')];
            $userCreated = User::create($userArr);
            return $userCreated;
       }
}
