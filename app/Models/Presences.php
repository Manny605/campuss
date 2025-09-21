<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presences extends Model
{
    protected $table = 'presences';

    protected $fillable = [
        'inscription_id', 'classe_matiere_id',
        'date', 'statut', 'marque_par'
    ];

    public function inscription()
    {
        return $this->belongsTo(Inscription::class, 'inscription_id');
    }

    public function enseignant()
    {
        return $this->belongsTo(User::class, 'marque_par');
    }
}
