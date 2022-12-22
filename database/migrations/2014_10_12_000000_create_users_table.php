<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nickname');
            $table->string('first_name');
            $table->string('last_name');
            $table->unsignedBigInteger('image_id')->nullable();
            $table->date('date_of_birth');
            $table->string('phone_number');
            $table->text('forgot_password_code')->nullable();
            $table->string('email')->unique();
            $table->enum('userType', ['admin', 'mentor', 'employee'])->default('employee');
            $table->boolean('new_employee');
            $table->text('description')->nullable();
            $table->string('password');
            $table->string('gender',2);
            $table->text("position");
            $table->rememberToken();
            $table->timestamps();
        });



        //add key for authentication
        Schema::table('users', function ($table) {
            $table->string('api_token', 80)->after('password')
                ->unique()
                ->nullable()
                ->default(null);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
