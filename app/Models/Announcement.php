<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classe;
use App\Models\Enseignant;

class Announcement extends Model
{
    protected $fillable = [
        'enseignant_id',
        'titre',
        'description',
        'classe_id',
    ];

    /**
     * Get the enseignant that owns the Announcement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enseignant(): BelongsTo
    {
        return $this->belongsTo(Enseignant::class);
    }
    /**
     * Get the classe that owns the Announcement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }
}
