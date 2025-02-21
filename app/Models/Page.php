<?php
// Page Model
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'content', 'text_block_title', 'text_block_content', 'is_home', 'name'
    ];
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    // Add the relationship method to associate with sliders
    public function sliders()
    {
        return $this->hasMany(Slider::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

}
