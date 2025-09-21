<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Inscription;

class Bulletin extends Model
{
    protected $table = 'bulletins';

    protected $fillable = [
        'inscription_id', 'periode_id',
        'moyenne_generale', 'rang', 'appreciation', 'date_generation'
    ];

    public function inscription()
    {
        return $this->belongsTo(Inscription::class, 'inscription_id');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id');
    }
}
