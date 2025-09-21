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
        Schema::create('documents_cours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classe_matiere_id')->constrained('classes_matieres')->onDelete('cascade');
            $table->string('titre');
            $table->text('description')->nullable();
            $table->enum('type', ['fichier', 'lien'])->default('fichier');
            $table->string('fichier_path')->nullable();
            $table->string('lien_url')->nullable();
            $table->foreignId('enseignant_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents_cours');
    }
};
