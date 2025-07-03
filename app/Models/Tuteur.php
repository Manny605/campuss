<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\User;
use App\Models\Etudiant;
use App\Models\Etudiant_Tuteur;


class Tuteur extends Model
{
    protected $fillable = [
        'user_id',
        'prenom',
        'nom',
        'telephone',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function etudiants(): BelongsToMany
    {
        return $this->belongsToMany(Etudiant::class, 'etudiant_tuteur')
                    ->using(Etudiant_Tuteur::class)
                    ->withTimestamps();
    }
    

}
