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
        Schema::create('historique_medicals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->string('maladie');
            $table->date('date');
            $table->text('description')->nullable();
            $table->boolean('encours_traitement')->default(false);
            $table->enum('type',["Familiale","Personnelle"])->nullable();
            $table->enum('category',["Médicale","chirurgicale","Ginéco-Opstétrique"])->nullable();
            $table->boolean('hereditary')->default(false);
            $table->text('medications')->nullable();
            $table->timestamps();
            
            // Foreign key constraint
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique_medicals');
    }
};
