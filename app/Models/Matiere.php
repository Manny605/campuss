<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Filiere;
use App\Models\Enseignant;
use App\Models\Matiere_Enseignant;

class Matiere extends Model
{
    protected $fillable = [
        'code', 
        'nom', 
    ];

    public function filieres()
    {
        return $this->belongsToMany(Filiere::class, 'filiere_matiere')
                    ->withTimestamps();
    }

    public function enseignants()
    {
        return $this->belongsToMany(Enseignant::class, 'matiere_enseignant')
                    ->using(Matiere_Enseignant::class)
                    ->withPivot('semestre_id')
                    ->withTimestamps();
    }    

}
