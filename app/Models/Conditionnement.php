<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Conditionnement extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicament_id',
        'unite',
        'prix',
        'quantite',
    ];

    /**
     * Relation pour obtenir toute les medicament d'une constion 
     *
     * @return BelongsTo
     */
    public function medicament():BelongsTo
    {
        return $this->belongsTo(Medicament::class);
    }
}
