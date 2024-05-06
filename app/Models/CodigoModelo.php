<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodigoModelo extends Model
{
    protected $table = 'codigo_modelo';
    protected $fillable = [
        'codigo',
        // Agrega aquí otros campos si es necesario
    ];

    // Relación con Detalle
    public function detalles()
    {
        return $this->hasMany(Detalle::class);
    }
}
