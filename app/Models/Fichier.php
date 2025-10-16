<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fichier extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_fichier_id',
        'fichier',
        'inactif_id'
    ];

    public function type_fichier()
    {
        return $this->belongsTo(TypeFichier::class);
    }

    public function inactif()
    {
        return $this->belongsTo(Inactif::class);
    }
}
