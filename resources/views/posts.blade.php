@extends('components.main')
@section('title', 'Новости, акции, статьи')
@section('content')
<section class="post">
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
</section>
@endsection