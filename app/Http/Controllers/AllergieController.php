<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Patient;
use App\Models\Allergie;
use Illuminate\Http\Request;

class AllergieController extends Controller
{
    public function store(Request $request)
    {

        $validateData = $request->validate([
            '.name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'patient_id' => 'required|integer'
        ]);

        $allergie = Allergie::create($validateData);

        $patient = Patient::find($allergie->patient_id)->with("allergies", "historique_medical")->first();

        return Inertia::render('Patients/show', ["patient" => $patient]);
    }

    public function delete(Request $request)
    {
        $allergie = Allergie::find($request["id"])->first();
        $allergie->delete();
    }
}
