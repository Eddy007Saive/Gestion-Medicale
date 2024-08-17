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
        Schema::create('formes', function (Blueprint $table) {
            $table->id();
            $table->string("forme",50);
            $table->string("unite",50);

            $table->timestamps();
        });

        $formes = [
            ['forme' => 'Comprimé', 'unite' => 'mg'],
            ['forme' => 'Capsule', 'unite' => 'mg'],
            ['forme' => 'Gélule', 'unite' => 'mg'],
            ['forme' => 'Sirop', 'unite' => 'ml'],
            ['forme' => 'Solution buvable', 'unite' => 'ml'],
            ['forme' => 'Suspension buvable', 'unite' => 'ml'],
            ['forme' => 'Poudre pour suspension buvable', 'unite' => 'g'],
            ['forme' => 'Injection', 'unite' => 'ml'],
            ['forme' => 'Perfusion', 'unite' => 'ml'],
            ['forme' => 'Suppositoire', 'unite' => 'mg'],
            ['forme' => 'Crème', 'unite' => 'g'],
            ['forme' => 'Pommade', 'unite' => 'g'],
            ['forme' => 'Gel', 'unite' => 'g'],
            ['forme' => 'Lotion', 'unite' => 'ml'],
            ['forme' => 'Emplâtre', 'unite' => 'cm2'],
            ['forme' => 'Patch', 'unite' => 'cm2'],
            ['forme' => 'Inhalateur', 'unite' => 'dose'],
            ['forme' => 'Aérosol', 'unite' => 'dose'],
            ['forme' => 'Spray nasal', 'unite' => 'dose'],
            ['forme' => 'Collyre', 'unite' => 'ml'],
            ['forme' => 'Gouttes auriculaires', 'unite' => 'ml'],
            ['forme' => 'Gouttes ophtalmiques', 'unite' => 'ml'],
            ['forme' => 'Gélule molle', 'unite' => 'mg'],
            ['forme' => 'Pastille', 'unite' => 'mg'],
            ['forme' => 'Granulé', 'unite' => 'g'],
            ['forme' => 'Sachet-dose', 'unite' => 'g'],
            ['forme' => 'Comprimé effervescent', 'unite' => 'mg'],
            ['forme' => 'Comprimé orodispersible', 'unite' => 'mg'],
            ['forme' => 'Bain de bouche', 'unite' => 'ml'],
            ['forme' => 'Ovule', 'unite' => 'mg'],
            ['forme' => 'Stylo injecteur', 'unite' => 'dose'],
            ['forme' => 'Préparation magistrale', 'unite' => 'varie'],
        ];

        foreach ($formes as $forme) {
            DB::table('formes')->insert([
                'forme' => $forme["forme"],
                'unite' => $forme["unite"],
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
        Schema::dropIfExists('formes');
    }
};
