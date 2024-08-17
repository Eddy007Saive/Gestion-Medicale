<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Patient;
use App\Models\Habitude;
use Illuminate\Http\Request;

class HabitudeController extends Controller
{
    public function store(Request $request)
    {

        // Validation des données
        $validateData = $request->validate([
            'nom' => 'required|string|max:255',
            'dateD' => 'nullable|date|before_or_equal:today',
            'dateF' => 'nullable|date|after_or_equal:habitudes.*.dateD',
            'patient_id' => 'required|integer'

        ]);

        $historique = Habitude::create($validateData);

        $patient = Patient::find($historique->patient_id)->with("allergies", "historique_medical")->first();
        return Inertia::render('Patients/show', ["patient" => $patient]);
    }

    public function delete(Request $request)
    {
        $habitude = Habitude::find($request["id"])->first();
        $habitude->delete();

        return redirect()->route('patient.create')->with('message', 'Patient ajouté');

    }
}
