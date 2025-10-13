<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Classe;

class Matiere extends Model
{
    protected $table = 'matieres';

    protected $fillable = ['code', 'nom', 'coefficient', 'periode_id'];

    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'classes_matieres')->withPivot(['enseignant_id', 'heures_hebdo']);
    }

    public function filieres()
    {
        return $this->belongsToMany(Filiere::class, 'filiere_matiere', 'matiere_id', 'filiere_id');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

}
