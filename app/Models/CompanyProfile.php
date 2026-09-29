<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tagline',
        'subtagline',
        'description',
        'vision',
        'mission',
        'about_image',
        'hero_image',
    ];

    protected $casts = [
        'mission' => 'array',
    ];
}
