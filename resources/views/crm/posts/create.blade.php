@extends('components.admin-layout')
@section('content')
<div class="admin__content" style="max-width:500px;margin:0 auto;">
    <h2 class="mb-3">Добавить пост</h2>
    <form action="{{ route('crm.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required class="form-control">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Описание</label>
            <textarea name="content" id="content" rows="3" required class="form-control">{{ old('content') }}</textarea>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="img_path" class="form-label">Картинка</label>
            <input type="file" name="img_path" id="img_path" required class="form-control">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="admin__btn">Добавить</button>
        <a href="{{ route('crm.posts.index') }}" class="admin__btn" style="background:#888;">Назад</a>
    </form>
</div>
@endsection 