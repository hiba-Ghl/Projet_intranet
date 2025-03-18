<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id('IDdocument');
            $table->string('titre');
            $table->timestamp('date_upload')->useCurrent();
            $table->unsignedBigInteger('auteur');
            $table->string('chemin_fichier');
            $table->foreign('auteur')->references('IDUtilisateur')->on('utilisateurs')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
