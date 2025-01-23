<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consultation extends Model
{
    use HasFactory;

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }


    public function medecin(): BelongsTo
    {
        return $this->belongsTo(Medecin::class);
    }

    public function medicaments()
    {
        return $this->belongsToMany(Medicament::class, 'ordonnances')
            ->using(Ordonnance::class) 
            ->withPivot('dosage', 'voieAdministration', 'frequence', 'duree', 'instruction') // Mentionner toutes les colonnes supplémentaires
            ->withTimestamps(); 
    }
}
