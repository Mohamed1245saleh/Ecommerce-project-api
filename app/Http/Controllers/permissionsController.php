<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\Traits\errorSuccessTrait;
use Illuminate\Http\Request;

class permissionsController extends Controller
{
    use errorSuccessTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Premissions = Permission::all();
        if($Premissions){
            return $this->returnOnSuccessWithData("data" , $Premissions,"Premissions Retrieved Successfully" , true );
        }
        return $this->returnOnError("Failed to retrieve Premission" , false , "P001");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newPer =  json_decode($request->getContent() , true);
        $newPer =  $newPer["newPermission"];
        $newPer = Permission::create($newPer);
        if($newPer){
            return $this->returnOnSuccessWithData("data" , $newPer,"Permission created Successfully" , true );
        }
        return $this->returnOnError("Failed to Add new Permission" , false , "S001");
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
        $Permission = Permission::where("id" , $id)->get();
        if($Permission){
            return $this->returnOnSuccessWithData("data" , $Permission,"Permission Retrieved Successfully" , true );
        }
        return $this->returnOnError("failed to retrieve Permission" , false , "P001");
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
            $per = Permission::findOrFail($request->input('id'));
        }

        catch(ModelNotFoundException $e){
            return $this -> returnOnError("Permission Not exist" , false);
        }

        $requestInfo = $request->input('updatePermission');
        $updated = $per->update($requestInfo);
        if(!$updated){

            return $this -> returnOnError("Failed to updated Permission" , false);
        }
        return $this -> returnOnSuccess("Permission Updated Successfully" , true);
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
            $per = Permission::findOrFail($request->input("id"));
        }
        catch (\Exception $e){
            return $e;
        }
        $per =  Permission::destroy($per->id);
        if($per){
            return $this->returnOnSuccess("Permission Deleted Successfully" , true  , "");
        }
        return $this->returnOnError("failed to Delete Permission" , false , "R001");
    }

}
