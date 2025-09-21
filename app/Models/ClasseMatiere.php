<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classe;
use App\Models\Matiere;
use App\Models\User;

class ClasseMatiere extends Model
{
    protected $table = 'classes_matieres';

    protected $fillable = ['classe_id', 'matiere_id', 'enseignant_id', 'heures_hebdo'];

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class, 'matiere_id');
    }

    public function enseignant()
    {
        return $this->belongsTo(User::class, 'enseignant_id');
    }
}
