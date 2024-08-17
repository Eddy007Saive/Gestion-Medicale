<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('specialites', function (Blueprint $table) {
            $table->id();
            $table->string("specialite");
            $table->timestamps();
        });

        $specialties = [
            'Cardiologie',
            'Neurologie',
            'Pédiatrie',
            'Gastro-entérologie',
            'Dermatologie',
            'Oncologie',
            'Rhumatologie',
            'Endocrinologie',
            'Psychiatrie',
            'Chirurgie orthopédique',
            'Médecine interne',
            'Allergologie',
            'Gynécologie',
            'Ophtalmologie',
            'Oto-rhino-laryngologie',
            'Pneumologie',
            'Réanimation',
            'Médecine du travail',
            'Médecine sportive',
            'Urologie',
        ];

        foreach ($specialties as $specialty) {
            DB::table('specialites')->insert([
                'specialite' => $specialty,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialites');
    }
};
