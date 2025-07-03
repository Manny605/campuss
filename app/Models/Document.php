<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Enseignant;
use App\Models\Matiere;
use App\Models\Fichier;

class Document extends Model
{
    protected $fillable = [
        'enseignant_id',
        'matiere_id',
        'titre',
        'fichier_id',
    ];

    /**
     * Get the enseignant that owns the Document
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enseignant(): BelongsTo
    {
        return $this->belongsTo(Enseignant::class);
    }
    /**
     * Get the matiere that owns the Document
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function matiere(): BelongsTo
    {
        return $this->belongsTo(Matiere::class);
    }
    /**
     * Get the fichier that owns the Document
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fichier(): BelongsTo
    {
        return $this->belongsTo(Fichier::class);
    }
}
