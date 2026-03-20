<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmdbContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tmdb_contents', function (Blueprint $table) {
            $table->id();
            $table->integer('tmdb_id')->unique();
            $table->string('media_type'); 
            $table->string('title');
            $table->string('poster_path')->nullable();
            $table->date('release_date')->nullable();
            $table->text('overview')->nullable();

            // 追加分
            $table->string('director')->nullable();    // 監督名
            $table->json('cast')->nullable();          // 俳優5名を配列（JSON）で保存

            $table->boolean('is_coming_soon')->default(true);
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
        Schema::dropIfExists('tmdb_contents');
    }
}
