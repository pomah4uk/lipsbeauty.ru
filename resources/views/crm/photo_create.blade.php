@extends('components.admin-layout')
@section('content')
<div class="admin__content" style="max-width:500px;margin:0 auto;">
    <h2 class="mb-3">Добавить фото</h2>
    <form action="{{ route('crm.photos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="add_photo" class="form-label">Файл фото</label>
            <input type="file" class="form-control" name="add_photo" id="add_photo" required>
            @error('add_photo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" name="description" id="description" rows="2">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="admin__btn">Загрузить</button>
        <a href="{{ route('crm.photos.index') }}" class="admin__btn admin__btn--secondary">Назад</a>
    </form>
</div>
@endsection 