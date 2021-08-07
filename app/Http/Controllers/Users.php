<?php

namespace App\Http\Controllers;

use App\Traits\spatieTrait;
use Illuminate\Http\Request;
use App\User;
use App\Traits\errorSuccessTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
//use Illuminate\Foundation\Auth\User As Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class Users
{
    use errorSuccessTrait , HasRoles , spatieTrait;
    public function create(Request $request){
        $newUser = collect($request->input("newUser"))->toArray();
        $roleAssigned =  $newUser['role'];
        $counter = $newUser["permissions"];
        $role = $this->getOrCreateNewRole($roleAssigned);
        for($per = 0 ; $per < count($counter) ; $per++){
            $perAssigned = $counter[$per];
            $permission = $this->getOrCreateNewPermission($perAssigned);
            $role->givePermissionTo($permission);
        }
        $newUser = collect($request->input("newUser"))->except(["role" ,"permissions"])->toArray();
        $user = User::create($newUser);
        if(!$user){

                return $this -> returnOnError("Failed to create new User" , 'false');
            }
        return $this -> returnOnSuccess("new User Created Successfully" , 'true');
    }




    public function edit(Request $request){
        $user = User::findOrFail($request->id);
        if(!$user){

            return $this -> returnOnError("User Not Found" , false);
        }
        return $this -> returnOnSuccessWithData("user" ,$user,  'User Found Successfully' , true);
    }





    public function update(Request $request){
        try{
            $user = User::findOrFail($request->input('id'));
        }

        catch(ModelNotFoundException $e){
            return $this -> returnOnError("User Not Found" , 'false');
        }

        $requestInfo = $request->input('updatedUserInfo');
        $updated = $user->update($requestInfo);
        if(!$updated){

            return $this -> returnOnError("Failed to updated User" , 'false');
        }
        return $this -> returnOnSuccess("User Updated Successfully" , 'true');

    }


    public function destroy(Request $request){
        try{
            $user =  User::findOrFail($request->input("id"));
        }
        catch (\Exception $e){
            return $e;
        }
        $user =  User::destroy($request->input("id"));
        if($user){
            return $this->returnOnSuccess("User Deleted Successfully" , true  , "");
        }
        return $this->returnOnError("failed to delete user , please contact admin " , false , "DU001");
    }
}
