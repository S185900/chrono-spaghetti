<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MovieArchives extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_archives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('tmdb_content_id')->constrained()->onDelete('cascade');

            $table->date('watched_at')->nullable(); // 鑑賞日
            $table->integer('rating')->default(0);  // 星評価 (1-5)
            $table->text('comment')->nullable();    // 感想文（textareaの内容）

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
        //
    }
}
