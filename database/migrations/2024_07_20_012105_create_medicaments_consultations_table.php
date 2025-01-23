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
        Schema::create('ordonnances', function (Blueprint $table) {
            $table->foreignId("medicament_id")->constrained()->onUpdate("cascade")->onDelete('cascade');
            $table->foreignId("consultation_id")->constrained()->onUpdate("cascade")->onDelete('cascade');
            $table->integer("dosage");
            $table->string("voieAdministration", 60);
            $table->integer("frequence");
            $table->integer("duree");
            $table->text("instruction");
            $table->primary(['medicament_id', 'consultation_id']);
            $table->timestamps();


        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicaments_consultations');
    }
};
