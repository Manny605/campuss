<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FiliereMatiere extends Model
{
    protected $table = 'filiere_matiere';

    protected $fillable = [
        'filiere_id',
        'matiere_id',
    ];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }
}
