<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Filiere_Niveau;
use App\Models\Etudiant;
use App\Models\Annee;

class Classe extends Model
{
    protected $fillable = ['filiere_niveau_id', 'annee_id'];

    public function filiereNiveau(): BelongsTo
    {
        return $this->belongsTo(Filiere_Niveau::class, 'filiere_niveau_id');
    }

    public function annee(): BelongsTo
    {
        return $this->belongsTo(Annee::class);
    }

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }

}
