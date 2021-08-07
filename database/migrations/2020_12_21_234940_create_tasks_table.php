<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigInteger("task_id")->autoIncrement();
            $table->string("task_name" , 225);
            $table->bigInteger("group_id")->nullable();
            $table->foreign('group_id')->references('group_id')->on('groups');
            $table->longText("task_description");
            $table->timestamp("EDT")->nullable();
            $table->enum("task_type" , [1,2,3]);//1- for task 2-for quizes 3-for exams
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
