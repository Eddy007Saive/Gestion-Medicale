<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoriqueMedical extends Model
{
    use HasFactory;

    protected $fillable = [
         "patient_id",
            "maladie",
            "type",
            "category",
            "date",
            "medications",
            "hereditary",
            "encours_traitement"

    ];

    public function patient() : BelongsTo {
        return $this->belongsTo(Patient::class);
    }
}
