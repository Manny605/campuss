<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Model;
use App\Models\Matiere;
use App\Models\Filiere;

class Filiere_Matiere extends Model
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
