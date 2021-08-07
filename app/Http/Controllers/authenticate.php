<?php

namespace App\Http\Controllers;

use App\Traits\errorSuccessTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authenticate extends Controller
{
    use errorSuccessTrait;
    public function check(Request $request){
       $checkUser = $request->only('email' , 'password');
      $token =  Auth::guard('api')->attempt($checkUser);
      if($token){
          return $this -> returnOnSuccessWithData( "token",$token , "Authorized User" , 'true');
      }
        return $this -> returnOnError("UnAuthorizedUser" , 'false');
    }
}
