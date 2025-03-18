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
        Schema::create('messages', function (Blueprint $table) {
            $table->id('IDmessage');
            $table->text('contenu');
            $table->timestamp('date_envoi')->useCurrent();
            $table->unsignedBigInteger('auteur');
            $table->unsignedBigInteger('IDdiscussion');
            $table->foreign('auteur')->references('IDUtilisateur')->on('utilisateurs')->onDelete('cascade');
            $table->foreign('IDdiscussion')->references('IDdiscussion')->on('discussions')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
