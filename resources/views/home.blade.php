@extends('components.main')
@section('content')
<!-- Hero Section -->
<section class="hero">
    <img src="img/lips_info.jpg" alt="Губы" class="hero__img">
    <div class="hero__content">
        <h1 class="hero__title">Хотите выразительные и чувственные губы?</h1>
        <p class="hero__desc">Мечтаете об идеальном контуре и объеме, который подчеркнет именно Вашу красоту?</p>
        <p class="hero__desc">Не откладывайте свою мечту на завтра — я помогу Вам сделать ее реальностью сегодня.</p>
        <p class="hero__desc hero__desc--highlight">За годы успешной практики я помогла сотням клиентов обрести уверенность в своей красоте.</p>
        <button class="hero__btn" id="openModalBtn">Записаться <img src="img/icons/double-arrow.png" alt="→"></button>
    </div>
</section>

@if(session('success'))
    <div class="global-success">{{ session('success') }}</div>
@endif

<!-- Карточки услуг -->
<a name="lips_card"></a><br><br><br><br>
<section class="service">
    <h2 class="service__header">Выбери свой вариант</h2>
    <div class="service__cards">
        @foreach($services as $service)
            <div class="service__card">
            <img src="{{ $service->image_path }}" alt="{{ $service->title }}" class="service__img">
                <h3 class="service__title">{{ $service->title }}</h3>
                <p class="service__desc">{{ $service->description }}</p>
            </div>
        @endforeach
    </div>
</section>

<!-- Секция преимуществ и особенностей -->
<a name="features"></a><br><br><br><br>
<section class="features">
    <h3 class="features__header">Почему выбирают меня</h3>
    <ul class="features__list">
        <li class="features__item"><span class="features__icon">&#10003;</span> <span>Исправление асимметрии, исправление чужих работ, выравнивание контура, контурная пластика и увеличение губ</span></li>
        <li class="features__item"><span class="features__icon">&#10003;</span> <span>Я использую аппликационную анестезию — это безопасно (доплаты нет)</span></li>
        <li class="features__item"><span class="features__icon">&#10003;</span> <span>Работаю только на сертифицированных препаратах. После процедуры обязательно выдаю паспорт препарата на руки.</span></li>
        <li class="features__item"><span class="features__icon">&#10003;</span> <span>В состав препарата входит лидокаин, поэтому процедура проходит комфортно</span></li>
        <li class="features__item"><span class="features__icon">&#10003;</span> <span><b>Все препараты, на которых работаю, СЕРТИФИЦИРОВАНЫ, БЕЗОПАСНЫ и БИОДЕГРАДИРУЕМЫ, выводятся организмом в течение 8-12 месяцев!</b></span></li>
    </ul>
</section>

<!-- Блок противопоказаний -->
<section class="contra">
    <h2 class="contra__header">Противопоказания</h2>
    <ul class="contra__list">
        <li class="contra__item"><span class="contra__icon">&#10060;</span> <span>Индивидуальная непереносимость филлеров пациентом</span></li>
        <li class="contra__item"><span class="contra__icon">&#10060;</span> <span>Беременность</span></li>
        <li class="contra__item"><span class="contra__icon">&#10060;</span> <span>Лактация</span></li>
        <li class="contra__item"><span class="contra__icon">&#10060;</span> <span>Онкологические заболевания в острой стадии</span></li>
        <li class="contra__item"><span class="contra__icon">&#10060;</span> <span>Нарушение свертываемости крови</span></li>
        <li class="contra__item"><span class="contra__icon">&#10060;</span> <span>Психосоматические расстройства</span></li>
    </ul>
</section>

<!-- Секция дополнительных процедур -->
<section class="extra">
    <h2 class="extra__header">Дополнительные процедуры</h2>
    <div class="extra__list">
        <div class="extra__group">
            <h3 class="extra__group-title">Контурная пластика и коррекция филлером</h3>
            <ul class="extra__group-list">
                <li class="extra__group-item">Подбородка</li>
                <li class="extra__group-item">Скулы</li>
                <li class="extra__group-item">Профиль Джоли</li>
            </ul>
        </div>
        <div class="extra__group">
            <h3 class="extra__group-title">Омоложение и уход</h3>
            <ul class="extra__group-list">
                <li class="extra__group-item">Коктейль "Монако"</li>
                <li class="extra__group-item">Коллаген</li>
            </ul>
        </div>
        <div class="extra__group">
            <h3 class="extra__group-title">Коррекция формы лица</h3>
            <ul class="extra__group-list">
                <li class="extra__group-item">Худое лицо</li>
            </ul>
        </div>
    </div>
</section>

<!-- Два варианта инъекций -->
<section class="inject">
    <h2 class="inject__header">Два варианта инъекций</h2>
    <div class="inject__row">
        <div class="inject__card">
            <h2 class="inject__title">Gelauron Pen</h2>
            <img src="img/hyaluron_pen.jpg" alt="Gelauron Pen" class="inject__img">
            <p class="inject__desc">Безыгольная процедура для увеличения губ и коррекции морщин. Безболезненно, быстро и безопасно.</p>
        </div>
        <div class="inject__card">
            <h2 class="inject__title">Иглами</h2>
            <img src="img/meza_needle.jpg" alt="Иглами" class="inject__img">
            <p class="inject__desc">Классическая инъекционная методика для точной коррекции и насыщения кожи полезными веществами.</p>
        </div>
    </div>
</section>

<!-- Контакты -->
<a name="contact"></a><br><br>
<section class="contacts">
    <div class="contacts__row">
        <div class="contacts__info">
            <h3 class="contacts__title">Связаться со мной</h3>
            <p class="contacts__desc">Вы можете написать в WhatsApp, позвонить или воспользоваться формой ниже:</p>
            <div class="contacts__cont-info">
                <div class="contacts__ci-icon">
                    <i class="fa fa-telegram contacts__link--telegram" style="font-size:32px;color:#0088cc;"></i>
                </div>
                <div class="contacts__ci-text"><a href="https://t.me/salikhova_irina" target="_blank" class="contacts__link contacts__link--telegram">Telegram</a></div>
            </div>
            <div class="contacts__cont-info">
                <div class="contacts__ci-icon">
                    <i class="fa fa-whatsapp contacts__link--whatsapp" style="font-size:38px;color:#25d366;"></i>
                </div>
                <div class="contacts__ci-text"><a href="https://wa.me/79234379114" target="_blank" class="contacts__link contacts__link--whatsapp">WhatsApp</a></div>
            </div>
            <div class="contacts__cont-info">
                <div class="contacts__ci-icon">
                    <i class="fa fa-vk contacts__link--vk" style="font-size:32px;color:#4c75a3;"></i>
                </div>
                <div class="contacts__ci-text"><a href="https://vk.com/moment_zagarr" target="_blank" class="contacts__link contacts__link--vk">ВКонтакте</a></div>
            </div>
            <div class="contacts__cont-info">
                <div class="contacts__ci-icon">
                    <i class="fa fa-envelope contacts__link--email" style="font-size:32px;color:#ea4335;"></i>
                </div>
                <div class="contacts__ci-text"><a href="mailto:Krasnovairiska@gmail.com" class="contacts__link contacts__link--email">Krasnovairiska@gmail.com</a></div>
            </div>
            <div class="contacts__cont-info">
                <div class="contacts__ci-icon">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" width="35" height="35">
  					<path d="M17.5 32C17.5 32 27 23.5 27 16.5C27 11.2533 22.7467 7 17.5 7C12.2533 7 8 11.2533 8 16.5C8 23.5 17.5 32 17.5 32Z" stroke="#a3154b" stroke-width="2" fill="none"/>
  					<circle cx="17.5" cy="16.5" r="3" stroke="#a3154b" stroke-width="2" fill="none"/>
					</svg></div>
                <div class="contacts__ci-text">Россия, г.Томск, ул.Пушкина 22</div>
            </div>
            <button class="contacts__btn" id="openModalBtnFooter">Записаться на консультацию</button>
        </div>
    </div>
</section>
@endsection