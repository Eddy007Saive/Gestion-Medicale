<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicamentsConsultations extends Model
{
    use HasFactory;
    protected $table = 'medicaments_consultations';

    protected $fillable = [
        'medicament_id',
        'consultation_id',
        'qt',
    ];
    
}
