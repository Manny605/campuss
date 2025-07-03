<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;
use App\Models\Matiere;
use App\Models\Enseignant;
use App\Models\Semestre;

class Matiere_Enseignant extends Model
{
    protected $table = 'matiere_enseignant';

    protected $fillable = [
        'matiere_id',
        'enseignant_id',
        'semestre_id',
    ];

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }
}
