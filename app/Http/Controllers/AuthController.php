<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $req)
    {
        // $user=new User();
        // $user->email="Eddy";
        // $user->password=Hash::make("eddy");
        // $user->save();



       
        // die();

        $credentials= $req->validate([
            "email"=>"required",
            "password"=>"required"
        ]);
        dump($credentials);

        if(Auth::attempt($credentials)){
            echo "Okey";
        }else{
            echo 'no';
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
