<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    protected $table = 'examens';

    protected $fillable = [
        'classe_matiere_id', 'titre', 'type',
        'date_examen', 'note_max', 'ponderation', 'enseignant_id'
    ];
}
