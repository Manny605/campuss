<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Etudiant;


class Tuteur extends Model
{
    protected $table = 'tuteurs';

    protected $fillable = ['user_id', 'relation'];

    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class, 'etudiants_parents', 'tuteur_id', 'etudiant_id');
    }
}
