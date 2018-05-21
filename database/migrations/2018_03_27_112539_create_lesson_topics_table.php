<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_topics', function (Blueprint $table) {
            $table->bigInteger('lesson_id')->unsigned();
            $table->bigInteger('topic_id')->unsigned();

            $table->primary(['lesson_id', 'topic_id']);

            $table->foreign('lesson_id')->references('id')->on('lessons');
            $table->foreign('topic_id')->references('id')->on('topics');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_topics');
    }
}
