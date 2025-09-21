<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Inscription;

class Note extends Model
{
    protected $table = 'notes';

    protected $fillable = [
        'inscription_id', 'devoir_id', 'examen_id',
        'note', 'commentaire', 'corrige_par'
    ];

    public function inscription()
    {
        return $this->belongsTo(Inscription::class, 'inscription_id');
    }
}
