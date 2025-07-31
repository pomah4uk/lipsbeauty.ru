@extends('components.admin-layout')
@section('content')
<div class="admin__content">
    <h2 class="mb-3">Создать новую статью</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('crm.articles.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="content">Содержание</label>
            <textarea class="form-control" id="content" name="content" rows="10" required>{{ old('content') }}</textarea>
        </div>
        
        <div class="form-group mb-3">
            <label for="published_at">Дата публикации</label>
            <input type="date" class="form-control" id="published_at" name="published_at" value="{{ old('published_at') }}">
        </div>
        
        <div class="form-group">
            <button type="submit" class="admin__btn">Создать статью</button>
            <a href="{{ route('crm.articles.index') }}" class="admin__btn admin__btn--secondary">Отмена</a>
        </div>
    </form>
</div>
@endsection 