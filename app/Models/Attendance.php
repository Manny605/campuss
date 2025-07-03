<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Etudiant;
use App\Models\Matiere;
use App\Models\Semestre;

class Attendance extends Model
{
    protected $fillable = [
        'etudiant_id',
        'matiere_id',
        'semestre_id',
        'date',
        'status',
    ];

    /**
     * Get the etudiant that owns the Attendance
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function etudiant(): BelongsTo
    {
        return $this->belongsTo(Etudiant::class);
    }
    /**
     * Get the matiere that owns the Attendance
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function matiere(): BelongsTo
    {
        return $this->belongsTo(Matiere::class);
    }
    /**
     * Get the semestre that owns the Attendance
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function semestre(): BelongsTo
    {
        return $this->belongsTo(Semestre::class);
    }
}
