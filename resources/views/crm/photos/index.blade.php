@extends('components.admin-layout')

@section('page-title', 'Управление галереей')

@section('header-actions')
    <button class="crm__btn crm__btn--primary" id="openAddPhotoModal">
        <i class="fa fa-plus"></i>
        Добавить фото
    </button>
@endsection

@section('content')
    @if(session('success'))
        <div class="crm__alert crm__alert--success">
            <i class="fa fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="crm__alert crm__alert--error">
            <i class="fa fa-exclamation-triangle"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="crm__stats">
        <div class="crm__stats-card">
            <div class="crm__stats-icon">
                <i class="fa fa-image"></i>
            </div>
            <div class="crm__stats-content">
                <h3 class="crm__stats-number">{{ $totalPhotos }}</h3>
                <p class="crm__stats-label">Всего фотографий</p>
            </div>
        </div>
        
        <div class="crm__stats-card">
            <div class="crm__stats-icon">
                <i class="fa fa-calendar"></i>
            </div>
            <div class="crm__stats-content">
                <h3 class="crm__stats-number">{{ $photosLastWeek }}</h3>
                <p class="crm__stats-label">За последнюю неделю</p>
            </div>
        </div>
    </div>

    @if($photos->count() > 0)
        <div class="crm__gallery">
            @foreach($photos as $photo)
                <div class="crm__gallery-item">
                    <div class="crm__gallery-image">
                        <img src="{{ asset($photo->name_photo) }}" alt="{{ $photo->description ?: 'Фото' }}" class="crm__gallery-img">
                        <div class="crm__gallery-overlay">
                            <div class="crm__gallery-actions">
                                <a href="{{ route('crm.photos.edit', $photo) }}" 
                                   class="crm__btn crm__btn--small crm__btn--secondary"
                                   title="Редактировать">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('crm.photos.destroy', $photo) }}" 
                                      method="POST" 
                                      style="display: inline;"
                                      onsubmit="return confirm('Вы уверены, что хотите удалить это фото?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="crm__btn crm__btn--small crm__btn--danger"
                                            title="Удалить">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="crm__gallery-info">
                        @if($photo->description)
                            <p class="crm__gallery-description">{{ $photo->description }}</p>
                        @endif
                        <div class="crm__gallery-meta">
                            <span class="crm__gallery-filename">{{ $photo->original_name }}</span>
                            <span class="crm__gallery-date">{{ $photo->created_at->format('d.m.Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="crm__empty">
            <div class="crm__empty-icon">
                <i class="fa fa-image"></i>
            </div>
            <h3 class="crm__empty-title">Фотографии не найдены</h3>
            <p class="crm__empty-text">У вас пока нет фотографий в галерее. Добавьте первое фото, чтобы начать работу.</p>
            <button class="crm__btn crm__btn--primary" onclick="document.getElementById('openAddPhotoModal').click()">
                <i class="fa fa-plus"></i>
                Добавить фото
            </button>
        </div>
    @endif

    <!-- Модальное окно для добавления фото -->
    <div id="addPhotoModal" class="crm__modal-overlay">
        <div class="crm__modal">
            <div class="crm__modal-header">
                <h3 class="crm__modal-title">
                    <i class="fa fa-plus"></i>
                    Добавить фото
                </h3>
                <button type="button" class="crm__modal-close" id="closeAddPhotoModal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            
            <form action="" method="POST" enctype="multipart/form-data" class="crm__modal-body">
                @csrf
                <div class="crm__form-group">
                    <label for="add_photo" class="crm__form-label">
                        <i class="fa fa-image"></i>
                        Выберите файл
                    </label>
                    <div class="crm__file-upload">
                        <input type="file" 
                               class="crm__file-input" 
                               name="add_photo" 
                               id="add_photo" 
                               required
                               accept="image/*">
                        <label for="add_photo" class="crm__file-label">
                            <i class="fa fa-cloud-upload"></i>
                            <span>Выберите изображение или перетащите сюда</span>
                        </label>
                    </div>
                    @error('add_photo')
                        <div class="crm__form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="crm__form-group">
                    <label for="description" class="crm__form-label">
                        <i class="fa fa-align-left"></i>
                        Описание (необязательно)
                    </label>
                    <textarea class="crm__form-input crm__form-textarea" 
                              name="description" 
                              id="description" 
                              rows="3"
                              placeholder="Введите описание фотографии">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="crm__form-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="crm__modal-footer">
                    <button type="submit" class="crm__btn crm__btn--primary">
                        <i class="fa fa-upload"></i>
                        Загрузить фото
                    </button>
                    <button type="button" class="crm__btn crm__btn--secondary" id="cancelAddPhoto">
                        <i class="fa fa-times"></i>
                        Отмена
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<style>
    .crm__gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .crm__gallery-item {
        background: #fff;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }

    .crm__gallery-item:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }

    .crm__gallery-image {
        position: relative;
        width: 100%;
        height: 200px;
        overflow: hidden;
    }

    .crm__gallery-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .crm__gallery-item:hover .crm__gallery-img {
        transform: scale(1.05);
    }

    .crm__gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .crm__gallery-item:hover .crm__gallery-overlay {
        opacity: 1;
    }

    .crm__gallery-actions {
        display: flex;
        gap: 0.5rem;
    }

    .crm__gallery-info {
        padding: 1rem;
    }

    .crm__gallery-description {
        margin: 0 0 0.75rem 0;
        color: #374151;
        font-size: 0.875rem;
        line-height: 1.4;
    }

    .crm__gallery-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.75rem;
        color: #64748b;
    }

    .crm__gallery-filename {
        max-width: 60%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .crm__gallery-date {
        white-space: nowrap;
    }

    @media (max-width: 768px) {
        .crm__gallery {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }
        
        .crm__gallery-image {
            height: 180px;
        }
        
        .crm__gallery-info {
            padding: 0.75rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('addPhotoModal');
    const openBtn = document.getElementById('openAddPhotoModal');
    const closeBtn = document.getElementById('closeAddPhotoModal');
    const cancelBtn = document.getElementById('cancelAddPhoto');
    const fileInput = document.getElementById('add_photo');
    const fileLabel = document.querySelector('.crm__file-label');

    function openModal() {
        modal.classList.add('crm__modal-overlay--active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.classList.remove('crm__modal-overlay--active');
        document.body.style.overflow = '';
    }

    openBtn.addEventListener('click', openModal);
    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);

    modal.addEventListener('click', function(event) {
        if (event.target === modal) {
            closeModal();
        }
    });

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
                <span>Выберите изображение или перетащите сюда</span>
            `;
            fileLabel.style.borderColor = '#cbd5e1';
            fileLabel.style.backgroundColor = '#f8fafc';
        }
    });
    // Показываем модалку если были ошибки валидации
    if (@json($errors->any())) {
        openModal();
    }
});
</script>
@endpush