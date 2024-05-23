<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentKey extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'section'];

    public function values()
    {
        return $this->hasMany(ContentValue::class, 'content_key_id');
    }
}
