<?php

namespace App\Http\Controllers;

use App\Student;
use App\Task;
use App\Traits\errorSuccessTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    use errorSuccessTrait;

    public function index(){
        $tasks = Task::with("groups")->get();

        if($tasks){
            return $this->returnOnSuccessWithData("data" , $tasks,"Task Retrieved Successfully" , true );
        }
        return $this->returnOnError("failed to retrieve Task" , false , "G001");
    }



    public function store(Request $request){
        $newTask =  json_decode($request->getContent() , true);
        $newTask =  $newTask["createTask"];
        $task = Task::create($newTask);
        if($task){
            return $this->returnOnSuccessWithData("data" , $task,"Task created Successfully" , true );
        }
        return $this->returnOnError("failed to Add new Task" , false , "S001");
    }

    public function edit(Request $request ,$id){
        try{
            $findTask = Task::findOrFail($id);
        }catch(\Exception $e){
            return $e->getMessage();
        }

        if($findTask){
            return $this->returnOnSuccessWithData("data" , $findTask,"Task Retrieved Successfully" , true );
        }
        return $this->returnOnError("failed to retrieve Task" , false , "S001");
    }
}
