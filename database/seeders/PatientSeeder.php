<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create("FR_fr");

        for ($i = 0; $i < 3; $i++) {
            $imagePath = $faker->image('public/storage/images', 640, 480, 'technics', false);


            Patient::create([
                'nom' => $faker->lastName,
                'prenom' => $faker->firstName,
                'adresse' => $faker->address,
                'photos' => $imagePath,
                'dateN' => $faker->date(),
                'telephone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'genre' => $faker->randomElement(['Homme', 'Femme']),
                'num_securite_sociale' => $faker->unique()->numerify('###-##-####'),
                'groupe_sanguin' => $faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
                'historique_medical' => $faker->paragraph,
                'allergies' => $faker->words(3, true),
                'contact_urgence_nom' => $faker->name,
                'contact_urgence_telephone' => $faker->phoneNumber,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
