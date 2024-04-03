<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Events extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('event', function (Blueprint $table) {
            $table->bigIncrements('eventid')->unsigned()->index();
            $table->string('descrizione');
            $table->string('programma');
            $table->bigInteger('societaid')->unsigned();
            $table->string('luogo');
            $table->string('categoria');
            $table->date('data');
            $table->time('orario');
            $table->string('nome');
            $table->integer('scontoPerc');
            $table->integer('nGiorniAttSconto');
            $table->tinyInteger('sconto');
            $table->float('incassoTotale')->default('0');
            $table->integer('bigl_tot');
            $table->integer('bigl_acquis');
            $table->decimal('Xcord',11,7);
            $table->decimal('Ycord',11,7);
            $table->float('prezzo');
            $table->string('image')->nullable();
            $table->foreign('societaid')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('event');
    }

}
