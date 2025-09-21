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
        Schema::create('devoirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classe_matiere_id')->constrained('classes_matieres')->onDelete('cascade');
            $table->string('titre');
            $table->string('type');
            $table->string('date_devoir')->nullable();
            $table->decimal('note_max', 5, 2)->default(20);
            $table->foreignId('enseignant_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devoirs');
    }
};
