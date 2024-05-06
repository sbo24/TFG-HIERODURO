<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivateVehicle extends Model
{
    protected $table = 'private_vehicles';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function detail()
    {
        return $this->belongsTo(Detalle::class, 'details_id');
    }
}
