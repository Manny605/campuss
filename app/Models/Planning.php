<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classe;
use App\Models\Matiere;
use App\Models\Enseignant;

class Planning extends Model
{
    protected $fillable = [
        'classe_id',
        'matiere_id',
        'enseignant_id',
        'jour_semaine',
        'heure_debut',
        'heure_fin',
        'salle',
    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }
    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }

}
