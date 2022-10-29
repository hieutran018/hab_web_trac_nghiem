<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //* social_accounts.user_id -> users.id
        Schema::table('social_accounts', function (Blueprint $table) {
        $table->foreign('user_id')->references('id')->on('users');
        });
        
        //* ranking.user_id -> users.id
        Schema::table('ranking', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        //* news.user_id -> users.id
        //* news.news_category_id -> news_category.id
        Schema::table('news', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('news_category_id')->references('id')->on('news_categories');
        });

        //* questions.topic_id -> topic_questions.id
        //* questions.level_id -> levels.id
        Schema::table('questions', function (Blueprint $table) {
            $table->foreign('topic_id')->references('id')->on('topic_questions');
            $table->foreign('level_id')->references('id')->on('levels');
        });

        //* answer_questions.question_id -> questions.id
        Schema::table('answer_questions', function (Blueprint $table) {
            $table->foreign('question_id')->references('id')->on('questions');
        });

        //* answer_questions.question_id -> questions.id
        //* matches.topic_question_id -> topic_questions.id
        //* matches.level_id -> levels.id
        Schema::table('matches', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('topic_question_id')->references('id')->on('topic_questions');
            $table->foreign('level_id')->references('id')->on('levels');
        });

        //* match_detail_single.match_id -> matches.id
        Schema::table('match_detail_single', function (Blueprint $table) {
            $table->foreign('match_id')->references('id')->on('matches');
        });

        //* match_detail_challenges.match_id -> matches.id
        //* match_detail_challenges.user_id_from -> users.id
        //* match_detail_challenges.user_id_to -> users.id
        //* match_detail_challenges.user_id_win -> users.id
        Schema::table('match_detail_challenges', function (Blueprint $table) {
            $table->foreign('match_id')->references('id')->on('matches');
            $table->foreign('user_id_from')->references('id')->on('users');
            $table->foreign('user_id_to')->references('id')->on('users');
            $table->foreign('user_id_win')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('posts', function (Blueprint $table) {
        //      $table->dropForeign('posts_id_user_foreign');
        //  });
    }
}