<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Matiere;
use App\Models\User;
use App\Models\Enseignant_Matiere;

class Enseignant extends Model
{
    protected $fillable = [
        'user_id',
        'prenom',
        'nom',
        'telephone',
        'date_embauche',
        'specialite',
        'grade',
        'classe_id',
    ];

    protected $casts = [
        'date_embauche' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

     public function classe()
    {
        return $this->belongsTo(Classe::class);
    } 

    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'matiere_enseignant')->withTimestamps();
    }

    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'enseignant_classe')->withTimestamps();
    }
}
