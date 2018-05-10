<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('age_from')->nullable();
            $table->integer('age_to')->nullable();
            $table->string('gender', 100)->nullable();
            $table->text('favorite_topics')->nullable();
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->text('other_info')->nullable();
            $table->bigInteger('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('partner_posts');
    }
}
