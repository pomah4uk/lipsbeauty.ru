<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleModal extends Model
{
    use HasFactory;

    protected $table = 'news';
    
    protected $fillable = [
        'title',
        'content',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'date'
    ];
}
