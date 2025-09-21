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
        Schema::create('frais', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('nom');
            $table->decimal('montant', 10, 2);
            $table->string('frequence'); // mensuel, trimestriel, annuel
            $table->boolean('obligatoire')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frais');
    }
};
