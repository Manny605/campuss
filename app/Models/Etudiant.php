<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Tuteur;
use App\Models\Inscription;

class Etudiant extends Model
{
    protected $table = 'etudiants';

    protected $fillable = ['id', 'matricule', 'date_naissance', 'lieu_naissance', 'genre'];

    public function tuteurs()
    {
        return $this->belongsToMany(Tuteur::class, 'etudiants_parents', 'etudiant_id', 'parent_id');
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'etudiant_id');
    }

}
