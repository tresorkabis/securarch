<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decision extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'numero',
        'fichier',
        'observations',
    ];

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
