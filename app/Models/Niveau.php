<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classe;
use App\Models\Filiere;

class Niveau extends Model
{
    protected $table = 'niveaux';

    protected $fillable = ['nom'];

    public function classes()
    {
        return $this->hasMany(Classe::class, 'niveau_id');
    }

    public function filieres()
    {
        return $this->belongsToMany(Filiere::class, 'filiere_niveau', 'niveau_id', 'filiere_id')->withTimestamps();
    }
}
