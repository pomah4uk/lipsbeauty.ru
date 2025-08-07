@extends('components.admin-layout')
@section('content')
<div class="admin__content">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="admin__header-row mb-3">
        <h2>Управление фото</h2>
        <button class="admin__btn" id="openAddPhotoModal">Добавить фото</button>
    </div>
    <!-- Модальное окно для добавления фото -->
    <div id="addPhotoModal" class="crm-modal-bg">
        <div class="crm-modal">
            <button type="button" class="crm-modal__close" id="closeAddPhotoModal">&times;</button>
            <h4 class="crm-modal__title mb-3">Добавить фото</h4>
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
            </form>
        </div>
    </div>
    <table class="admin__table">
        <thead>
            <tr>
                <th>Фото</th>
                <th>Описание</th>
                <th>Оригинальное имя</th>
                <th>Дата загрузки</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($photos as $photo)
                <tr>
                    <td style="width:120px"><img src="{{ $photo->name_photo }}" alt="" class="crmgalary__img"></td>
                    <td>{{ $photo->description }}</td>
                    <td>{{ $photo->original_name }}</td>
                    <td>{{ $photo->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <a href="{{ route('crm.photos.edit', $photo) }}" class="admin__btn admin__btn--small">Редактировать</a>
                        <form action="{{ route('crm.photos.destroy', $photo) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin__btn admin__btn--danger admin__btn--small" onclick="return confirm('Удалить фото?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('addPhotoModal');
    const openBtn = document.getElementById('openAddPhotoModal');
    const closeBtn = document.getElementById('closeAddPhotoModal');
    openBtn.onclick = function() {
        modal.style.display = 'flex';
    };
    closeBtn.onclick = function() {
        modal.style.display = 'none';
    };
    window.onclick = function(event) {
        if (event.target === modal) modal.style.display = 'none';
    };
});
</script>
@endpush