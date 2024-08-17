<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index() {
        return inertia("index",["coucou"]);
    }

    public function test() {
        return view("layouts.test");
    }

}
