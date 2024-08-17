<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Medecin;
use App\Models\Specialite;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class MedecinController extends Controller
{
    //Afficher la liste de tote les médecin
    public function index()
    {
        $doctors = Medecin::with("specialite")->get();

        return Inertia::render(
            'Doctor/index',
            ["doctors" => $doctors]
        );
    }

    //Afficher ke formulaire de création d'un docteur
    public function insert()
    {
        $specialites = Specialite::All();

        return Inertia::render('Doctor/form', ["specialites" => $specialites]);
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

        $validated = $request->validate([
            'email' => ['required', 'max:255', 'string', 'email', 'unique:users'],

        ]);



        $validated['password'] = Hash::make("password123");
        $validated['role'] = "Medecin";


        $user = User::create($validated);
        // Valider et créer l'utilisateur
        $validated2 = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:medecins'],
            'phone' => ['required', 'string', 'max:10', 'unique:medecins'],
            'address' => ['string', 'max:255'],
            'specialite_id' => ['integer', 'exists:specialites,id'],
        ]);



        $validated2['user_id'] = $user->id;

        $validated2['photos'] = "//storage/" . $path;


        Medecin::create($validated2);

        return redirect()->route('doctor.create')->with('message', 'Médecin créé avec succès');
    }

    //Supprimer un Docteur
    public function destroy(String $id)
    {
        $doctor = Medecin::findOrFail($id);

        $doctor->delete();

        return redirect()->route('doctor.create')->with('message', 'Médecin créé avec succès');
    }

    /**
     * Afficher le formulaire de modification de docteur
     *
     * @param String $id
     * @return void
     */
    public function edit(Request $req,String $id)
    {
        $specialites = Specialite::All();

        $doctor = Medecin::with("user")->find($id);

        return Inertia::render('Doctor/edit', ["specialites" => $specialites, "doctor" => $doctor]);
    }

    public function update(Request $request)
    {
        $validated2 = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('medecins')->ignore($request["id"])],
            'phone' => ['required', 'string', 'max:20', Rule::unique('medecins')->ignore($request["id"])],
            'address' => ['string', 'max:255'],
            'specialite_id' => ['integer', 'exists:specialites,id'],
        ]);
        $doctor = Medecin::with("user")->find($request["id"]);
        $user = User::find($doctor["user_id"]);

        $validated = $request->validate([
            'email' => ['required', 'max:255', 'string', 'email', Rule::unique('users')->ignore($user["id"])],

        ]);

        $doctor->name = $request["name"];
        $doctor->phone = $request["phone"];
        $doctor->address = $request["address"];
        $doctor->specialite_id = $request["specialite_id"];
        $user->email = $request["email"];
        $user->save();
        $doctor->save();
    }
}
