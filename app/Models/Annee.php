<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Semestre;
use App\Models\Classe;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Annee extends Model
{
    protected $table = 'annees';

    protected $fillable = [
        'libelle',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function classes(): HasMany
    {
        return $this->hasMany(Classe::class);
    }

    public function semestres(): HasMany
    {
        return $this->hasMany(Semestre::class);
    }
}
