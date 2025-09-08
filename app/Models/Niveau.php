<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classe;
use App\Models\Filiere_Niveau;

class Niveau extends Model
{
    protected $fillable = ['nom'];

    public function classes()
    {
        return $this->hasMany(Classe::class, 'filiere_niveau_id', 'id');
    }

    public function filiereNiveaux()
    {
        return $this->hasMany(Filiere_Niveau::class, 'niveau_id', 'id');
    }
}
