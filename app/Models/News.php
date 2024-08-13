<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'author', 'tag', 'image', 'published', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getSomeDataAttribute()
    {
        $data = $this->attributes['some_data'] ?? [];
        return $data['key'] ?? 'default_value'; // Safely access 'key'
    }
}
