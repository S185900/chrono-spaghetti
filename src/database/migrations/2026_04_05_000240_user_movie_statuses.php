<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserMovieStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_movie_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // 【修正ポイント】相手の integer('tmdb_id') に合わせて、こちらも unsigned をつけない
            $table->integer('tmdb_content_id'); 
            
            $table->string('status'); 
            $table->text('user_comment')->nullable();
            // $table->integer('rating')->nullable();
            $table->tinyInteger('rating')->nullable();
            $table->timestamps();

            // これで型が完全に一致するので通るはずです
            $table->foreign('tmdb_content_id')
                ->references('tmdb_id')
                ->on('tmdb_contents')
                ->onDelete('cascade');
            
            $table->unique(['user_id', 'tmdb_content_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
