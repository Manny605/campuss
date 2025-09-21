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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inscription_id')->constrained()->onDelete('cascade');
            $table->foreignId('devoir_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('examen_id')->nullable()->constrained()->onDelete('cascade');
            $table->decimal('note', 6, 2);
            $table->string('commentaire')->nullable();
            $table->foreignId('corrige_par')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
