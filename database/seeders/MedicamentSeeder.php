<?php

namespace Database\Seeders;
use App\Models\Forme;


use App\Models\Medicament;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MedicamentSeeder extends Seeder
    {
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formes = Forme::all();

        $medicaments = [
            [
                'photos' => null,
                'stock' => 100,
                'dosage' => '500mg',
                'ingredient' => 'Paracetamol',
                'nom' => 'Paracétamol',
                'prix' => 1000,
                'date_peremption' => '2025-12-31',
                'description' => 'Analgésique et antipyrétique.',
                'fabricant' => 'Sanofi',
                'date_fabrication' => '2023-01-01',
                'type_medicament' => 'Générique',
                'formes' => ['Comprimé'],
                'forme_id' => $formes->where('forme', 'Comprimé')->first()->id,
            ],
            [
                'photos' => null,
                'stock' => 50,
                'dosage' => '100ml',
                'ingredient' => 'Dextromethorphan',
                'nom' => 'Sirop pour la toux',
                'prix' => 3000,
                'date_peremption' => '2024-12-31',
                'description' => 'Sirop antitussif.',
                'fabricant' => 'Pfizer',
                'date_fabrication' => '2023-02-01',
                'type_medicament' => 'Original',
                'formes' => ['Sirop'],
                'forme_id' => $formes->where('forme', 'Sirop')->first()->id,
            ],
            [
                'photos' => null,
                'stock' => 80,
                'dosage' => '250mg',
                'ingredient' => 'Amoxicilline',
                'nom' => 'Amoxicilline',
                'prix' => 1000,
                'date_peremption' => '2025-06-30',
                'description' => 'Antibiotique à large spectre.',
                'fabricant' => 'GSK',
                'date_fabrication' => '2023-03-01',
                'type_medicament' => 'Original',
                'formes' => ['Capsule'],
                'forme_id' => $formes->where('forme', 'Capsule')->first()->id,

            ],
            [
                'photos' => null,
                'stock' => 120,
                'dosage' => '200mg',
                'ingredient' => 'Ibuprofène',
                'nom' => 'Advil',
                'prix' => 800,
                'date_peremption' => '2024-09-30',
                'description' => 'Anti-inflammatoire non stéroïdien.',
                'fabricant' => 'Pfizer',
                'date_fabrication' => '2023-04-01',
                'type_medicament' => 'Original',
                'formes' => ['Comprimé'],
                'forme_id' => $formes->where('forme', 'Comprimé')->first()->id,


            ],
            [
                'photos' => null,
                'stock' => 90,
                'dosage' => '500mg/5ml',
                'ingredient' => 'Paracetamol',
                'nom' => 'Doliprane Sirop',
                'prix' => 1200,
                'date_peremption' => '2025-03-31',
                'description' => 'Sirop analgésique pour enfants.',
                'fabricant' => 'Sanofi',
                'date_fabrication' => '2023-05-01',
                'type_medicament' => 'Original',
                'formes' => ['Sirop'],
                'forme_id' => $formes->where('forme', 'Sirop')->first()->id,


            ],
            [
                'photos' => null,
                'stock' => 60,
                'dosage' => '10mg',
                'ingredient' => 'Loratidine',
                'nom' => 'Claritin',
                'prix' => 1500,
                'date_peremption' => '2024-08-31',
                'description' => 'Antihistaminique pour allergies.',
                'fabricant' => 'Bayer',
                'date_fabrication' => '2023-06-01',
                'type_medicament' => 'Original',
                'formes' => ['Comprimé'],
                'forme_id' => $formes->where('forme', 'Comprimé')->first()->id,

            ],
            [
                'photos' => null,
                'stock' => 110,
                'dosage' => '50mg/2ml',
                'ingredient' => 'Cetirizine',
                'nom' => 'Zyrtec',
                'prix' => 2000,
                'date_peremption' => '2024-11-30',
                'description' => 'Antihistaminique pour allergies.',
                'fabricant' => 'UCB',
                'date_fabrication' => '2023-07-01',
                'type_medicament' => 'Original',
                'formes' => ['Injection'],
                'forme_id' => $formes->where('forme', 'Injection')->first()->id,

            ],
            [
                'photos' => null,
                'stock' => 40,
                'dosage' => '0.5mg',
                'ingredient' => 'Nitroglycérine',
                'nom' => 'Nitrostat',
                'prix' => 2500,
                'date_peremption' => '2024-10-31',
                'description' => 'Vasodilatateur pour angine.',
                'fabricant' => 'Pfizer',
                'date_fabrication' => '2023-08-01',
                'type_medicament' => 'Original',
                'formes' => ['Gélule molle'],
                'forme_id' => $formes->where('forme', 'Gélule molle')->first()->id,

            ],
            [
                'photos' => null,
                'stock' => 150,
                'dosage' => '100mg',
                'ingredient' => 'Ranitidine',
                'nom' => 'Zantac',
                'prix' => 600,
                'date_peremption' => '2025-01-31',
                'description' => 'Antiacide pour reflux gastro-œsophagien.',
                'fabricant' => 'GlaxoSmithKline',
                'date_fabrication' => '2023-09-01',
                'type_medicament' => 'Original',
                'formes' => ['Comprimé'],
                'forme_id' => $formes->where('forme', 'Comprimé')->first()->id,

            ],
            [
                'photos' => null,
                'stock' => 70,
                'dosage' => '1g/10ml',
                'ingredient' => 'Amoxicilline',
                'nom' => 'Amoxil',
                'prix' => 1800,
                'date_peremption' => '2024-07-31',
                'description' => 'Antibiotique en suspension.',
                'fabricant' => 'GSK',
                'date_fabrication' => '2023-10-01',
                'type_medicament' => 'Original',
                'formes' => ['Suspension buvable'],
                'forme_id' => $formes->where('forme', 'Suspension buvable')->first()->id,

            ],
        ];

        foreach ($medicaments as $data) {
            $formesData = $data['formes'];
            unset($data['formes']);

            $medicament = Medicament::create($data);
            foreach ($formesData as $formeName) {
                $forme = $formes->where('forme', $formeName)->first();
                if ($forme) {
                    $medicament->formes()->attach($forme->id);
                }
            }
        }
    }

}

