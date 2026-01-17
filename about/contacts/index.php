<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
	//$APPLICATION->SetTitle("Задайте вопрос");
?><div class="delivery-header">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 mx-auto text-center head_delovery">
				<h1 class="landing-block-node-card-title text-uppercase g-pos-rel g-line-height-1 g-font-weight-700 g-mb-10 g-font-nunito g-font-size-50 delivery_title">
				Контакты </h1>
				<p class="landing-block-node-card-text g-mb-20 g-font-size-18 ">
					 Свяжитесь с нами сами или оставьте заявку. Всегда рады помочь!
				</p>
			</div>
		</div>
	</div>
</div>
<div id="b3624" class="block-wrapper block-01-big-with-text-3-1 delivery_main">
 <section class="landing-block landing-block-node-img u-bg-overlay g-flex-centered g-bg-img-hero g-bg-size-cover g-mb-20 g-bg-image g-bg g-pt-30 g-pb-30 g-height-auto">
	<div class="landing-block-node-container container text-center u-bg-overlay__inner g-mx-0 bounce">
		<div class="contacts-content">
			<div class="contacts-map">
				<div id="yandex-map" style="width: 100%; height: 100%;">
				</div>
			</div>
			<div class="contacts-info">
				<div class="contact-item">
					<i class="contact-icon fas fa-map-marker-alt"></i>
					<div class="contact-details">
						<h3>Адрес</h3>
						<p>
							Минск, ул. И. Лученка, 2
						</p>
					</div>
				</div>
				<div class="contact-item">
          			<i class="contact-icon fas fa-phone"></i>
					<div class="contact-details">
						<h3>Телефон</h3>
						<p>
							<a href="tel:+375296303043">+375 (29) 630-30-43</a>
						</p>
					</div>
				</div>
				<div class="contact-item">
 					<i class="contact-icon fas fa-envelope"></i>
					<div class="contact-details">
						<h3>Email</h3>
						<p>
							<a href="mailto:vetrina.minskworld@gmail.com">vetrina.minskworld@gmail.com</a>
						</p>
					</div>
				</div>
				<div class="contact-item">
 					<i class="contact-icon fas fa-clock"></i>
					<div class="contact-details">
						<h3>Режим работы</h3>
						<p>10:00-22:00</p>
					</div>
				</div>
				<div class="contact-item">
 					<i class="contact-icon fas fa-share-alt"></i>
					<div class="contact-details">
						<h3>Социальные сети</h3>
						<div class="social-icons mb-4">
 							<a href="https://www.instagram.com/vetrina_minsk" target="_blank" class="social-icon"> <img src="https://cdn-icons-png.flaticon.com/512/15707/15707749.png" alt=""> </a> <a href="https://www.tiktok.com/@vetrina_minsk" target="_blank" class="social-icon"> <img src="https://cdn-icons-png.flaticon.com/512/3670/3670313.png" alt=""> </a> <a href="https://t.me/vetrina_minsk" target="_blank" class="social-icon"> <img src="https://cdn-icons-png.flaticon.com/512/2111/2111646.png" alt=""> </a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="contact-form">
			<h2>Задать вопрос</h2>
			 <?$APPLICATION->IncludeComponent(
	"bitrix:main.feedback",
	"bootstrap_v4",
	Array(
		"EMAIL_TO" => "sale@nyuta.bx",
		"EVENT_MESSAGE_ID" => array(),
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",
		"REQUIRED_FIELDS" => array("NAME","EMAIL"),
		"USE_CAPTCHA" => "Y"
	)
);?>
		</div>
	</div>
 </section>
</div>
<!-- Подключение API Яндекс.Карт с вашим ключом -->
<script src="https://api-maps.yandex.ru/2.1/?apikey=fc87678c-f03e-4c7d-8b1b-7710dd97bf0b
&lang=ru_RU" type="text/javascript"></script>
<style>

  .contact-form{
      margin: 50px 0 0 0;
      padding: 30px;
      border-radius: 20px;
      background: #ffffff;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .contact-form h2{
      margin: 0 0 30px 0;
  }

  .form-group label{
      width: 100%;
      text-align: left;
      margin: 20px 0 10px 0;

  }

  .contact-form .btn.btn-primary{
      margin: 20px 0 00 0;
      color: white !important;
  }

  .social-icon img {
    width: 40px;
    height: 40px;
  }

  .delivery_main {
    padding: 0 0 2rem 0;
    border-radius: 0 0 15px 15px;
    background-image: url("/bitrix/templates/eshop_bootstrap_v4_original/images/bg3.png");
    background-repeat: no-repeat;
    background-position: center top;
    background-size: cover;
    margin-left: calc(-50vw + 50%);
    margin-right: calc(-50vw + 50%);
    width: 100vw;
    box-sizing: border-box;
  }

  .delivery-header {
    color: white;
    padding: 2rem 0 2rem 0;
    border-radius: 0 0 15px 15px;
    background-image: url("/bitrix/templates/eshop_bootstrap_v4_original/images/bg2.png");
    background-repeat: no-repeat;
    background-position: center bottom;
    background-size: cover;
    margin-left: calc(-50vw + 50%);
    margin-right: calc(-50vw + 50%);
    width: 100vw;
    box-sizing: border-box;
  }

  .contacts_outer {
    background-image: url("/bitrix/templates/eshop_bootstrap_v4_original/images/bg.png");
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    /* background: #21a79b !important; */
  }

  .head_delovery{
    background: #31353E;
    padding: 12px;
    border-radius: 15px;
    color: white !important;
  }

  .delivery_title{
    font-size: 36px;
    margin-bottom: 0.5rem;
  }

  /* .contacts-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
  } */
  
    .social-icon img {
      width: 40px;
      height: 40px;
    }

  .contacts-title {
    text-align: center;
    margin-bottom: 40px;
    font-size: 36px;
    color: #2c3e50;
    font-weight: 700;
    position: relative;
  }
  
  .contacts-title:after {
    content: '';
    display: block;
    width: 60px;
    height: 3px;
    background-color: #00aea1;
    margin: 15px auto 0;
  }
  
  .contacts-content {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }
  
  .contacts-map {
    flex: 1;
    min-width: 300px;
  }
  
  .contacts-info {
    flex: 1;
    min-width: 300px;
    padding: 30px;
    background-color: white;
  }
  
  .contact-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 25px;
  }
  
  .contact-icon {
    font-size: 20px;
    color: #00aea1;
    margin-right: 15px;
    margin-top: 5px;
    min-width: 20px;
  }
  
  .contact-details h3 {
    margin-bottom: 5px;
    font-size: 18px;
    color: #2c3e50;
    text-align: left !important;
  }
  
  .contact-details p, .contact-details a {
    color: #6c757d;
    text-decoration: none;
    transition: color 0.3s ease;
  }
  
  .contact-details a:hover {
    color: #00aea1;
  }
  
  .social-links {
    display: flex;
    gap: 15px;
    margin-top: 10px;
  }
  
  .social-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background-color: #f1f1f1;
    border-radius: 50%;
    color: #2c3e50;
    transition: all 0.3s ease;
  }
  
  .social-link:hover {
    background-color: #00aea1;
    color: white;
    transform: translateY(-3px);
  }
  
  .contacts_title {
    margin: 1.42857rem 0 30px 0 !important;
  }
  
  @media (max-width: 768px) {
    .contacts-content {
      flex-direction: column;
    }
    
    .contacts-map, .contacts-info {
      width: 100%;
    }
    
    .contacts-map {
      height: 300px;
    }
  }
</style>
<script>
  // Инициализация Яндекс карты после загрузки API
  document.addEventListener('DOMContentLoaded', function() {
    // Ждем загрузки API Яндекс.Карт
    ymaps.ready(init);
    
    function init() {
      // Создаем карту
      var myMap = new ymaps.Map('yandex-map', {
        center:[ 53.869184, 27.536049], 
        zoom: 15
      });

   
      
      // Добавляем метку
      var myPlacemark = new ymaps.Placemark(  [ 53.869184, 27.536049], {
        hintContent: 'Ветрина',
        balloonContent: 'Магазин товаров для животных<br>Минск, ул. И. Лученка, 2'
      }, {
        
      });
      
      // Добавляем метку на карту
      myMap.geoObjects.add(myPlacemark);
    }
  });
</script><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>