<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auteur extends Model
{
    use HasFactory;

    protected $fillable = [
        'noms',
        'biographie',
    ];

    public function ouvrages()
    {
        return $this->hasMany(Ouvrage::class);
    }
}
