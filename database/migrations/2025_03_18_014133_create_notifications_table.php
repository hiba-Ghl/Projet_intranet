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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('IDnotification');
            $table->text('message');
            $table->timestamp('date_envoi')->useCurrent();
            $table->unsignedBigInteger('utilisateur_destinataire');
            $table->boolean('lue')->default(false);
            $table->foreign('utilisateur_destinataire')->references('IDUtilisateur')->on('utilisateurs')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
