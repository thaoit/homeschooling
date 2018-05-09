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
            $table->integer('max_no_of_partners')->default(1);
            $table->text('favorite_topics')->nullable();
            $table->text('address')->nullable();
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
