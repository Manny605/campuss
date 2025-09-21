<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Classe;

class Annee extends Model
{
    protected $table = 'annees';

    protected $fillable = ['code', 'date_debut', 'date_fin', 'active'];

    public function classes()
    {
        return $this->hasMany(Classe::class, 'annee_id');
    }
}
