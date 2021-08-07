<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id("answer_id")->autoIncrement();
            $table->bigInteger("group_id")->nullable();
            $table->bigInteger("task_id")->nullable();
            $table->foreign('group_id')->references('group_id')->on('groups');
            $table->foreign('task_id')->references('task_id')->on('tasks');
            $table->string("answer_name" ,225);
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
        Schema::dropIfExists('answers');
    }
}
