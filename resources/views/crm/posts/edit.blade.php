@extends('components.admin-layout')

@section('page-title', 'Редактировать пост')

@section('header-actions')
    <a href="{{ route('crm.posts.index') }}" class="crm__btn crm__btn--secondary">
        <i class="fa fa-arrow-left"></i>
        Назад к постам
    </a>
@endsection

@section('content')
    <div class="crm__form-container">
        <div class="crm__form">
            <div class="crm__form-header">
                <h2 class="crm__form-title">
                    <i class="fa fa-edit"></i>
                    Редактировать пост
                </h2>
                <p class="crm__form-subtitle">Обновите информацию о посте</p>
            </div>

            @if($post->img_path)
                <div class="crm__post-preview">
                    <img src="{{ $post->img_path }}" alt="{{ $post->title }}" class="crm__post-preview-img">
                    <div class="crm__post-preview-info">
                        <p><strong>Текущее изображение</strong></p>
                        <p><strong>Создан:</strong> {{ $post->created_at->format('d.m.Y H:i') }}</p>
                        @if($post->published_at)
                            <p><strong>Опубликован:</strong> {{ $post->published_at->format('d.m.Y H:i') }}</p>
                        @endif
                    </div>
                </div>
            @endif

            <form action="{{ route('crm.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="crm__form-group">
                    <label for="title" class="crm__form-label">
                        <i class="fa fa-tag"></i>
                        Заголовок поста
                    </label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        value="{{ old('title', $post->title) }}" 
                        required 
                        class="crm__form-input"
                        placeholder="Введите заголовок поста"
                    >
                    @error('title')
                        <div class="crm__form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="crm__form-group">
                    <label for="excerpt" class="crm__form-label">
                        <i class="fa fa-quote-left"></i>
                        Краткое описание
                    </label>
                    <textarea 
                        name="excerpt" 
                        id="excerpt" 
                        rows="3" 
                        class="crm__form-input crm__form-textarea"
                        placeholder="Введите краткое описание поста (необязательно)"
                    >{{ old('excerpt', $post->excerpt) }}</textarea>
                    @error('excerpt')
                        <div class="crm__form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="crm__form-group">
                    <label for="content" class="crm__form-label">
                        <i class="fa fa-align-left"></i>
                        Содержание поста
                    </label>
                    <textarea 
                        name="content" 
                        id="content" 
                        rows="8" 
                        required 
                        class="crm__form-input crm__form-textarea"
                        placeholder="Введите содержание поста"
                    >{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <div class="crm__form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="crm__form-group">
                    <label for="img_path" class="crm__form-label">
                        <i class="fa fa-image"></i>
                        Изображение поста
                    </label>
                    <div class="crm__file-upload">
                        <input 
                            type="file" 
                            name="img_path" 
                            id="img_path" 
                            class="crm__file-input"
                            accept="image/*"
                        >
                        <label for="img_path" class="crm__file-label">
                            <i class="fa fa-cloud-upload"></i>
                            <span>{{ $post->img_path ? 'Выберите новое изображение или оставьте текущее' : 'Выберите изображение для поста' }}</span>
                        </label>
                    </div>
                    @error('img_path')
                        <div class="crm__form-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="crm__form-group">
                    <label class="crm__form-label">
                        <i class="fa fa-toggle-on"></i>
                        Статус публикации
                    </label>
                    <div class="crm__checkbox-group">
                        <label class="crm__checkbox">
                            <input 
                                type="checkbox" 
                                name="is_published" 
                                value="1" 
                                {{ old('is_published', $post->is_published) ? 'checked' : '' }}
                                class="crm__checkbox-input"
                            >
                            <span class="crm__checkbox-label">Опубликовать пост</span>
                        </label>
                    </div>
                </div>

                <div class="crm__form-actions">
                    <button type="submit" class="crm__btn crm__btn--primary">
                        <i class="fa fa-save"></i>
                        Сохранить изменения
                    </button>
                    <a href="{{ route('crm.posts.index') }}" class="crm__btn crm__btn--secondary">
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
    .crm__post-preview {
        text-align: center;
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: #f8fafc;
        border-radius: 0.75rem;
        border: 1px solid #e2e8f0;
    }

    .crm__post-preview-img {
        max-width: 100%;
        max-height: 200px;
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 1rem;
    }

    .crm__post-preview-info {
        text-align: left;
        max-width: 400px;
        margin: 0 auto;
    }

    .crm__post-preview-info p {
        margin: 0.5rem 0;
        color: #64748b;
        font-size: 0.875rem;
    }

    .crm__post-preview-info strong {
        color: #374151;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('img_path');
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
                    <span>{{ $post->img_path ? 'Выберите новое изображение или оставьте текущее' : 'Выберите изображение для поста' }}</span>
                `;
                fileLabel.style.borderColor = '#cbd5e1';
                fileLabel.style.backgroundColor = '#f8fafc';
            }
        });
    });
</script>
@endpush
