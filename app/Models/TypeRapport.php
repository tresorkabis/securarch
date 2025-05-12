<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeRapport extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    public function rapports()
    {
        return $this->hasMany(Rapport::class);
    }
}
