<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MatchDetailChallenges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_detail_challenges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id');
            $table->foreignId('sub_match_id')->nullable();
            $table->foreignId('user_id_from');
            $table->foreignId('user_id_to');
            $table->integer('potin_user_id_from');
            $table->integer('potin_user_id_to');
            $table->foreignId('user_id_win');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_detail_challenges');
    }
}