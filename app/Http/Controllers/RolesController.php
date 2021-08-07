<?php

namespace App\Http\Controllers;

use App\Group;
use App\Role;
use App\Traits\errorSuccessTrait;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    use errorSuccessTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        if($roles){
            return $this->returnOnSuccessWithData("data" , $roles,"Roles Retrieved Successfully" , true );
        }
        return $this->returnOnError("Roles to retrieve Student" , false , "G001");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newRole =  json_decode($request->getContent() , true);
        $newRole =  $newRole["json"];
        $role = Role::create($newRole);
        if($role){
            return $this->returnOnSuccessWithData("data" , $role,"Role created Successfully" , true );
        }
        return $this->returnOnError("Role to Add new Student" , false , "S001");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::where("id" , $id)->get();
        if($role){
            return $this->returnOnSuccessWithData("data" , $role,"Role Retrieved Successfully" , true );
        }
        return $this->returnOnError("failed to retrieve Role" , false , "R001");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            $role = Role::findOrFail($request->input('id'));
        }

        catch(ModelNotFoundException $e){
            return $this -> returnOnError("Role Not exist" , false);
        }

        $requestInfo = $request->input('updateRole');
        $updated = $role->update($requestInfo);
        if(!$updated){

            return $this -> returnOnError("Failed to updated Role" , false);
        }
        return $this -> returnOnSuccess("Role Updated Successfully" , true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try{
            $role = Role::findOrFail($request->input("id"));
        }
        catch (\Exception $e){
            return $e;
        }
        $role =  role::destroy($role->id);
        if($role){
            return $this->returnOnSuccess("Role Deleted Successfully" , true  , "");
        }
        return $this->returnOnError("failed to Delete Role" , false , "R001");
    }
}
