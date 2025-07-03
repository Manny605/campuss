<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Matiere;
use App\Models\User;
use App\Models\Matiere_Enseignant;

class Enseignant extends Model
{
    protected $fillable = [
        'user_id',
        'prenom',
        'nom',
        'date_embauche',
    ];

    protected $casts = [
        'date_embauche' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'matiere_enseignant')
                    ->using(Matiere_Enseignant::class)
                    ->withPivot('semestre_id')
                    ->withTimestamps();
    }
}
