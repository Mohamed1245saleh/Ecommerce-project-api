<?php


namespace App\Traits;


trait errorSuccessTrait
{
    /*
     *    Status   :
     *    errorNo  :
     *    msg      :
     */
    public function returnOnError($msg='' , $status='' , $errorNo = 'E0001'){

        return response()->json([
                'status' => false,
                'errNo'  => $errorNo,
                'msg'    => $msg,
                ]);
}

   public function returnOnSuccess ($msg='' , $status='' , $errorNo = ''){
       return response()->json([
           'status' => true,
           'errNo'  => $errorNo,
           'msg'    => $msg,
       ]);
   }
   public function returnOnSuccessWithData ($key , $value ,$msg='' , $status='' , $errorNo = ''){
       return response()->json([
           'status' => true,
           'errNo'  => $errorNo,
           'msg'    => $msg,
            $key => $value
       ]);
   }

}
