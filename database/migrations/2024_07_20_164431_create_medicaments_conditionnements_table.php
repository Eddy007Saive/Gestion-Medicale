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
        Schema::create('medicaments_conditionnements', function (Blueprint $table) {
            $table->foreignId('medicament_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('conditionnement_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->integer('qt'); // Quantité spécifique de ce conditionnement pour ce médicament
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicaments_conditionnements');
    }
};
