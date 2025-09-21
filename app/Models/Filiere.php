<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Classe;
use App\Models\Niveau;


class Filiere extends Model
{
    protected $table = 'filieres';

    protected $fillable = ['code', 'nom'];

    public function classes()
    {
        return $this->hasMany(Classe::class, 'filiere_id');
    }   

    public function niveaux()
    {
        return $this->belongsToMany(Niveau::class, 'filiere_niveau', 'filiere_id', 'niveau_id')->withTimestamps();
    }

    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'filiere_matiere', 'filiere_id', 'matiere_id')->withTimestamps();
    }
}
