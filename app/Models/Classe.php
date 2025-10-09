<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Annee;
use App\Models\Niveau;
use App\Models\Filiere;
use App\Models\Matiere;


class Classe extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'annee_id', 
        'filiere_niveau_id',
        'nom', 
        'capacite'
    ];

    public function filiereNiveau()
    {
        return $this->belongsTo(FiliereNiveau::class, 'filiere_niveau_id');
    }

    public function anneeAcademique()
    {
        return $this->belongsTo(Annee::class, 'annee_id');
    }

    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'classes_matieres')->withPivot(['enseignant_id', 'heures_hebdo']);
    }

}
