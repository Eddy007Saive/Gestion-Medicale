<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Forme;
use App\Models\Medicament;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MedicamentController extends Controller
{
    public function index()
    {
        $medicaments = Medicament::with("formes")->get();
        return Inertia::render(
            "Medicaments/index",
            ["medicaments" => $medicaments]
        );
    }

    //Afficher ke formulaire de création d'un docteur
    public function insert()
    {
        $formes = Forme::All();

        return Inertia::render('Medicaments/form', ["formes" => $formes]);
    }


    //Insertion du Docteur
    public function create(Request $request)
    {

        $image = $request->file("photos");

        if ($request->file("photos")) {

            $imageName = time() . "." . $image->extension();

            $path = $request->file("photos")->storeAs(
                "images",
                $imageName,
                "public"
            );
        }
        // Valider et créer l'utilisateur
        $validated2 = $request->validate([
            'nom' => ['required', 'string', 'max:100', 'unique:medicaments'],
            'stock' => ['required', 'integer'],
            'prix' => ['required', 'integer'],
            'dosage' => ['required', 'string'],
            'ingredient' => ['string'],
            'date_peremption' => ['required', 'string'],
            'description' => ['required', 'string'],
            'date_fabrication' => ['required', 'string'],
            'type_medicament' => ['string',],
            'fabricant' => ['string', 'max:100'],
            'forme_id' => ['integer', 'exists:formes,id'],
        ]);

        $validated2['photos'] = "//storage/" . $path;

        Medicament::create($validated2);

        return redirect()->route('medicament.all')->with('message', 'Médecin créé avec succès');
    }

    public function update(Request $request)
    {

        // Valider et créer l'utilisateur
        $validated2 = $request->validate([
            'nom' => ['required', 'string', 'max:100', Rule::unique('medicaments')->ignore($request["id"])],
            'stock' => ['required', 'integer'],
            'prix' => ['required', 'integer'],
            'dosage' => ['required', 'string'],
            'ingredient' => ['string'],
            'date_peremption' => ['required', 'string'],
            'description' => ['required', 'string'],
            'date_fabrication' => ['required', 'string'],
            'type_medicament' => ['string',],
            'fabricant' => ['string', 'max:100'],
            'forme_id' => ['integer', 'exists:formes,id'],
        ]);


        $medicament = Medicament::find($request['id']);

        $image = $request->file("photos");

        if ($request->file("photos")) {

            $imageName = time() . "." . $image->extension();

            $path = $request->file("photos")->storeAs(
                "images",
                $imageName,
                "public"
            );
            $validated2['photos'] = "//storage/" . $path;
        }

        $medicament->update($validated2);

        return redirect()->route('medicament.all')->with('message', 'Médecin créé avec succès');
    }

    //Supprimer un Docteur
    public function destroy(String $id)
    {
        $doctor = Medicament::findOrFail($id);

        $doctor->delete();

        return redirect()->route('medicament.all')->with('message', 'Médecin créé avec succès');
    }



    /**
     * Afficher le formulaire de modification de docteur
     *
     * @param String $id
     * @return void
     */
    public function edit(Request $req, String $id)
    {
        $specialites = Forme::All();

        $medicament = Medicament::with("formes")->find($id);

        return Inertia::render('Medicaments/edit', ["formes" => $specialites, "medicament" => $medicament]);
    }
}
