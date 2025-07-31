@extends('components.admin-layout')
@section('content')
<div class="admin__content" style="max-width:500px;margin:0 auto;">
    <h2 class="mb-3">Добавить услугу</h2>
    <form action="{{ route('crm.services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Название</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required class="form-control">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea name="description" id="description" rows="3" required class="form-control">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Картинка</label>
            <input type="file" name="image" id="image" required class="form-control">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="admin__btn">Добавить</button>
        <a href="{{ route('crm.services.index') }}" class="admin__btn" style="background:#888;">Назад</a>
    </form>
</div>
@endsection 