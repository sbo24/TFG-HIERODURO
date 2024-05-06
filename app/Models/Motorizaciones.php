<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motorizaciones extends Model
{
    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }
}
