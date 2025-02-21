<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = ['image', 'title', 'description', 'url', 'page_id'];

    // Relationship with the Page model
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}

