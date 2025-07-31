@extends('components.admin-layout')
@section('content')
<div class="admin__content">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Статьи</h2>
        <a href="{{ route('crm.articles.create') }}" class="admin__btn">Создать новую статью</a>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="crm-cards-list">
        @foreach($articles as $item)
            <div class="crm-card">
                <div class="crm-card__row"><span class="crm-card__label">Заголовок</span><span class="crm-card__value">{{ $item->title }}</span></div>
                <div class="crm-card__row"><span class="crm-card__label">Дата</span><span class="crm-card__value">{{ $item->published_at ? $item->published_at->format('d.m.Y') : '' }}</span></div>
                <div class="crm-card__actions">
                    <a href="{{ route('crm.articles.show', $item) }}" class="admin__btn admin__btn--small">Просмотр</a>
                    <a href="{{ route('crm.articles.edit', $item) }}" class="admin__btn admin__btn--small">Редактировать</a>
                    <form action="{{ route('crm.articles.destroy', $item) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="admin__btn admin__btn--danger admin__btn--small" onclick="return confirm('Удалить статью?')">Удалить</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    
    @if($articles->hasPages())
        <div class="mt-3">
            {{ $articles->links() }}
        </div>
    @endif
</div>
@endsection 