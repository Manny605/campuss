<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FiliereNiveau extends Model
{
    protected $table = 'filiere_niveau';

    protected $fillable = [
        'filiere_id',
        'niveau_id',
    ];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }
}
