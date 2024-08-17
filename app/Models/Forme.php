<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forme extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    public function medicaments()
    {
        return $this->belongsToMany(Medicament::class,'formes_medicaments');
    }
}
