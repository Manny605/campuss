<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Filiere;
use App\Models\Niveau;
use App\Models\Classe;

class Filiere_Niveau extends Model
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

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
    
}
