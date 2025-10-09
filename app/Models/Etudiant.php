<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


use App\Models\User;
use App\Models\Tuteur;
use App\Models\Inscription;

class Etudiant extends Model
{
    protected $table = 'etudiants';

    protected $fillable = ['user_id', 'matricule', 'date_naissance', 'lieu_naissance', 'genre'];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tuteurs()
    {
        return $this->belongsToMany(Tuteur::class, 'etudiant_tuteur', 'etudiant_id', 'tuteur_id');
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'etudiant_id');
    }

}
