@extends('components.main')
@section('content')

<h2 class="galary__title">Галерея</h2>
<p class="galary__description">Добро пожаловать в галерею наших работ!</p>

@if($photos->isEmpty())
    <p class="galary__empty">Фотографии пока не добавлены.</p>
@else
<div class="galary__top-bar">
    <div class="galary__counter">Показано {{ $photos->count() }} из {{ $photos->total() }} фото</div>
</div>
<section class="galary__photos">
    <div class="galary__list galary__list--masonry">
        @foreach($photos as $photo)
            <div class="galary__item-wrap">
                <img class="galary__item galary__item-anim" src="{{ $photo->name_photo }}" alt="{{ $photo->description ?? 'Фото ' . $loop->iteration }}" loading="lazy" data-full="{{ $photo->name_photo }}" data-desc="{{ $photo->description }}">
                <div class="galary__caption">
                    @if($photo->description)
                        <div>{{ $photo->description }}</div>
                    @endif
                    <div class="galary__date">{{ $photo->created_at->format('d.m.Y H:i') }}</div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="galary__pagination">
        {{ $photos->withQueryString()->links() }}
    </div>
</section>
<button id="toTopBtn" class="galary__to-top" title="Наверх">↑</button>
<!-- Модальное окно для просмотра фото -->
<div id="galaryModal" class="galary-modal">
    <span class="galary-modal__close">&times;</span>
    <img class="galary-modal__img" id="galaryModalImg" src="" alt="">
    <div class="galary-modal__desc" id="galaryModalDesc"></div>
</div>
@endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('galaryModal');
    const modalImg = document.getElementById('galaryModalImg');
    const modalDesc = document.getElementById('galaryModalDesc');
    const images = Array.from(document.querySelectorAll('.galary__item'));
    let currentIdx = 0;

    function animateModalImg(direction) {
        // direction: 'left' (следующее), 'right' (предыдущее)
        modalImg.classList.remove('slide-in-left', 'slide-in-right', 'slide-left', 'slide-right');
        void modalImg.offsetWidth; // reflow
        if (direction === 'left') {
            modalImg.classList.add('slide-left');
        } else if (direction === 'right') {
            modalImg.classList.add('slide-right');
        }
    }
    function showModal(idx, direction = null) {
        if (idx < 0 || idx >= images.length) return;
        if (direction) animateModalImg(direction);
        setTimeout(() => {
            currentIdx = idx;
            modalImg.classList.remove('slide-left', 'slide-right', 'slide-in-left', 'slide-in-right');
            modalImg.src = images[idx].getAttribute('data-full');
            modalDesc.textContent = images[idx].getAttribute('data-desc') || '';
            if (direction === 'left') {
                modalImg.classList.add('slide-in-left');
            } else if (direction === 'right') {
                modalImg.classList.add('slide-in-right');
            }
        }, direction ? 350 : 0);
        modal.style.display = 'flex';
    }

    images.forEach((img, idx) => {
        img.addEventListener('click', function() {
            showModal(idx);
        });
    });
    document.querySelector('.galary-modal__close').onclick = function() {
        modal.style.display = 'none';
    };
    window.onclick = function(event) {
        if (event.target === modal) modal.style.display = 'none';
    };
    // Переключение по клику на фото
    modalImg.onclick = function(e) {
        e.stopPropagation();
        showModal((currentIdx + 1) % images.length, 'left');
    };
    // Свайп для мобильных
    let touchStartX = 0;
    let touchEndX = 0;
    modalImg.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    });
    modalImg.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        if (touchEndX - touchStartX > 40) { // свайп вправо (предыдущее)
            showModal((currentIdx - 1 + images.length) % images.length, 'right');
        } else if (touchStartX - touchEndX > 40) { // свайп влево (следующее)
            showModal((currentIdx + 1) % images.length, 'left');
        }
    });
    // Стрелки на клавиатуре
    document.addEventListener('keydown', function(e) {
        if (modal.style.display === 'flex') {
            if (e.key === 'ArrowRight' || e.key === ' ') showModal((currentIdx + 1) % images.length, 'left');
            if (e.key === 'ArrowLeft') showModal((currentIdx - 1 + images.length) % images.length, 'right');
            if (e.key === 'Escape') modal.style.display = 'none';
        }
    });
    // Кнопка "Наверх"
    const toTopBtn = document.getElementById('toTopBtn');
    window.onscroll = function() {
        toTopBtn.style.display = (window.scrollY > 300) ? 'block' : 'none';
    };
    toTopBtn.onclick = function() {
        window.scrollTo({top:0, behavior:'smooth'});
    };
    // Плавная анимация появления
    document.querySelectorAll('.galary__item-anim').forEach((el,i)=>{
        setTimeout(()=>el.classList.add('galary__item--show'), 80*i);
    });
});
</script>
@endpush