<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'numero',
        'objet',
        'matricule',
        'grade',
        'observations',
        'decision_id',
        'agent_id',
        'fichier',
    ];

    public function decision()
    {
        return $this->belongsTo(Decision::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
