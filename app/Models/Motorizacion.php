<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motorizacion extends Model
{
    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }
}
