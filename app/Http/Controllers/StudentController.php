<?php

namespace App\Http\Controllers;

use App\Group;
use App\Student;
use App\Traits\errorSuccessTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    use errorSuccessTrait;

    public function index(){
      $students = Student::with("groups")->get();
        if($students){
            return $this->returnOnSuccessWithData("data" , $students,"Student Retrieved Successfully" , true );
        }
        return $this->returnOnError("failed to retrieve Student" , false , "G001");
    }

    public function store(Request $request){
        $newStudent =  json_decode($request->getContent() , true);
        $newStudent =  $newStudent["json"];
        $student = Student::create($newStudent);
        if($student){
            return $this->returnOnSuccessWithData("data" , $student,"Student created Successfully" , true );
        }
        return $this->returnOnError("failed to Add new Student" , false , "S001");
    }


    public function edit(Request $request ,$id){
        try{
            $findStudent = Student::findOrFail($id);
        }catch(\Exception $e){
            return $e->getMessage();
        }

        if($findStudent){
            return $this->returnOnSuccessWithData("data" , $findStudent,"Student Retrieved Successfully" , true );
        }
        return $this->returnOnError("failed to retrieve Student" , false , "S001");
    }


    public function update(Request $request){
        try{
            $findStudent = Student::findOrFail($request->input("id"));
        }catch(\Exception $e){
            return $e->getMessage();
        }
        $findStudent->update($request->json);
        if($findStudent){
            return $this->returnOnSuccess("Student Updated Successfully" , true );
        }else{
            return $this->returnOnError("failed to update Student" , false , "S001");
        }
    }


    public function destroy(Request $request){
        try{
            $student = Student::findOrFail($request->input("id"));
        }
        catch (\Exception $e){
            return $e;
        }
        $student =  Student::destroy($request->input("id"));
        if($student){
            return $this->returnOnSuccess("Student Deleted Successfully" , true  , "");
        }
        return $this->returnOnError("failed to retrieve Student" , false , "DS001");
    }
}
