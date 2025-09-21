<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devoir extends Model
{
    protected $table = 'devoirs';

    protected $fillable = [
        'classe_matiere_id', 'titre', 'type',
        'date_devoir', 'note_max', 'enseignant_id'
    ];
}
