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
        Schema::create('annees', function (Blueprint $table) {
            $table->id();
            $table->string('libelle')->unique(); // Ex : "2024-2025"
            $table->boolean('active')->default(false); // Pour indiquer l’année académique active
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annees');
    }
};
