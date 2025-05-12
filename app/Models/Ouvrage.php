<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ouvrage extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'auteur_id',
        'domaine_id',
        'isbn',
        'editeur',
        'date_publication',
        'nombre_pages',
        'langue',
        'format_fichier',
        'taille_fichier',
        'chemin_fichier'
    ];

    protected $casts = [
        'date_publication' => 'date',
    ];

    public function auteur()
    {
        return $this->belongsTo(Auteur::class);
    }

    public function domaine()
    {
        return $this->belongsTo(Domaine::class);
    }
}
