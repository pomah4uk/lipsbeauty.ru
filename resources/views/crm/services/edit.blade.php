@extends('components.admin-layout')

@section('page-title', 'Редактировать услугу')

@section('header-actions')
    <a href="{{ route('crm.services.index') }}" class="crm__btn crm__btn--secondary">
        <i class="fa fa-arrow-left"></i>
        Назад к услугам
    </a>
@endsection

@section('content')
    <div class="crm__form-container">
        <div class="crm__form">
            <div class="crm__form-header">
                <h2 class="crm__form-title">
                    <i class="fa fa-edit"></i>
                    Редактировать услугу
                </h2>
                <p class="crm__form-subtitle">Обновите информацию об услуге</p>
            </div>

            @if($service->image)
                <div class="crm__service-preview">
                    <img src="{{ $service->image }}" alt="{{ $service->title }}" class="crm__service-preview-img">
                    <div class="crm__service-preview-info">
                        <p><strong>Текущее изображение</strong></p>
                        <p><strong>Создана:</strong> {{ $service->created_at->format('d.m.Y H:i') }}</p>
                    </div>
                </div>
            @endif

            <form action="{{ route('crm.services.update', $service) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="crm__form-group">
                    <label for="title" class="crm__form-label">
                        <i class="fa fa-tag"></i>
                        Название услуги
                    </label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        value="{{ old('title', $service->title) }}" 
                        required 
                        class="crm__form-input"
                        placeholder="Введите название услуги"
                    >
                    @error('title')
                        <div class="crm__form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="crm__form-group">
                    <label for="description" class="crm__form-label">
                        <i class="fa fa-align-left"></i>
                        Описание
                    </label>
                    <textarea 
                        name="description" 
                        id="description" 
                        rows="4" 
                        required 
                        class="crm__form-input crm__form-textarea"
                        placeholder="Введите описание услуги"
                    >{{ old('description', $service->description) }}</textarea>
                    @error('description')
                        <div class="crm__form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="crm__form-group">
                    <label for="price" class="crm__form-label">
                        <i class="fa fa-rub"></i>
                        Цена (₽)
                    </label>
                    <input 
                        type="number" 
                        name="price" 
                        id="price" 
                        value="{{ old('price', $service->price) }}" 
                        class="crm__form-input"
                        placeholder="Введите цену услуги"
                        min="0"
                        step="100"
                    >
                    @error('price')
                        <div class="crm__form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="crm__form-group">
                    <label for="image" class="crm__form-label">
                        <i class="fa fa-image"></i>
                        Изображение услуги
                    </label>
                    <div class="crm__file-upload">
                        <input 
                            type="file" 
                            name="image" 
                            id="image" 
                            class="crm__file-input"
                            accept="image/*"
                        >
                        <label for="image" class="crm__file-label">
                            <i class="fa fa-cloud-upload"></i>
                            <span>{{ $service->image ? 'Выберите новое изображение или оставьте текущее' : 'Выберите изображение для услуги' }}</span>
                        </label>
                    </div>
                    @error('image')
                        <div class="crm__form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="crm__form-group">
                    <label class="crm__form-label">
                        <i class="fa fa-toggle-on"></i>
                        Статус услуги
                    </label>
                    <div class="crm__checkbox-group">
                        <label class="crm__checkbox">
                            <input 
                                type="checkbox" 
                                name="is_active" 
                                value="1" 
                                {{ old('is_active', $service->is_active) ? 'checked' : '' }}
                                class="crm__checkbox-input"
                            >
                            <span class="crm__checkbox-label">Активная услуга</span>
                        </label>
                    </div>
                </div>

                <div class="crm__form-actions">
                    <button type="submit" class="crm__btn crm__btn--primary">
                        <i class="fa fa-save"></i>
                        Сохранить изменения
                    </button>
                    <a href="{{ route('crm.services.index') }}" class="crm__btn crm__btn--secondary">
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
    .crm__service-preview {
        text-align: center;
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: #f8fafc;
        border-radius: 0.75rem;
        border: 1px solid #e2e8f0;
    }

    .crm__service-preview-img {
        max-width: 100%;
        max-height: 200px;
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 1rem;
    }

    .crm__service-preview-info {
        text-align: left;
        max-width: 400px;
        margin: 0 auto;
    }

    .crm__service-preview-info p {
        margin: 0.5rem 0;
        color: #64748b;
        font-size: 0.875rem;
    }

    .crm__service-preview-info strong {
        color: #374151;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('image');
        const fileLabel = document.querySelector('.crm__file-label');
        
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                const fileName = this.files[0].name;
                fileLabel.innerHTML = `
                    <i class="fa fa-check-circle"></i>
                    <span>Выбран файл: ${fileName}</span>
                `;
                fileLabel.style.borderColor = '#10b981';
                fileLabel.style.backgroundColor = '#d1fae5';
            } else {
                fileLabel.innerHTML = `
                    <i class="fa fa-cloud-upload"></i>
                    <span>{{ $service->image ? 'Выберите новое изображение или оставьте текущее' : 'Выберите изображение для услуги' }}</span>
                `;
                fileLabel.style.borderColor = '#cbd5e1';
                fileLabel.style.backgroundColor = '#f8fafc';
            }
        });
    });
</script>
@endpush 