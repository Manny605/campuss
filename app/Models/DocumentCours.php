<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentCours extends Model
{
    protected $table = 'documents_cours';

    protected $fillable = [
        'classe_matiere_id', 'titre', 'description',
        'type', 'fichier_path', 'lien_url', 'enseignant_id'
    ];
}