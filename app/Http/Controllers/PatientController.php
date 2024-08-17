<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Patient;
use App\Models\Allergie;
use App\Models\Habitude;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\HistoriqueMedical;

class PatientController extends Controller
{
    //Afficher la liste de tote les médecin
    public function index()
    {
        $patients = Patient::All();

        return Inertia::render(
            'Patients/index',
            ["patients" => $patients]
        );
    }


    public function show(String $matricule)
    {


        $patient = Patient::where("matricule", $matricule)->with("allergies", "historique_medical")->first();


        return Inertia::render('Patients/show', ["patient" => $patient]);
    }



    //Afficher ke formulaire de création d'un docteur
    public function insert()
    {

        return Inertia::render('Patients/form');
    }


    public function create(Request $request)
    {
        // Validation des données principales
        $validatedData = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'matricule' => 'required|string|max:255|unique:patients,matricule',
            'adresse' => 'required|string|max:255',
            'prfs' => 'required|string|max:255',
            'nom_pere' => $request->input('age') >= 18 ? 'nullable|string|max:255' : 'required|string|max:255',
            'nom_mere' => $request->input('age') >= 18 ? 'nullable|string|max:255' : 'required|string|max:255',
            'dateN' => 'required|date|before_or_equal:today',
            'telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:patients,email',
            'genre' => 'required|in:Homme,Femme',
            'num_securite_sociale' => 'nullable|string|unique:patients,num_securite_sociale',
            'groupe_sanguin' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'contact_urgence_nom' => $request->input('age') >= 18 ? 'required|string|max:255' : 'nullable|string|max:255',
            'contact_urgence_telephone' => $request->input('age') >= 18 ? 'required|string|max:10' : 'nullable|string|max:20',
            'photos' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validation pour l'image
        ]);

        if ($request->input('allergies')  !== null) {
            $request->validate([
                'allergies.*.name' => 'required|string|max:255',
                'allergies.*.description' => 'nullable|string|max:500',
            ]);
        }

        if ($request->input('habitudes') !== null) {
            // Validation des données additionnelles
            $request->validate([
                'habitudes.*.nom' => 'required|string|max:255',
                'habitudes.*.dateD' => 'nullable|date|before_or_equal:today',
                'habitudes.*.dateF' => 'nullable|date|after_or_equal:habitudes.*.dateD',
            ]);
        }

        if ($request->input('historique_medical') !== null) {
            // Validation des données additionnelles
            $request->validate([
                'historique_medical.*.maladie' => 'required|string|max:255',
                'historique_medical.*.date' => 'required|date|before_or_equal:today',
                'historique_medical.*.description' => 'nullable|string|max:500',
                'historique_medical.*.encours_traitement' => 'required|boolean',
                'historique_medical.*.type' => 'nullable|in:Familiale,Personnelle',
                'historique_medical.*.category' => 'nullable|in:Médicale,chirurgicale,Ginéco-Opstétrique',
                'historique_medical.*.hereditary' => 'required|boolean',
                'historique_medical.*.medications' => 'nullable|string|max:500',
            ]);
        }

        // Gestion de l'image
        if ($request->hasFile('photos')) {
            $image = $request->file('photos');
            $imageName = time() . '.' . $image->extension();
            $path = $request->file('photos')->storeAs('images', $imageName, 'public');
            $validatedData['photos'] = '/storage/' . $path;
        }

        // Création du patient
        $patient = Patient::create($validatedData);

        // Insertion des allergies
        if ($request->has('allergies')) {
            foreach ($request->input('allergies') as $allergie) {
                Allergie::create([
                    'patient_id' => $patient->id,
                    'name' => $allergie['name'],
                    'description' => $allergie['description'],
                ]);
            }
        }

        // Insertion des historiques médicaux
        if ($request->has('historique_medical')) {
            foreach ($request->input('historique_medical') as $historique) {
                HistoriqueMedical::create([
                    'patient_id' => $patient->id,
                    'maladie' => $historique['maladie'],
                    'date' => $historique['date'],
                    'description' => $historique['description'],
                    'encours_traitement' => $historique['encours_traitement'],
                    'type' => $historique['type'],
                    'category' => $historique['category'],
                    'hereditary' => $historique['hereditary'],
                    'medications' => $historique['medications'],
                ]);
            }
        }

        // Insertion des habitudes
        if ($request->has('habitudes')) {
            foreach ($request->input('habitudes') as $habitude) {
                Habitude::create([
                    'patient_id' => $patient->id,
                    'nom' => $habitude['nom'],
                    'dateD' => $habitude['dateD'],
                    'dateF' => $habitude['dateF'],
                ]);
            }
        }

        return redirect()->route('patient.create')->with('message', 'Patient ajouté');
    }

    //Supprimer un Docteur
    public function destroy(String $id)
    {
        $doctor = Patient::findOrFail($id);

        $doctor->delete();

        return redirect()->route('patient.all')->with('message', 'Patient supprimé');
    }

    /**
     * Afficher le formulaire de modification de docteur
     *
     * @param String $id
     * @return void
     */
    public function edit(Request $req)
    {
        $patient = Patient::where("matricule", $req["matricule"])->with("allergies", "historique_medical")->first();
        return Inertia::render('Patients/edit', ["patient" => $patient]);
    }

    public function update(Request $request)
    {
        // Validation des données principales
        $validatedData = $request->validate([
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'matricule' => ['required', 'string', 'max:255', Rule::unique('patients')->ignore($request["id"])],
            'adresse' => 'required|string|max:255',
            'prfs' => 'required|string|max:255',
            'nom_pere' => $request->input('age') >= 18 ? 'nullable|string|max:255' : 'required|string|max:255',
            'nom_mere' => $request->input('age') >= 18 ? 'nullable|string|max:255' : 'required|string|max:255',
            'dateN' => 'required|date|before_or_equal:today',
            'telephone' =>  ['required', 'numeric', Rule::unique('patients')->ignore($request["id"])],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('patients')->ignore($request["id"])],
            'genre' => 'required|in:Homme,Femme',
            'num_securite_sociale' => 'nullable|string|unique:patients,num_securite_sociale',
            'groupe_sanguin' => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'contact_urgence_nom' => $request->input('age') >= 18 ? 'required|string|max:255' : 'nullable|string|max:255',
            'contact_urgence_telephone' => $request->input('age') >= 18 ? 'required|string|max:10' : 'nullable|string|max:10',
            'photos' => $request->hasFile('photos')?'nullable|image|mimes:jpeg,png,jpg|max:2048':'nullable',
        ]);

        if ($request->input('allergies')  !== null) {
            $request->validate([
                'allergies.*.name' => 'required|string|max:255',
                'allergies.*.description' => 'nullable|string|max:500',
            ]);
        }

        if ($request->input('habitudes') !== null) {
            // Validation des données additionnelles
            $request->validate([
                'habitudes.*.nom' => 'required|string|max:255',
                'habitudes.*.dateD' => 'nullable|date|before_or_equal:today',
                'habitudes.*.dateF' => 'nullable|date|after_or_equal:habitudes.*.dateD',
            ]);
        }

        if ($request->input('historique_medical') !== null) {
            // Validation des données additionnelles
            $request->validate([
                'historique_medical.*.maladie' => 'required|string|max:255',
                'historique_medical.*.date' => 'required|date|before_or_equal:today',
                'historique_medical.*.description' => 'nullable|string|max:500',
                'historique_medical.*.encours_traitement' => 'required|boolean',
                'historique_medical.*.type' => 'nullable|in:Familiale,Personnelle',
                'historique_medical.*.category' => 'nullable|in:Médicale,chirurgicale,Ginéco-Opstétrique',
                'historique_medical.*.hereditary' => 'required|boolean',
                'historique_medical.*.medications' => 'nullable|string|max:500',
            ]);
        }

        // Gestion de l'image
        if ($request->hasFile('photos')) {
            $image = $request->file('photos');
            $imageName = time() . '.' . $image->extension();
            $path = $request->file('photos')->storeAs('images', $imageName, 'public');
            $validatedData['photos'] = '/storage/' . $path;
        }


        // Création du patient
        $patient = Patient::find($request["id"])->first();

        $patient->update($validatedData);

        // Insertion des allergies
        if ($request->has('allergies')) {
            $findAllergie=Allergie::where("patient_id",$patient["id"])->first();
            foreach ($request->input('allergies') as $allergie) {
               if($findAllergie){
                $findAllergie->update([
                    'name' => $allergie['name'],
                    'description' => $allergie['description'],
                ]);
               }else{
                Allergie::create([
                    'patient_id' => $patient->id,
                    'name' => $allergie['name'],
                    'description' => $allergie['description'],
                ]);
               }
            }
        }

        // Insertion des historiques médicaux
        if ($request->has('historique_medical')) {
            $findH=HistoriqueMedical::where("patient_id",$patient["id"])->first();
            foreach ($request->input('historique_medical') as $historique) {
               if($findH){
                $findH->update([
                    'maladie' => $historique['maladie'],
                    'date' => $historique['date'],
                    'description' => $historique['description'],
                    'encours_traitement' => $historique['encours_traitement'],
                    'type' => $historique['type'],
                    'category' => $historique['category'],
                    'hereditary' => $historique['hereditary'],
                    'medications' => $historique['medications'],
                ]);
               }else{
                HistoriqueMedical::create([
                    'patient_id' => $patient->id,
                    'maladie' => $historique['maladie'],
                    'date' => $historique['date'],
                    'description' => $historique['description'],
                    'encours_traitement' => $historique['encours_traitement'],
                    'type' => $historique['type'],
                    'category' => $historique['category'],
                    'hereditary' => $historique['hereditary'],
                    'medications' => $historique['medications'],
                ]);
               }
            }
        }

        // Insertion des habitudes
        if ($request->has('habitudes')) {
            $findH=Habitude::where("patient_id",$patient["id"])->first();
            foreach ($request->input('habitudes') as $habitude) {
                if($findH){

                    $findH->update([
                        'nom' => $habitude['nom'],
                        'dateD' => $habitude['dateD'],
                        'dateF' => $habitude['dateF'],
                    ]);
                }else{
                    Habitude::create([
                        'patient_id' => $patient->id,
                        'nom' => $habitude['nom'],
                        'dateD' => $habitude['dateD'],
                        'dateF' => $habitude['dateF'],
                    ]);
                }
            }
        }

        return redirect()->route('patient.all')->with('message', 'Patient ajouté');
    }
}
