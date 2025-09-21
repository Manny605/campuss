<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bulletin;

class Periode extends Model
{
    protected $fillable = [
        'nom', 
    ];

    public function bulletins(): BelongsTo
    {
        return $this->hasMany(Bulletin::class, 'periode_id');
    }

    public function matieres()
    {
        return $this->hasMany(Matiere::class, 'periode_id');
    }

}
