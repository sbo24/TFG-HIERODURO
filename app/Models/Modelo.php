<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function motorizaciones()
    {
        return $this->hasMany(Motorizaciones::class);
    }
}
