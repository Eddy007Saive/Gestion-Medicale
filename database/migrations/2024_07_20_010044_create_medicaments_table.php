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
        Schema::create('medicaments', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->string("photos",150)->nullable();
            $table->integer("stock");
            $table->integer("prix");
            $table->string("dosage");
            $table->text("ingredient");
            $table->date("date_peremption"); //Date de peremption
            $table->text("description")->nullable();
            $table->string("fabricant")->nullable();
            $table->date("date_fabrication")->nullable();
            $table->string("type_medicament")->nullable();
            $table->foreignId("forme_id")->constrained()->onUpdate("cascade")->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicaments');
    }
};
