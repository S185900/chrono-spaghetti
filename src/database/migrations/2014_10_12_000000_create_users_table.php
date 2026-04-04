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
            // user_serial を id の後に置きたいならここに書く
            $table->string('user_serial')->unique()->nullable(); 
            
            $table->string('name');
            $table->string('email')->unique();
            
            // profile_photo_path を email の後に置きたいならここに書く
            $table->string('profile_photo_path')->nullable();
            $table->text('bio')->nullable();
            
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
