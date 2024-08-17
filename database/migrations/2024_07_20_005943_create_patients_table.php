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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('matricule');
            $table->string('nom_pere')->nullable();
            $table->string('nom_mere')->nullable();
            $table->string('prenom');
            $table->string('adresse');
            $table->string('prfs');
            $table->string('photos')->nullable();
            $table->date('dateN'); 
            $table->string('telephone');
            $table->string('email')->unique()->nullable();
            $table->enum('genre',["Homme","Femme"]);
            $table->enum('groupe_sanguin',['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
            $table->string('contact_urgence_nom');
            $table->string('contact_urgence_telephone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
