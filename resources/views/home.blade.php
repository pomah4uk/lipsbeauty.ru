@extends('components.main')
@section('content')
	<!-- Hero section -->
	<section class="hero-section overflow-hidden">
		<div class="hero-slider owl-carousel">
			<div class="hero-item set-bg d-flex align-items-center justify-content-center text-center" data-setbg="img/main_back.png">
				<div class="container">
					<h2>Моментальный загар</h2>
					<p>У вас намечается важное событие и на посещение сорярия не хватает времени? Я к вашим услугам! Загар 'Моментальный' 15 минут и вы неотразимы.<br>
					Процедура не только придаст вам голливудский загар, но и обеспечит глубокое увлажнение кожи!</p>
					<a href="#contact" class="site-btn">Записаться<img src="img/icons/double-arrow.png" alt="#"/></a>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero section end-->
	<a name="tan">
	<section class="intro-section">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="intro-text-box text-box text-white">
						<div class="review-pic">
							<img src="img/face_icon.png" alt="">
						</div>
						<div class="review-content text-box text-white">
							<h3>Лицо</h3>
							<p>Цена............................................300р</p>
							<p>Шапочка...........................бесплатно</p>
							<p></p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="intro-text-box text-box text-white">
						<div class="review-pic">
							<img src="img/foot_icon.png" alt="">
						</div>
						<div class="review-content text-box text-white">
							<h3>Ноги</h3>
							<p>Цена............................................500р</p>
							<p>Одноразовые трусики...бесплатно</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="intro-text-box text-box text-white">
						<div class="review-pic">
							<img src="img/body_icon.bmp" alt="">
						</div>
						<div class="review-content text-box text-white">
							<h3>Всё тело</h3>
							<p>Цена...........................................1000р</p>
							<p>Шапочка............................бесплатно</p>
							<p>Одноразовые трусики....бесплатно</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Intro section end -->

	<!-- Featured section -->
	<a name="faq">
	<section class="featured-section">
		<div class="featured-bg set-bg" data-setbg="img/info.jpg"></div>
			<div class="featured-box">
				<div class="text-box">
					<h3>Правила, при соблюдении которых Вы получите красивый и ровный оттенок «Моментального загара»:</h3>
					<p>1. Перед процедурой необходимо сделать предварительный пилинг/скраб. Это способствует равномерному распределению оттенка на очищенной коже. Очень сухие участки тела рекомендуется обработать легким увлажняющим молочком.</p>
					<p>2. На процедуру Вы приходите с чистой кожей: без косметики/ парфюмерии/ дезодоранта!</p>
					<p>3. Все процедуры по избавлению от нежелательных волос на теле проводить не менее, чем за 6 часов до процедуры.  После процедуры – не ранее, чем через 8 часов.</p>
					<p>4. На процедуру не рекомендуется одевать светлое и обтягивающее белье, так как белье может окраситься, а на коже от плотно прилегающего белья могут остаться следы. Однако, если белье окрасилось, оно легко отстирается.</p>
					<p>5. После процедуры мыться рекомендуется не ранее, чем через 6-8 часов, а после нанесения экспресс лосьонов не ранее,чем через 2 часа.. Обработанные участки тела не трогать до первого душа!</p>
					<p>При соблюдении Вами этих правил, оттенок будет держаться в течение 7-14 дней (в зависимости от типа кожи) и равномерно осветляться.</p>
				</div>
			</div>
		</div>
	</section>
	<!-- Featured section end-->

	<!-- Contact page -->
	<a name="contact">
	<section class="contact-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 order-2 order-lg-1">
					<form class="contact-form" action="{{ route('send') }}" method="post">
						@csrf
						<input type="text" name='firstname' placeholder="Фамилия">
						<input type="text" name='name' placeholder="Имя">
						<input type="phone" name='phone' placeholder="Телефон +7" value='+7'>
						<input type="text" name='email' placeholder="Почта">
						<input type="date" name='date' placeholder="Желаемая дата">
						<button class="site-btn">Записаться<img src="img/icons/double-arrow.png" alt="#"/></button>
					</form>
				</div>
				<div class="col-lg-5 order-1 order-lg-2 contact-text text-white">
					<h3>Оставьте заявку</h3>
					<p>Подробности по телефону или Whatsapp</p>
					<div class="cont-info">
						<div class="ci-icon"><img src="img/icons/location.png" alt=""></div>
						<div class="ci-text">Россия, Томск</div>
					</div>
					<div class="cont-info">
						<div class="ci-icon"><img src="img/icons/phone.png" alt=""></div>
						<div class="ci-text">+7 923 437 91 14</div>
					</div>
					<div class="cont-info">
						<div class="ci-icon"><img src="img/icons/mail.png" alt=""></div>
						<div class="ci-text">Krasnovairiska@gmail.com</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Contact page end-->
@endsection