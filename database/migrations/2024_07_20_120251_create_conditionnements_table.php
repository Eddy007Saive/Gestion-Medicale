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
        Schema::create('conditionnements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medicament_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('type'); // Exemple: "cachet", "boite", etc.
            $table->integer('prix',);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conditionnements');
    }
};
