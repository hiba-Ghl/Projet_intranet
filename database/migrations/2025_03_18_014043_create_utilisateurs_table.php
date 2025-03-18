<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id('IDUtilisateur');
            $table->string('nom');
            $table->string('email')->unique();
            $table->string('mot_de_passe');
            $table->string('role');
            $table->timestamp('date_inscription')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('utilisateurs');
    }
};
