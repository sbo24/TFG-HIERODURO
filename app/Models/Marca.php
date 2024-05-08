<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    public function modelos()
    {
        return $this->hasMany(Modelo::class);
    }

    public function motorizaciones()
    {
        return $this->hasManyThrough(Motorizaciones::class, Modelo::class);
    }
}
