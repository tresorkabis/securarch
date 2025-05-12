<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_rapport_id',
        'intitule',
        'debut_periode',
        'fin_periode',
        'date_rapport',
        'agent_id',
        'pays',
        'fichier',
    ];

    public function typeRapport()
    {
        return $this->belongsTo(TypeRapport::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
