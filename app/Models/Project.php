<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'location',
        'description',
        'main_image',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order', 'asc');
    }

    public function beforeImage()
    {
        return $this->images()->where('image_type', 'before')->first();
    }

    public function processImage()
    {
        return $this->images()->where('image_type', 'process')->first();
    }

    public function afterImage()
    {
        return $this->images()->where('image_type', 'after')->first();
    }
}
