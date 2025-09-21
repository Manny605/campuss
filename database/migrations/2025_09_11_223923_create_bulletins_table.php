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
        Schema::create('bulletins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inscription_id')->constrained()->onDelete('cascade');
            $table->foreignId('periode_id')->constrained()->onDelete('cascade');
            $table->decimal('moyenne_generale', 5, 2);
            $table->integer('rang')->nullable();
            $table->text('appreciation')->nullable();
            $table->datetime('date_generation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulletins');
    }
};
