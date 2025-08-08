<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Filiere;
use App\Models\Enseignant;
use App\Models\Matiere_Enseignant;
use App\Models\Filiere_Matiere;

class Matiere extends Model
{
    protected $fillable = [
        'code', 
        'nom',
        'coefficient',
        'semestre_id',
    ];

    public function filieres()
    {
        return $this->belongsToMany(Filiere::class, 'filiere_matiere')->withTimestamps();
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class, 'semestre_id');
    }

    public function filiereMatieres()
    {
        return $this->hasMany(Filiere_Matiere::class, 'matiere_id', 'id');
    }

    public function enseignants()
    {
        return $this->belongsToMany(Enseignant::class, 'matiere_enseignant')->using(Matiere_Enseignant::class)->withPivot('semestre_id')->withTimestamps();
    }

}
