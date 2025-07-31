<?php

namespace App\Http\Controllers;

use App\Models\ArticleModal;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $articles = ArticleModal::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->paginate(10);
        return view('blog', compact('articles'));
    }

    public function show(ArticleModal $article)
    {
        if (!$article->published_at || $article->published_at > now()) {
            abort(404);
        }
        return view('blog_show', compact('article'));
    }
} 