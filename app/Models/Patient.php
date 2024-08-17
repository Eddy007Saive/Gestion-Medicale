<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'matricule',
        'nom_pere',
        'nom_mere',
        'prenom',
        'adresse',
        'photos',
        'dateN',
        'telephone',
        'prfs',
        'email',
        'genre',
        'num_securite_sociale',
        'groupe_sanguin',
        'contact_urgence_nom',
        'contact_urgence_telephone'
    ];

    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class);
    }

    public function allergies(): HasMany
    {
        return $this->hasMany(Allergie::class);
    }

    public function historique_medical(): HasMany
    {
        return $this->hasMany(HistoriqueMedical::class);
    }

    public function habitudes(): HasMany
    {
        return $this->hasMany(Habitude::class);
    }
}
