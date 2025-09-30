<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Etudiant;
use App\Models\User;


class Tuteur extends Model
{
    protected $table = 'tuteurs';

    protected $fillable = ['user_id', 'relation'];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function etudiants()
    {
        return $this->belongsToMany(Etudiant::class, 'etudiant_tuteur', 'tuteur_id', 'etudiant_id');
    }
}
