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
            $table->string('display_name');
            $table->string('avatar')->nullable();
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->string('password')->nullable();
            $table->string('address')->nullable();
            $table->date('dateOfBirth')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('token')->nullable();
            $table->boolean('isAdmin')->default(0);
            $table->boolean('isSubAdmin')->default(0);
            $table->integer('life_heart');
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('status');
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