<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Annee;
use App\Models\Matiere;

class Semestre extends Model
{
    protected $fillable = [
        'annee_id', 
        'code', 
    ];

    public function annee(): BelongsTo
    {
        return $this->belongsTo(Annee::class);
    }

    public function matieres()
    {
        return $this->hasMany(Matiere::class);
    }

    public function matieresEnseignees()
    {
        return $this->hasMany(Matiere_Enseignant::class);
    }

}
