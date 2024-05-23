<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentValue extends Model
{
    use HasFactory;

    protected $fillable = ['content_key_id', 'language', 'value'];

    public function contentKey()
    {
        return $this->belongsTo(ContentKey::class);
    }
}
