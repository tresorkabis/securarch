<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeFichier extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom'
    ];

    public function fichiers()
    {
        return $this->hasMany(Fichier::class);
    }
}
