<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarteEtudiantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carte_etudiants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id');
            $table->string('nomEtudiant');
            $table->date('dateEntreeEnc');
            $table->integer('numeroTelephone');
            $table->string('fichier');
            $table->string('email');
            $table->string('section');
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
        Schema::dropIfExists('carte_etudiants');
    }
}
