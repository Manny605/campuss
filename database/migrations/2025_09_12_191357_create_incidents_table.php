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
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inscription_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['observation', 'sanction']);
            $table->string('titre');
            $table->text('description');
            $table->enum('gravite', ['faible', 'moyen', 'élevé']);
            $table->date('date_incident');
            $table->foreignId('enregistre_par')->constrained('users')->onDelete('cascade');
            $table->boolean('notifier_parent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
