<?php

namespace App\Http\Controllers;

use App\Traits\errorSuccessTrait;
use App\User;
use Illuminate\Http\Request;
use App\Group;

class GroupController extends Controller
{
    use errorSuccessTrait;

    public function index(){
       $group = Group::all();
       if($group){
           return $this->returnOnSuccessWithData("data" , $group,"Groups Retrieved Successfully" , true );
       }
        return $this->returnOnError("failed to retrieve groups" , false , "G001");
    }


 public function store(Request $request){
      $newGroup =  json_decode($request->getContent() , true);
     $group = Group::create($newGroup);
     if($group){
               return $this->returnOnSuccess("Group created Successfully" , true );
     }
     return $this->returnOnError("failed to Add new Group" , false , "G001");
 }

 public function edit($id){
     $group = Group::where("group_id" , $id)->get();
     if($group){
         return $this->returnOnSuccessWithData("data" , $group,"Group Retrieved Successfully" , true );
     }
     return $this->returnOnError("failed to retrieve group" , false , "G001");
 }

 public function update(Request $request){
     try{
         $user = Group::findOrFail($request->input('id'));
     }

     catch(ModelNotFoundException $e){
         return $this -> returnOnError("Group Not exist" , false);
     }

     $requestInfo = $request->input('updateGroup');
     $updated = $user->update($requestInfo);
     if(!$updated){

         return $this -> returnOnError("Failed to updated Group" , false);
     }
     return $this -> returnOnSuccess("Group Updated Successfully" , true);
 }

 public function destroy(Request $request){
        try{
            $group = Group::findOrFail($request->input("id"));
        }
        catch (\Exception $e){
            return $e;
        }
     $group =  Group::destroy($group->group_id);
     if($group){
         return $this->returnOnSuccess("Group Deleted Successfully" , true  , "");
     }
     return $this->returnOnError("failed to retrieve group" , false , "DG001");
 }
}
