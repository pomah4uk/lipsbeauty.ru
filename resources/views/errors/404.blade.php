@extends('components.main')
@section('title', 'Страница не найдена')
@section('content')

<h1 class='hero__title'>Страница не найдена!!!</h1>

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
            <button class="contacts__btn">Записаться на консультацию</button>
        </div>
    </div>
</section>

@endsection