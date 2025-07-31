@extends('components.main')
@section('content')
<div class="container">
    <div class="blog-header">
        <h1>Блог</h1>
        <p>Полезные статьи о красоте и уходе за собой</p>
    </div>

    <div class="blog-grid">
        @foreach($articles as $article)
            <article class="blog-card">
                <a href="{{ route('blog.show', $article) }}" class="blog-card__link-wrapper">
                    <div class="blog-card__content">
                        <h2 class="blog-card__title">
                            {{ $article->title }}
                        </h2>
                        <div class="blog-card__meta">
                            <time datetime="{{ $article->published_at->format('Y-m-d') }}">
                                {{ $article->published_at->format('d.m.Y') }}
                            </time>
                        </div>
                        <div class="blog-card__excerpt">
                            {{ Str::limit(strip_tags($article->content), 200) }}
                        </div>
                        <div class="blog-card__read-more">
                            Читать далее →
                        </div>
                    </div>
                </a>
            </article>
        @endforeach
    </div>

    @if($articles->hasPages())
        <div class="pagination-wrapper">
            {{ $articles->links() }}
        </div>
    @endif
</div>

<style>
.blog-header {
    text-align: center;
    margin-bottom: 3rem;
    padding: 2rem 0;
}

.blog-header h1 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    color: #333;
}

.blog-header p {
    font-size: 1.1rem;
    color: #666;
}

.blog-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
    margin-bottom: 3rem;
}

.blog-card {
    background: #fff;
    border-radius: 10px;
    margin: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.blog-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}

.blog-card__link-wrapper {
    display: block;
    text-decoration: none;
    color: inherit;
    height: 100%;
}

.blog-card__link-wrapper:hover {
    text-decoration: none;
    color: inherit;
}

.blog-card__content {
    padding: 1.5rem;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.blog-card__title {
    font-size: 1.3rem;
    margin-bottom: 0.5rem;
    color: #333;
    transition: color 0.3s ease;
}

.blog-card:hover .blog-card__title {
    color: #007bff;
}

.blog-card__meta {
    margin-bottom: 1rem;
}

.blog-card__meta time {
    color: #666;
    font-size: 0.9rem;
}

.blog-card__excerpt {
    color: #555;
    line-height: 1.6;
    margin-bottom: 1rem;
    flex-grow: 1;
}

.blog-card__read-more {
    color: #007bff;
    font-weight: 500;
    transition: color 0.3s ease;
    margin-top: auto;
}

.blog-card:hover .blog-card__read-more {
    color: #0056b3;
}

.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}

@media (max-width: 768px) {
    .blog-grid {
        grid-template-columns: 1fr;
    }
    
    .blog-header h1 {
        font-size: 2rem;
    }
}
</style>
@endsection 