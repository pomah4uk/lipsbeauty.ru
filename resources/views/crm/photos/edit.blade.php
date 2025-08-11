@extends('components.admin-layout')

@section('page-title', 'Редактировать фото')

@section('header-actions')
    <a href="{{ route('crm.photos.index') }}" class="crm__btn crm__btn--secondary">
        <i class="fa fa-arrow-left"></i>
        Назад к галерее
    </a>
@endsection

@section('content')
    <div class="crm__form-container">
        <div class="crm__form">
            <div class="crm__form-header">
                <h2 class="crm__form-title">
                    <i class="fa fa-edit"></i>
                    Редактировать фото
                </h2>
                <p class="crm__form-subtitle">Обновите информацию о фотографии</p>
            </div>

            <div class="crm__photo-preview">
                <img src="{{ asset($photo->name_photo) }}" alt="{{ $photo->description ?: 'Фото' }}" class="crm__photo-preview-img">
                <div class="crm__photo-preview-info">
                    <p><strong>Файл:</strong> {{ $photo->original_name }}</p>
                    <p><strong>Загружено:</strong> {{ $photo->created_at->format('d.m.Y H:i') }}</p>
                </div>
            </div>

            <form action="{{ route('crm.photos.update', $photo) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="crm__form-group">
                    <label for="description" class="crm__form-label">
                        <i class="fa fa-align-left"></i>
                        Описание
                    </label>
                    <textarea 
                        class="crm__form-input crm__form-textarea" 
                        name="description" 
                        id="description" 
                        rows="4"
                        placeholder="Введите описание фотографии"
                    >{{ old('description', $photo->description) }}</textarea>
                    @error('description')
                        <div class="crm__form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="crm__form-actions">
                    <button type="submit" class="crm__btn crm__btn--primary">
                        <i class="fa fa-save"></i>
                        Сохранить изменения
                    </button>
                    <a href="{{ route('crm.photos.index') }}" class="crm__btn crm__btn--secondary">
                        <i class="fa fa-times"></i>
                        Отмена
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<style>
    .crm__photo-preview {
        text-align: center;
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: #f8fafc;
        border-radius: 0.75rem;
        border: 1px solid #e2e8f0;
    }

    .crm__photo-preview-img {
        max-width: 100%;
        max-height: 300px;
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 1rem;
    }

    .crm__photo-preview-info {
        text-align: left;
        max-width: 400px;
        margin: 0 auto;
    }

    .crm__photo-preview-info p {
        margin: 0.5rem 0;
        color: #64748b;
        font-size: 0.875rem;
    }

    .crm__photo-preview-info strong {
        color: #374151;
    }
</style>
@endpush 