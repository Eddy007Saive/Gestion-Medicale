<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Medicament extends Model
{
    use HasFactory;

    protected $fillable = [
        'photos',
        'stock',
        'dosage',
        'ingredient',
        'nom',
        'forme_id',
        'prix',
        'date_peremption',
        'description',
        'fabricant',
        'date_fabrication',
        'type_medicament',
    ];

    /**
     * Rekation qui presente la forme du medicament 
     *
     * @return BelongsTo
     */
    public function formes():BelongsToMany
    {
        return $this->belongsToMany(Forme::class,'formes_medicaments');
    }

    //Relation pour prendre les condition selon l'unité du medicament 
    public function conditionnements()
    {
        return $this->hasMany(Conditionnement::class);
    }

    /**
     * Relation avec la table consultation pour avoir totes les consultation qui sont associer au medicament 
     *
     * @return BelongsToMany
     */
    public function consultations():BelongsToMany
    {
        return $this->belongsToMany(Consultation::class, 'medicaments_consultations')
            ->using(MedicamentsConsultations::class)
            ->withPivot('qt')
            ->withTimestamps();
    }
}
