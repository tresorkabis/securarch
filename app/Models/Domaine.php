<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
    ];

    public function ouvrages()
    {
        return $this->hasMany(Ouvrage::class);
    }
}
