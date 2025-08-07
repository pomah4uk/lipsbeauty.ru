@extends('components.admin-layout')
@section('content')
<div class="admin__content" style="max-width:500px;margin:0 auto;">
    <h2 class="mb-3">Редактировать фото</h2>
    <div class="mb-3" style="text-align:center;">
        <img src="{{ $photo->name_photo }}" alt="" class="crmgalary__img">
    </div>
    <form action="{{ route('crm.photos.update', $photo) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" name="description" id="description" rows="2">{{ old('description', $photo->description) }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="admin__btn">Сохранить</button>
        <a href="{{ route('crm.photos.index') }}" class="admin__btn admin__btn--secondary">Назад</a>
    </form>
</div>
@endsection 