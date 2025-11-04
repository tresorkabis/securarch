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
        'status',
        'anneeengagement',
        'grade_id',
        'fonction_id',
        'province_id',
        'direction_id',
    ];

    public function rapports()
    {
        return $this->hasMany(Rapport::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function fonction()
    {
        return $this->belongsTo(Fonction::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }
}
