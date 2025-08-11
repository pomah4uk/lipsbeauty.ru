@extends('components.admin-layout')

@section('page-title', 'Управление постами')

@section('header-actions')
    <a href="{{ route('crm.posts.create') }}" class="crm__btn crm__btn--primary">
        <i class="fa fa-plus"></i>
        Добавить пост
    </a>
@endsection

@section('content')
    @if(session('success'))
        <div class="crm__alert crm__alert--success">
            <i class="fa fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="crm__alert crm__alert--error">
            <i class="fa fa-exclamation-triangle"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="crm__stats">
        <div class="crm__stats-card">
            <div class="crm__stats-icon">
                <i class="fa fa-newspaper-o"></i>
            </div>
            <div class="crm__stats-content">
                <h3 class="crm__stats-number">{{ $posts->count() }}</h3>
                <p class="crm__stats-label">Всего постов</p>
            </div>
        </div>
        
        <div class="crm__stats-card">
            <div class="crm__stats-icon">
                <i class="fa fa-eye"></i>
            </div>
            <div class="crm__stats-content">
                <h3 class="crm__stats-number">{{ $posts->where('is_published', true)->count() }}</h3>
                <p class="crm__stats-label">Опубликованных</p>
            </div>
        </div>
    </div>

    @if($posts->count() > 0)
        <div class="crm__cards">
            @foreach($posts as $post)
                <div class="crm__card">
                    <div class="crm__card-header">
                        <h3 class="crm__card-title">
                            <i class="fa fa-file-text"></i>
                            {{ $post->title }}
                        </h3>
                        <div class="crm__card-actions">
                            <a href="{{ route('crm.posts.edit', $post->id) }}" 
                               class="crm__btn crm__btn--small crm__btn--secondary"
                               title="Редактировать">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('crm.posts.destroy', $post->id) }}" 
                                  method="POST" 
                                  style="display: inline;"
                                  onsubmit="return confirm('Вы уверены, что хотите удалить этот пост?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="crm__btn crm__btn--small crm__btn--danger"
                                        title="Удалить">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" 
                             alt="{{ $post->title }}" 
                             class="crm__card-image">
                    @endif
                    
                    <div class="crm__card-content">
                        @if($post->excerpt)
                            <div class="crm__card-field">
                                <span class="crm__card-label">Краткое описание:</span>
                                <span class="crm__card-value">{{ Str::limit($post->excerpt, 150) }}</span>
                            </div>
                        @endif
                        
                        @if($post->content)
                            <div class="crm__card-field">
                                <span class="crm__card-label">Содержание:</span>
                                <span class="crm__card-value">{{ Str::limit(strip_tags($post->content), 200) }}</span>
                            </div>
                        @endif
                        
                        <div class="crm__card-field">
                            <span class="crm__card-label">Статус:</span>
                            <span class="crm__card-value">
                                @if($post->is_published)
                                    <span class="crm__status crm__status--active">
                                        <i class="fa fa-check-circle"></i>
                                        Опубликован
                                    </span>
                                @else
                                    <span class="crm__status crm__status--inactive">
                                        <i class="fa fa-clock-o"></i>
                                        Черновик
                                    </span>
                                @endif
                            </span>
                        </div>
                        
                        <div class="crm__card-field">
                            <span class="crm__card-label">Дата создания:</span>
                            <span class="crm__card-value">
                                <i class="fa fa-calendar"></i>
                                {{ $post->created_at->format('d.m.Y H:i') }}
                            </span>
                        </div>
                        
                        @if($post->published_at)
                            <div class="crm__card-field">
                                <span class="crm__card-label">Дата публикации:</span>
                                <span class="crm__card-value">
                                    <i class="fa fa-calendar-check-o"></i>
                                    
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        
        @if($posts->hasPages())
            <div class="crm__pagination">
                {{ $posts->links() }}
            </div>
        @endif
    @else
        <div class="crm__empty">
            <div class="crm__empty-icon">
                <i class="fa fa-newspaper-o"></i>
            </div>
            <h3 class="crm__empty-title">Посты не найдены</h3>
            <p class="crm__empty-text">У вас пока нет постов. Создайте первый пост, чтобы начать работу с блогом.</p>
            <a href="{{ route('crm.posts.create') }}" class="crm__btn crm__btn--primary">
                <i class="fa fa-plus"></i>
                Создать пост
            </a>
        </div>
    @endif
@endsection

@push('scripts')
<style>
    .crm__status--inactive {
        background-color: #fef3c7;
        color: #92400e;
    }
</style>
@endpush
