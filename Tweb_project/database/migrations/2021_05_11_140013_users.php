<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome',20);
            $table->string('cognome',20)->nullable();
            $table->string('email')->unique();
            $table->string('username',20)->unique();;
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('data_nascita');
            $table->string('telefono',10);
            $table->string('sitoweb')->nullable();
            $table->string('role')->default('user');
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
        Schema::dropIfExists('user');
    }
}