<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignkeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table)
        {
            //foreign constraints
            $table->foreign('image_id')->references('id')->on('images');
        });

        Schema::table('images', function (Blueprint $table)
        {
            //foreign keys
            $table->foreignId("user_id")->references("id")->on("users");
        });

        Schema::table('mentor_user', function (Blueprint $table)
        {

            //foreign keys
            $table->foreignId("mentor_id")->references("id")->on("users");
            $table->foreignId("employee_id")->references("id")->on("users");
        });

        Schema::table('poi', function (Blueprint $table)
        {
            //foreign keys
            $table->foreign('image_id')->references('id')->on('images');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('location_id')->references('id')->on('locations');
        });

        Schema::table('events', function (Blueprint $table)
        {

            //foreign keys
            $table->foreign('host_id')->references('id')->on('users');
            $table->foreign('location_id')->references('id')->on('locations');
        });

        Schema::table('languages_users', function (Blueprint $table)
        {
            //foreign keys
            $table->foreign("language_id")->references("id")->on("languages");
            $table->foreign("user_id")->references("id")->on("users");
        });

        Schema::table('visitors', function (Blueprint $table)
        {
            // foreign keys
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreignkeys');
    }
}
