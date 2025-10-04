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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annee_id')->constrained()->onDelete('cascade');
            $table->foreignId('filiere_niveau_id')->constrained('filiere_niveau')->onDelete('cascade');
            $table->string('nom'); // ex: CS1, CS2, SE
            $table->string('capacite')->nullable(); // ex: 50, 60 personnes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
