@extends('components.main')
@section('content')
<div class="post">
    <h1 class="post__header">Новости, акции, статьи</h1>
    <div class="container">
        @foreach($posts as $post)
            <div class="post__card">
                <div class="post__card-content">
                    <div class="post__card-img">
                        <img class="post__img" src="{{ $post->img_path }}" alt="{{ $post->title }}">
                    </div>
                    <div class="post__text-container">
                        <h2 class="post__card-title">{{ $post->title }}</h2>
                        <div class="post-card-text">{{ $post->content }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
.post {
    max-width: 1240px;
    margin: 0 auto;
    padding: 40px 20px;
}

.post__header {
    font-weight: 700;
    font-size: 36px;
    text-align: center;
    margin-bottom: 60px;
    color: #333;
}

.container {
    display: flex;
    flex-direction: column;
    gap: 40px;
}

.post__card {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    gap: 30px;
    border: 1px solid #e0e0e0;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    transition: box-shadow 0.3s ease;
}

.post__card:hover {
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
}

.post__card-img {
    flex: 1 1 300px;
    max-width: 500px;
    overflow: hidden;
    border-radius: 12px;
}

.post__img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
    border-radius: 12px;
}

.post__text-container {
    flex: 1 1 300px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    color: #444;
}

.post__card-title {
    font-size: 24px;
    margin-bottom: 15px;
    color: #c8185b;
}

.post-card-text {
    font-size: 16px;
    line-height: 1.6;
}

/* Адаптивность */
@media (max-width: 768px) {
    .post__card {
        flex-direction: column;
        padding: 20px;
    }

    .post__card-title {
        font-size: 20px;
    }

    .post-card-text {
        font-size: 15px;
    }
}
</style>


@endsection