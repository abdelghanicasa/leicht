<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloc extends Model {
    use HasFactory;

    protected $fillable = ['title', 'text', 'images', 'url', 'url_text', 'bloc_type'];

    protected $casts = [
        'images' => 'array',
    ];
}
