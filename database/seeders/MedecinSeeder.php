<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Medecin;
use App\Models\Specialite;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MedecinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create("FR_fr");
        
        // Récupérer les IDs des spécialités
        $spectialite = Specialite::inRandomOrder()->first();


        for ($i = 0; $i < 5; $i++) {
            $name=$faker->name();
            
            $user=User::create([
                'email' =>  $name.'@gmail.com',
                'password' => Hash::make('password123'), // Assurez-vous d'utiliser Hash::make pour les mots de passe
                'role' => 'Medecin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            Medecin::create([
                'name' =>  $name,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'specialite_id' => $spectialite->id,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
    }
