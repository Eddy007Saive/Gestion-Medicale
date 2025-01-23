<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Patient;
use App\Models\Medicament;
use App\Models\Consultation;
use App\Models\HistoriqueMedical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\MedicamentsConsultations;
use Illuminate\Support\Facades\Validator;

class ConsultationController extends Controller
{
    public function index()
    {
        $consultations = Consultation::where("medecin_id", Auth::user()->id)->get();
        return Inertia::render(
            'Consultations/index',
            ["consultations" => $consultations]
        );
    }

    public function create(Request $req)
    {
        $patient = Patient::where("matricule", $req["matricule"])->with("allergies", "habitudes", "historique_medical")->first();
        $medicament = Medicament::with('formes')->get();
        return Inertia::render(
            'Consultations/form',
            ["patient" => $patient, "medicaments" => $medicament]
        );
    }


    public function store(Request $req)
    {
        // Directly validate the request
        $validatedData = Validator::make($req->all(), [
            'raison' => 'required|string',
            'motifs' => 'required|string|max:100',
            'diagnostic' => 'required|string|max:255',
            'poids' => 'required|integer|min:1|max:300 ',
            'taille' => 'required|integer|min:30|max:300',
            'temperature' => 'required|integer|min:0|max:100',
            'patient_id' => 'required|integer',
            'frequence_cardiaque' => 'required|integer',
            'glycemie' => 'nullable|integer',
            'medicaments.*.id' => 'required|integer|exists:medicaments,id',
            'medicaments.*.dosage' => 'required|integer',
            'medicaments.*.voieAdministration' => 'required|string|max:60',
            'medicaments.*.frequence' => 'required|integer',
            'medicaments.*.duree' => 'required|integer',
            'medicaments.*.instruction' => 'nullable|string',
        ], [
            'dateCons.required' => 'La date de la consultation est obligatoire.',
            'dateCons.date' => 'La date de la consultation doit être une date valide.',
            'motifs.required' => 'Le motif de la consultation est obligatoire.',
            'motifs.max' => 'Le motif ne peut pas dépasser 100 caractères.',
            'diagnostic.required' => 'Le diagnostic est obligatoire.',
            'diagnostic.max' => 'Le diagnostic ne peut pas dépasser 255 caractères.',
            'poids.required' => 'Le poids est obligatoire.',
            'poids.integer' => 'Le poids doit être un nombre entier.',
            'taille.required' => 'La taille est obligatoire.',
            'taille.integer' => 'La taille doit être un nombre entier.',
            'temperature.required' => 'La température est obligatoire.',
            'temperature.integer' => 'La température doit être un nombre entier.',
            'frequence_cardiaque.required' => 'La fréquence cardiaque est obligatoire.',
            'frequence_cardiaque.integer' => 'La fréquence cardiaque doit être un nombre entier.',
            'glycemie.integer' => 'La glycémie doit être un nombre entier.',
            'medicaments.*.id.required' => 'Le médicament est obligatoire.',
            'medicaments.*.id.exists' => 'Le médicament sélectionné n\'existe pas.',
            'medicaments.*.dosage.required' => 'Le dosage est obligatoire.',
            'medicaments.*.voieAdministration.required' => 'La voie d\'administration est obligatoire.',
            'medicaments.*.voieAdministration.max' => 'La voie d\'administration ne peut pas dépasser 60 caractères.',
            'medicaments.*.frequence.required' => 'La fréquence est obligatoire.',
            'medicaments.*.duree.required' => 'La durée est obligatoire.',
            'medicaments.*.instruction.string' => 'L\'instruction doit être une chaîne de caractères.',
        ]);

        if ($validatedData->fails()) {
        dd($validatedData);
            return redirect()->back()->withErrors($validatedData)->withInput();
        }

        $validatedData = $validatedData->validated();
        
        // 1. Préparer la consultation sans la sauvegarder
        $consultation = new Consultation();
        $consultation->dateCons = now();
        $consultation->motifs = $validatedData["motifs"];
        $consultation->diagnostic = $validatedData["diagnostic"];
        $consultation->poids = $validatedData["poids"];
        $consultation->taille = $validatedData["taille"];
        $consultation->temperature = $validatedData["temperature"];
        $consultation->frequence_cardiaque = $validatedData["frequence_cardiaque"];
        $consultation->glycemie = $validatedData["glycemie"];
        $consultation->raison = $validatedData["raison"];
        $consultation->medecin_id = 1;
        $consultation->patient_id = $validatedData["patient_id"];

        
        
        
        // 2. Préparer les relations avec les médicaments
        $medicaments = [];
        foreach ($validatedData["medicaments"] as $medicament) {
            $medicaments[$medicament['id']] = [
                'dosage' => $medicament['dosage'],
                'voieAdministration' => $medicament['voieAdministration'],
                'frequence' => $medicament['frequence'],
                'duree' => $medicament['duree'],
                'instruction' => $medicament['instruction'] ?? '',
            ];
        }
        
        // 3. Sauvegarder la consultation après avoir validé les données des médicaments
        $consultation->save();
        
        // 4. Sauvegarder les relations dans la table pivot (ordonnances)
        $consultation->medicaments()->attach($medicaments);

        HistoriqueMedical::create( [
            "patient_id"=>$validatedData["patient_id"],
               "maladie"=>$validatedData["raison"],
               "type"=>"Personnelle",
               "category"=>"Médicale",
               "date"=>now(),
       ]);

        // Utiliser Inertia pour rediriger avec un message de succès
        return redirect()->route('consultations.index')->with('success', 'Consultation et médicaments enregistrés avec succès !');
    }
}
