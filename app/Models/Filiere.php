<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Classe;
use App\Models\Matiere;
use App\Models\Niveau;

class Filiere extends Model
{
    protected $fillable = [
        'code', 
        'nom'
    ];


    public function classes(): HasMany
    {
        return $this->hasMany(Classe::class);
    }

    public function matieres() : BelongsToMany
    {
        return $this->belongsToMany(Matiere::class, 'filiere_matiere', 'filiere_id', 'matiere_id');
    }

    public function niveaux(): BelongsToMany
    {
        return $this->hasMany(Niveau::class, 'filiere_niveau')->withTimestamps();
    }
    
}
