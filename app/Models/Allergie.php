<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Allergie extends Model
{
    use HasFactory;

    public $fillable=["patient_id" ,
                "name" ,
                "description"];

    public function patient() : BelongsTo {
            return $this->belongsTo(Patient::class);
    }
}
