<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;
    protected $fillable = [
        'matricule',
        'nom',
        'postnom',
        'prenom',
        'sexe',
        'fonction',
        'email',
        'telephone',
    ];

    public function rapports()
    {
        return $this->hasMany(Rapport::class);
    }
}
