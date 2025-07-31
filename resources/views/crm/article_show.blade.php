@extends('components.admin-layout')
@section('content')
<div class="admin__content">
    <h2 class="mb-3">Просмотр статьи</h2>
    
    <div class="crm-card">
        <div class="crm-card__row">
            <span class="crm-card__label">Заголовок</span>
            <span class="crm-card__value">{{ $article->title }}</span>
        </div>
        
        <div class="crm-card__row">
            <span class="crm-card__label">Дата публикации</span>
            <span class="crm-card__value">{{ $article->published_at ? $article->published_at->format('d.m.Y') : 'Не опубликована' }}</span>
        </div>
        
        <div class="crm-card__row">
            <span class="crm-card__label">Содержание</span>
            <div class="crm-card__value">
                <div style="white-space: pre-wrap;">{{ $article->content }}</div>
            </div>
        </div>
        
        <div class="crm-card__row">
            <span class="crm-card__label">Дата создания</span>
            <span class="crm-card__value">{{ $article->created_at->format('d.m.Y H:i') }}</span>
        </div>
        
        <div class="crm-card__row">
            <span class="crm-card__label">Дата обновления</span>
            <span class="crm-card__value">{{ $article->updated_at->format('d.m.Y H:i') }}</span>
        </div>
        
        <div class="crm-card__actions">
            <a href="{{ route('crm.articles.edit', $article) }}" class="admin__btn admin__btn--small">Редактировать</a>
            <a href="{{ route('crm.articles.index') }}" class="admin__btn admin__btn--secondary admin__btn--small">Назад к списку</a>
        </div>
    </div>
</div>
@endsection 