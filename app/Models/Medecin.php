<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medecin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'matricule',
        'phone',
        'address',
        'specialite_id',
        'user_id',
        'photos'
    ];

    public static function boot()  {
        parent::boot();
        static::creating(function ($doctor) {
            $doctor->matricule=self::getUniqueMatricule();
        });
    }

    public static function getUniqueMatricule()  {
        do {
            $matricule="DOC-".Str::upper(Str::random(8));
        } while (self::where("matricule",$matricule)->exists());
        return $matricule;
    }


    public function telephones(): HasMany
    {
        return $this->hasMany(Telephone::class);
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function consultations(): HasMany
    {
        return $this->hasMany(Consultation::class);
    }

    public function specialite(): BelongsTo
    {
        return $this->belongsTo(Specialite::class);
    }
}
