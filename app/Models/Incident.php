<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $table = 'incidents';

    protected $fillable = [
        'inscription_id', 'type', 'titre', 'description',
        'gravite', 'date_incident', 'enregistre_par', 'notifier_parent'
    ];

    public function inscription()
    {
        return $this->belongsTo(Inscription::class, 'inscription_id');
    }

    public function auteur()
    {
        return $this->belongsTo(User::class, 'enregistre_par');
    }
}
