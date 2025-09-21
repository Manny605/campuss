<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Etudiant;
use App\Models\Classe;
use App\Models\Annee;

class Inscription extends Model
{
    protected $table = 'inscriptions';

    protected $fillable = [
        'etudiant_id', 'classe_id', 'annee_id',
        'statut', 'date_inscription'
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'etudiant_id');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

    public function anneeAcademique()
    {
        return $this->belongsTo(Annee::class, 'annee_id');
    }
}
