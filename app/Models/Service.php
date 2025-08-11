<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
        'is_active',
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($service) {
            if ($service->image) {
                $imagePath = str_replace('/storage/', '', $service->image);
                \Illuminate\Support\Facades\Storage::disk('public')->delete($imagePath);
            }
        });
    }
}
