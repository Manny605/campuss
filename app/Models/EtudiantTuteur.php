<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EtudiantTuteur extends Model
{
    protected $table = 'etudiant_tuteur';

    protected $fillable = ['etudiant_id', 'tuteur_id'];
}
