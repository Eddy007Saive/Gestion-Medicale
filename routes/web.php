<?php

use App\Http\Controllers\AllergieController;
use App\Http\Controllers\HabitudeController;
use App\Http\Controllers\HistoriqueMedicalController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Models\Habitude;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/doctor', [MedecinController::class, 'index'])->name('doctor.all');
    Route::get('/doctor/create', [MedecinController::class, 'insert'])->name('doctor.create');
    Route::post('/doctor/insert', [MedecinController::class, 'create'])->name('doctor.insert');
    Route::delete('/doctor/delete/{id}', [MedecinController::class, 'destroy'])->name('doctor.delete');
    Route::get('/doctor/edit/{id}', [MedecinController::class, 'edit'])->name('doctor.edit');
    Route::post('/doctor/update', [MedecinController::class, 'update'])->name('doctor.update');

    Route::prefix("/medicament")->group(function () {
        Route::get('/', [MedicamentController::class, 'index'])->name('medicament.all');
        Route::get('/create', [MedicamentController::class, 'insert'])->name('medicament.create');
        Route::post('/insert', [MedicamentController::class, 'create'])->name('medicament.insert');
        Route::delete('/delete/{id}', [MedicamentController::class, 'destroy'])->name('medicament.delete');
        Route::get('/edit/{id}', [MedicamentController::class, 'edit'])->name('medicament.edit');
        Route::post('/update', [MedicamentController::class, 'update'])->name('medicament.update');
    });

    //Lizn patient
    Route::prefix("/patients")->group(function () {
        Route::get('/', [PatientController::class, 'index'])->name('patient.all');
        Route::get('/create', [PatientController::class, 'insert'])->name('patient.create');
        Route::post('/insert', [PatientController::class, 'create'])->name('patient.insert');
        Route::delete('/delete/{id}', [PatientController::class, 'destroy'])->name('patient.delete');
        Route::get('/edit/', [PatientController::class, 'edit'])->name('patient.edit');
        Route::post('/update', [PatientController::class, 'update'])->name('patient.update');
        Route::get('/show/{matricule}', [PatientController::class, 'show'])->name('patient.show');
    });

    //Line Allergie
    Route::prefix("/allergie")->group(function () {
        Route::get('/', [AllergieController::class, 'index'])->name('allergie.all');
        Route::get('/create', [AllergieController::class, 'insert'])->name('allergie.create');
        Route::post('/insert', [AllergieController::class, 'store'])->name('allergie.insert');
        Route::get('/delete', [AllergieController::class, 'delete'])->name('allergie.delete');
        Route::get('/edit/{id}', [AllergieController::class, 'edit'])->name('allergie.edit');
        Route::post('/update', [AllergieController::class, 'update'])->name('allergie.update');
        Route::get('/show/{matricule}', [AllergieController::class, 'show'])->name('allergie.show');
    });

    // Lient Historique
    Route::prefix("/historique")->group(function () {
        Route::get('/', [HistoriqueMedicalController::class, 'index'])->name('historique.all');
        Route::get('/create', [HistoriqueMedicalController::class, 'insert'])->name('historique.create');
        Route::post('/insert', [HistoriqueMedicalController::class, 'store'])->name('historique.insert');
        Route::get('/delete/', [HistoriqueMedicalController::class, 'delete'])->name('historique.delete');
        Route::get('/edit/{id}', [HistoriqueMedicalController::class, 'edit'])->name('historique.edit');
        Route::post('/update', [HistoriqueMedicalController::class, 'update'])->name('historique.update');
        Route::get('/show/{matricule}', [HistoriqueMedicalController::class, 'show'])->name('historique.show');
    });

    // Lient Historique
    Route::prefix("/habitude")->group(function () {
        Route::get('/', [HabitudeController::class, 'index'])->name('habitude.all');
        Route::get('/create', [HabitudeController::class, 'insert'])->name('habitude.create');
        Route::post('/insert', [HabitudeController::class, 'store'])->name('habitude.insert');
        Route::get('/delete', [HabitudeController::class, 'delete'])->name('habitude.delete');
        Route::get('/edit/{id}', [HabitudeController::class, 'edit'])->name('habitude.edit');
        Route::post('/update', [HabitudeController::class, 'update'])->name('habitude.update');
        Route::get('/show/{matricule}', [HabitudeController::class, 'show'])->name('habitude.show');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
