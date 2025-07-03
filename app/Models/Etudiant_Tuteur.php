<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Etudiant_Tuteur extends Pivot
{
    protected $table = 'etudiant_tuteur';

    protected $fillable = [
        'etudiant_id',
        'tuteur_id',
    ];


    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function tuteur()
    {
        return $this->belongsTo(Tuteur::class);
    }
}
