<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $table = 'details';
    protected $fillable = [
        'marca_id',
        'modelo_id',
        'version_id',
        'codigo_id',
        // Agrega aquí otros campos si es necesario
    ];

    // Relación con Marca
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    // Relación con Modelo
    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }

    // Relación con Motorizacion
    public function motorizacion()
    {
        return $this->belongsTo(Motorizaciones::class, 'version_id');
    }

    // Relación con CodigoModelo
    public function codigoModelo()
    {
        return $this->belongsTo(CodigoModelo::class, 'codigo_id');
    }
}
