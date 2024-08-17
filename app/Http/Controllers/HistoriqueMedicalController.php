<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\HistoriqueMedical;

class HistoriqueMedicalController extends Controller
{
    public function store(Request $request)
    {

        // Validation des données
        $validateData = $request->validate([
            'maladie' => 'required|string|max:255',
            'date' => 'required|date|before_or_equal:today',
            'description' => 'nullable|string|max:500',
            'encours_traitement' => 'required|boolean',
            'type' => 'nullable|in:Familiale,Personnelle',
            'category' => 'nullable|in:Médicale,chirurgicale,Ginéco-Opstétrique',
            'hereditary' => 'required|boolean',
            'medications' => 'nullable|string|max:500',
            'patient_id' => 'required|integer'

        ]);

        $historique = HistoriqueMedical::create($validateData);

        $patient = Patient::find($historique->patient_id)->with("allergies", "historique_medical")->first();

        return Inertia::render('Patients/show', ["patient" => $patient]);
    }


    public function delete(Request $request)
    {
        $historique = HistoriqueMedical::find($request["id"]);

        $historique->delete();

        return redirect()->back();

    }
}
