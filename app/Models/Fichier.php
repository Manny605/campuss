<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fichier extends Model
{
    protected $fillable = [
        'type',
        'chemin'
    ];

}
