<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_photo',
        'original_name',
        'path',
        'description',
        'uploaded_by',
    ];

    // Если есть модель User, добавить связь
    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
