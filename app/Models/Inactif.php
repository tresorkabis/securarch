<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inactif extends Model
{
    use HasFactory;
    protected $fillable = [
        'matricule',
        'nom',
        'postnom',
        'prenom',
        'sexe',
        'fonction_id',
        'grade_id',
        'observation',
        'anneedeces',
        'province',
        'status'
    ];

    public function fonction()
    {
        return $this->belongsTo(Fonction::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function fichiers()
    {
        return $this->hasMany(Fichier::class);
    }
}
