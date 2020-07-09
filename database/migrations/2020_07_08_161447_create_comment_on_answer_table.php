<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentOnAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_on_answer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('content');
            $table->unsignedBigInteger('answer_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('comment_on_answer');
    }
}
