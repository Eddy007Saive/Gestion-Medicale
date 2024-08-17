<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Telephone extends Model
{
    use HasFactory;
    
    //Un teephone appartient a une patient
    public function patient() : BelongsTo {
        return $this->belongsTo(Patient::class);
    }

    //Une telephone appartient a un medecin
    public function medecin() : BelongsTo {
        return $this->belongsTo(Medecin::class);
    }
}
