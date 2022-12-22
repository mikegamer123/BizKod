<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer("rating");
            $table->text("comment");
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("poi_id");
            $table->timestamps();

            //foreign keys
            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("poi_id")->references("id")->on("poi");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
