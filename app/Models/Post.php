<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'excerpt',
        'img_path',
        'is_published',
        'published_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($posts) {
            if ($posts->image) {
                $imagePath = str_replace('/storage/', '', $posts->image);
                \Illuminate\Support\Facades\Storage::disk('public')->delete($imagePath);
            }
        });
    }
}
