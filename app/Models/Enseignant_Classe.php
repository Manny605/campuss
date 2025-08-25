<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enseignant_Filiere extends Model
{
    protected $table = 'enseignant_classe';

    protected $fillable = [
        'enseignant_id',
        'classe_id',
    ];

    public function enseignant()
    {
        return $this->belongsTo(Enseignant::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
}
