<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Etudiant;
use App\Models\Semestre;
use App\Models\Fichier;

class Report extends Model
{
    protected $fillable = [
        'etudiant_id',
        'semestre_id',
        'fichier_id',
        'genere_le',
    ];

    

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function fichier()
    {
        return $this->belongsTo(Fichier::class);
    }
}
