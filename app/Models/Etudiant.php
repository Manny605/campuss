<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Classe;
use App\Models\Tuteur;
use App\Models\Etudiant_Tuteur;

class Etudiant extends Model
{
    protected $fillable = [
        'user_id',
        'prenom',
        'nom',
        'telephone',
        'date_naissance',
        'classe_id',
    ];

    protected $casts = [
        'date_naissance' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }

    public function tuteurs()
    {
        return $this->belongsToMany(Tuteur::class, 'etudiant_tuteur')
                    ->using(Etudiant_Tuteur::class)
                    ->withTimestamps();
    }

}
