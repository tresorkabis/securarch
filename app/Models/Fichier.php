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

    public function typefichier()
    {
        return $this->belongsTo(TypeFichier::class);
    }

    public function fichier()
    {
        return $this->belongsTo(Fichier::class);
    }
}
