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
        Schema::create('discussions', function (Blueprint $table) {
            $table->id('IDdiscussion');
            $table->string('titre');
            $table->text('description');
            $table->timestamp('date_creation')->useCurrent();
            $table->unsignedBigInteger('IDforum');
            $table->foreign('IDforum')->references('IDforum')->on('forums')->onDelete('cascade');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discussions');
    }
};
