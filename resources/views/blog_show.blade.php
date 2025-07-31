@extends('components.main')
@section('content')
<div class="container">
    <article class="blog-article">
        <header class="blog-article__header">
            <h1 class="blog-article__title">{{ $article->title }}</h1>
            <div class="blog-article__meta">
                <time datetime="{{ $article->published_at->format('Y-m-d') }}">
                    {{ $article->published_at->format('d.m.Y') }}
                </time>
            </div>
        </header>

        <div class="blog-article__content">
            {!! nl2br(e($article->content)) !!}
        </div>

        <footer class="blog-article__footer">
            <a href="{{ route('blog') }}" class="blog-article__back">
                ← Назад к блогу
            </a>
        </footer>
    </article>
</div>

<style>
.blog-article {
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem 0;
}

.blog-article__header {
    margin-bottom: 2rem;
    text-align: center;
}

.blog-article__title {
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.blog-article__meta {
    color: #666;
    font-size: 1rem;
}

.blog-article__content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #333;
    margin-bottom: 3rem;
}

.blog-article__content p {
    margin-bottom: 1.5rem;
}

.blog-article__footer {
    border-top: 1px solid #eee;
    padding-top: 2rem;
    text-align: center;
}

.blog-article__back {
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.blog-article__back:hover {
    color: #0056b3;
}

@media (max-width: 768px) {
    .blog-article {
        padding: 1rem;
    }
    
    .blog-article__title {
        font-size: 2rem;
    }
    
    .blog-article__content {
        font-size: 1rem;
    }
}
</style>
@endsection 