<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Etudiant;

class Payment extends Model
{
    protected $fillable = [
        'etudiant_id',
        'montant',
        'due_date',
        'paid_date',
        'status',
    ];

    /**
     * Get the etudiant that owns the Payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function etudiant(): BelongsTo
    {
        return $this->belongsTo(Etudiant::class);
    }
}
