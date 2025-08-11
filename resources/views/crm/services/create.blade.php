@extends('components.admin-layout')

@section('page-title', 'Добавить услугу')

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
                    <i class="fa fa-plus"></i>
                    Добавить новую услугу
                </h2>
                <p class="crm__form-subtitle">Заполните форму для создания новой услуги</p>
            </div>

            <form action="{{ route('crm.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="crm__form-group">
                    <label for="title" class="crm__form-label">
                        <i class="fa fa-tag"></i>
                        Название услуги
                    </label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        value="{{ old('title') }}" 
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
                    >{{ old('description') }}</textarea>
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
                        value="{{ old('price') }}" 
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
                            required 
                            class="crm__file-input"
                            accept="image/*"
                        >
                        <label for="image" class="crm__file-label">
                            <i class="fa fa-cloud-upload"></i>
                            <span>Выберите файл или перетащите сюда</span>
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
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="crm__checkbox-input"
                            >
                            <span class="crm__checkbox-label">Активная услуга</span>
                        </label>
                    </div>
                </div>

                <div class="crm__form-actions">
                    <button type="submit" class="crm__btn crm__btn--primary">
                        <i class="fa fa-save"></i>
                        Создать услугу
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
    .crm__form-container {
        max-width: 600px;
        margin: 0 auto;
    }

    .crm__form-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .crm__form-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #1e293b;
        margin: 0 0 0.5rem 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
    }

    .crm__form-subtitle {
        color: #64748b;
        margin: 0;
        font-size: 0.875rem;
    }

    .crm__file-upload {
        position: relative;
    }

    .crm__file-input {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .crm__file-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        border: 2px dashed #cbd5e1;
        border-radius: 0.5rem;
        background-color: #f8fafc;
        cursor: pointer;
        transition: all 0.2s ease;
        gap: 0.75rem;
    }

    .crm__file-label:hover {
        border-color: #3b82f6;
        background-color: #eff6ff;
    }

    .crm__file-label i {
        font-size: 2rem;
        color: #64748b;
    }

    .crm__file-label span {
        color: #64748b;
        font-size: 0.875rem;
    }

    .crm__checkbox-group {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .crm__checkbox {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        cursor: pointer;
        padding: 0.75rem;
        border-radius: 0.5rem;
        transition: background-color 0.2s ease;
    }

    .crm__checkbox:hover {
        background-color: #f8fafc;
    }

    .crm__checkbox-input {
        width: 1.25rem;
        height: 1.25rem;
        accent-color: #3b82f6;
    }

    .crm__checkbox-label {
        font-weight: 500;
        color: #374151;
    }

    .crm__form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e2e8f0;
    }

    .crm__form-actions .crm__btn {
        flex: 1;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .crm__form-actions {
            flex-direction: column;
        }
        
        .crm__form-title {
            font-size: 1.25rem;
        }
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
                    <span>Выберите файл или перетащите сюда</span>
                `;
                fileLabel.style.borderColor = '#cbd5e1';
                fileLabel.style.backgroundColor = '#f8fafc';
            }
        });
    });
</script>
@endpush 