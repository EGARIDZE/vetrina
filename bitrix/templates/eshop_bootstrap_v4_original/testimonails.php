<!-- HTML -->
<div class="slider_block vetrina-reviews-slider container my-5 position-relative" style="background: url('/bitrix/templates/eshop_bootstrap_v4_original/images/bg.png') no-repeat center; background-attachment: fixed; background-size: cover; padding: 50px 0; border-radius: 15px;">
	<div class="d-flex flex-column align-items-center mb-3">
		<h2 class="mb-2" style="color: #2c3e50;">Отзывы о нас</h2>
		<div class="text-center w-100" style="max-width:800px; font-size:22px; font-weight:400; color:#333;">
			 Vetrina - более 33 000 товаров для животных в Минске и доставкой по Беларуси
		</div>
 <a href="https://yandex.by/maps/org/vetrina/8791982878/reviews/?ll=27.538550%2C53.871100&z=15" target="_self" style="color:#21a79b; text-align:center; margin-top:10px; width:100%; max-width:800px; display:block;">
		Источник: Яндекс Карты. Читать все -&gt; </a>
	</div>
	<div id="reviewsCarousel" class="carousel slide" data-ride="carousel" data-interval="6000" data-pause="hover">
		<div class="carousel-inner pt-5">
		</div>
 <a class="carousel-control-prev" href="#reviewsCarousel" role="button" data-slide="prev" style="width: 60px; height:60px; top: 50%; /*left:-30px;*/ transform: translateY(-50%); /*background: #00aea1;*/ border-radius:50%; display:flex; align-items:center; justify-content:center; z-index:10;"> <span class="carousel-control-prev-icon" aria-hidden="true" style="filter:invert(1);"></span> <span class="sr-only">Назад</span> </a> <a class="carousel-control-next" href="#reviewsCarousel" role="button" data-slide="next" style="width: 60px; height:60px; top: 50%; /*right:-30px;*/ transform: translateY(-50%); /*background: #00aea1;*/ border-radius:50%; display:flex; align-items:center; justify-content:center; z-index:10;"> <span class="carousel-control-next-icon" aria-hidden="true" style="filter:invert(1);"></span> <span class="sr-only">Вперёд</span> </a>
	</div>
</div>
<style>
  /* --- Стили для уникального слайдера отзывов --- */

  /* Фиксированная высота для контейнера слайдов, чтобы избежать дергания */
  .vetrina-reviews-slider .carousel-inner {
    min-height: 520px;
    display: flex;
    align-items: center; /* Центрируем карточку по вертикали */
  }

  .vetrina-reviews-slider::before {
    /* content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100vw;
    height: 80px;
    margin-left: calc(-50vw + 50%);
    background-color: var(--theme-color-secondary);
    z-index: 0 */
  }

  /* Стили для карточки отзыва */
  .vetrina-reviews-slider .review-card {
    background: #fff;
    border-radius: 25px;
    box-shadow: 0 6px 22px rgba(52, 152, 219, 0.08);
    padding: 32px 20px 24px 20px;
    margin: 20px auto; /* auto по бокам для центрирования */
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    height: 100%; /* Заставляем карточку занимать всю высоту колонки */
  }

  /* Отключаем стандартные отступы у рядов внутри карусели */
  .vetrina-reviews-slider .carousel-inner .row {
    margin-left: 0;
    margin-right: 0;
  }
  
  .vetrina-reviews-slider .review-avatar {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    object-fit: cover;
    margin-top: -68px; /* Выносим аватар чуть выше */
    margin-bottom: 20px;
    box-shadow: 0 0 0 5px #fff;
    background: #f2f2f2;
    position: absolute;
    top: 0;
  }

  .vetrina-reviews-slider .review-initial {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: #31353e;
    color: #fff;
    font-weight: 700;
    font-size: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: -68px; /* Выносим инициалы чуть выше */
    margin-bottom: 20px;
    box-shadow: 0 0 0 5px #fff;
    position: absolute;
    top: 0;
  }
  
  .vetrina-reviews-slider .review-card-content {
      margin-top: 24px; /* Отступ от аватара */
  }

  .vetrina-reviews-slider .review-name {
    font-size: 26px;
    font-weight: 600;
    margin-bottom: 10px;
    text-align: center;
    color: #222;
  }

  .vetrina-reviews-slider .review-stars {
    color: #FFD700;
    font-size: 24px;
    margin-bottom: 20px;
    text-align: center;
  }

  .vetrina-reviews-slider .review-quote {
    width: 48px;
    height: 48px;
    background: #21a79b;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 16px auto 20px auto;
  }
  
  .vetrina-reviews-slider .review-quote svg {
    color: #fff;
    width: 28px;
    height: 28px;
  }

  .vetrina-reviews-slider .review-text {
    font-size: 18px;
    color: #222;
    text-align: center;
    margin-bottom: 0;
    margin-top: 0;
    font-weight: 400;
    overflow-wrap: break-word;
  }
  
  /* Делаем слайдер "перетаскиваемым" на вид */
  .vetrina-reviews-slider .carousel-inner {
    cursor: grab;
  }
  .vetrina-reviews-slider .carousel-inner.grabbing {
    cursor: grabbing;
  }


  /* --- Адаптивность --- */
  @media (max-width: 1024px) {
    .vetrina-reviews-slider .carousel-inner {
        min-height: 480px;
    }
  }

  @media (max-width: 768px) {
    .vetrina-reviews-slider .carousel-inner {
        min-height: 540px; /* Может понадобиться больше места на мобильных */
    }
    .vetrina-reviews-slider .carousel-control-prev,
    .vetrina-reviews-slider .carousel-control-next {
      /* Прячем стрелки по бокам и делаем их меньше, чтобы не мешали */
      display: none!important;
    }
  }
</style>
<script>
// Данные остаются без изменений
const reviewsData = [
  {img: "https://avatars.mds.yandex.net/get-yapic/29310/M6fo7LMVmFx2Xh6NJ3cvD8p4TY-1/islands-68", title: "Наталья Моисеева", subtitle: "⭐⭐⭐⭐⭐", text: "Этот магазин — идеальное место для владельцев питомцев! Удобное расположение. Ассортимент огромный: корма, игрушки и аксессуары. Просто глаза разбегаются. Очень стильный интерьер, все аккуратно и чисто..."},
  {img: "https://avatars.mds.yandex.net/get-yapic/62162/lUqFh5FqYpEqXqFXqa7HrALLec-1/islands-68", title: "Moodokot", subtitle: "⭐⭐⭐⭐⭐", text: "Очень симпатичный магазин , отличается от остальных приятной атмосферой в пастельных тонах, магазинчик небольшой , но ассортимент очень широкий Цены ниже чем в ближайших других зоомагазинах. Приветливый персонал. Буду приходить сюда постоянно"},
  {img: "https://avatars.mds.yandex.net/get-yapic/6214067/Diq4PN4iX0a3TTzoWyR3qd3Edxw-1/islands-68", title: "Ирина Щетко", subtitle: "⭐⭐⭐⭐⭐", text: "как же нам повезло, что открылся такой магазин - тут есть просто всё! :)))) Магазин рекомендую!!!  очень радуют продавцы, которые расскажут все и обо всём. Спасибо девочкам, что проконсультировали по корму. Я даже не знала, что кормлю популярным 'фастфудом'..."},
  {img: "", title: "Ольга Лапушка", subtitle: "⭐⭐⭐⭐⭐", text: "Рада что рядом с домом открылся такой магазин. Мы теперь ваши постоянные покупатели. Огромный ассортимент, отзывчивые продавцы-консультанты. Плюс ветеринарная аптека. Очень удобно когда всё необходимое можно найти в одном месте. Рекомендую 100%"},
  {img: "", title: "Арина Яцина", subtitle: "⭐⭐⭐⭐⭐", text: "Широкий выбор кормов , разных вкусняшек, продавец с ответственностью подходит к консультации , все расскажут понятно и покажут , в магазине уютно , все можно рассмотреть и потрогать , есть много нового, чего до этого нигде не видела"},
  {img: "https://avatars.mds.yandex.net/get-yapic/26057/enc-57aefde722948d965bbe907e1c0cc592b41aa9b79ee3ebc32ca8c29631b50fd6/islands-68", title: "Наталья Д.", subtitle: "⭐⭐⭐⭐⭐", text: "Ассортимент в магазине действительно впечатляет. Обслуживание на высшем уровне. Мне помогли выбрать подходящий корм для моего кота и дали рекомендации по уходу, девочки действительно заботятся о животных и знают, что продают...."},
  {img: "", title: "Дарья Варган", subtitle: "⭐⭐⭐⭐⭐", text: "Хочу поделиться своим опытом посещения ветеринарного магазина. Я была приятно удивлена индивидуальным ассортиментом, который здесь предлагают! В магазине есть все необходимое для ухода за питомцами, но особенно порадовала..."},
  {img: "https://avatars.mds.yandex.net/get-yapic/61207/0g-4/islands-68", title: "Кора винницкая", subtitle: "⭐⭐⭐⭐⭐", text: "Лучший зоомагазин, ассортимента море, персонал отзывчивый, все покажет расскажет и подберет под вашего питомца, то что нужно. Не далеко от дома, будем теперь постоянными покупателями!😍"},
  {img: "", title: "Ирина Вечерская", subtitle: "⭐⭐⭐⭐⭐", text: "Прекрасный магазин Большой выбор ассортимента , приветливые продавцы , всегда подскажут как и что лучше подобрать вашему питомцу 😁😁"},
  {img: "", title: "Кристина", subtitle: "⭐⭐⭐⭐⭐", text: "Лучший магазин в котором всегда встречает приветливый персонал, на полках огромный выбор кормов, в наличии всегда есть любимые товары 👍"},
  {img: "https://avatars.mds.yandex.net/get-yapic/41409/ponvYNbZER5fcE6ohqZfUJm1qxs-1/islands-68", title: "Анна", subtitle: "⭐⭐⭐⭐⭐", text: "Магазин как магазин, хороший, цены чуточку ниже чем в сетевых. Часто иду и вижу, что сотрудница курит на лавке, так что стараюсь подойти попозже, чтобы не смущать 😁"},
  {img: "https://avatars.mds.yandex.net/get-yapic/56823/sa5NXJcAyQSrK7xQThLLIc5ulQw-1/islands-68", title: "Egor Fateev", subtitle: "⭐⭐⭐⭐⭐", text: "Все отлично. Большой выбор кормов супер-премиум класса. Приветливые и грамотные продавцы."},
  {img: "", title: "Алексей М.", subtitle: "⭐⭐⭐⭐⭐", text: "Свежая новая аптека где есть все нужное, приятное обслуживание. Проконсультировали по всем вопросам, т.к. я новоиспеченный хозяин кота :)"},
  {img: "https://avatars.mds.yandex.net/get-yapic/29310/vEqZaIHMJV9UAZGNm4PtUIOxEM-1/islands-68", title: "Иван Терещенко", subtitle: "⭐⭐⭐⭐⭐", text: "Вчера зашли в первый раз! Огонь! Ассортимент огромный, цены не кусаются, девочка нас проконсультировала как надо. Кормов и ништяков куча"},
  {img: "https://avatars.mds.yandex.net/get-yapic/36689/enc-8fdaa6fdc8b284fa3e43fb6227888d14300b912cb9948157cc2b71c2308deb9f/islands-68", title: "Мария Гнетько", subtitle: "⭐⭐⭐⭐⭐", text: "Симпатично, уютно. В продаже в основном только корма высокого качества, можно зайти с собакой Круто, что открылись прямо возле дома!"},
  {img: "https://avatars.mds.yandex.net/get-yapic/63032/0k-5/islands-68", title: "Марго Тен", subtitle: "⭐⭐⭐⭐⭐", text: "Хороший ассортимент товара"},
  {img: "https://avatars.mds.yandex.net/get-yapic/38663/0u-3/islands-68", title: "Василий Ф.", subtitle: "⭐⭐⭐⭐⭐", text: "Нормальный зоомагазин"},
  {img: "", title: "вика мур", subtitle: "⭐⭐⭐⭐⭐", text: "прекрасный магазинчик!🥹"},
];

/**
 * [ИЗМЕНЕНО]
 * Функция создает по одному слайду на каждый отзыв.
 */
function createSlides(data) {
  let slidesHTML = '';
  data.forEach((item, index) => {
    slidesHTML += `
      <div class="carousel-item${index === 0 ? ' active' : ''}">
        <div class="row justify-content-center">
          <div class="col-12 col-md-8 col-lg-6">
            <div class="review-card">
              ${item.img 
                ? `<img src="${item.img}" alt="${item.title}" class="review-avatar">`
                : `<div class="review-initial">${item.title.charAt(0)}</div>`
              }
              <div class="review-card-content">
                <div class="review-name">${item.title}</div>
                <div class="review-stars">
                  ${item.subtitle.split('').map(ch => ch === '⭐' ? '&#9733;' : ch).join('')}
                </div>
                <div class="review-quote">
                  <svg fill="none" viewBox="0 0 24 24">
                    <path d="M8.34 16.07c-.63-1.14-1.04-2.37-1.17-3.63.79-.33 1.45-1.07 1.45-2.08 0-1.41-1.13-2.56-2.52-2.56-1.45 0-2.54 1.15-2.54 2.56 0 2.91 1.4 5.58 3.85 7.49.22.17.53.14.71-.07.19-.21.16-.53-.07-.7a7.874 7.874 0 0 1-1.71-1.01zm9.19 0c-.63-1.14-1.04-2.37-1.17-3.63.79-.33 1.45-1.07 1.45-2.08 0-1.41-1.13-2.56-2.52-2.56-1.45 0-2.54 1.15-2.54 2.56 0 2.91 1.4 5.58 3.85 7.49.22.17.53.14.71-.07.19-.21.16-.53-.07-.7a7.874 7.874 0 0 1-1.71-1.01z" fill="currentColor"/>
                  </svg>
                </div>
                <p class="review-text">${item.text}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    `;
  });
  return slidesHTML;
}

// Заполняем карусель сгенерированными слайдами
document.querySelector('#reviewsCarousel .carousel-inner').innerHTML = createSlides(reviewsData);

/**
 * [НОВЫЙ БЛОК]
 * Добавляет функционал перетаскивания (drag & swipe) для карусели.
 */
document.addEventListener('DOMContentLoaded', function() {
  const carousel = document.querySelector('#reviewsCarousel');
  if (!carousel) return;

  const carouselInner = carousel.querySelector('.carousel-inner');
  let isDown = false;
  let startX;
  let scrollLeft;
  
  // Для jQuery, если он используется на сайте (стандарт для Bootstrap 4)
  const hasJQuery = typeof jQuery !== 'undefined';

  carouselInner.addEventListener('mousedown', (e) => {
    isDown = true;
    carouselInner.classList.add('grabbing');
    startX = e.pageX - carouselInner.offsetLeft;
  });

  carouselInner.addEventListener('mouseleave', () => {
    isDown = false;
    carouselInner.classList.remove('grabbing');
  });

  carouselInner.addEventListener('mouseup', (e) => {
    isDown = false;
    carouselInner.classList.remove('grabbing');
    const x = e.pageX - carouselInner.offsetLeft;
    const walk = (x - startX);
    if (walk < -100) { // Порог смещения для переключения влево
      if(hasJQuery) { $('#reviewsCarousel').carousel('next'); } 
      else { new bootstrap.Carousel(carousel).next(); }
    } else if (walk > 100) { // Порог смещения для переключения вправо
      if(hasJQuery) { $('#reviewsCarousel').carousel('prev'); }
      else { new bootstrap.Carousel(carousel).prev(); }
    }
  });

  // Для тач-устройств
  carouselInner.addEventListener('touchstart', (e) => {
      isDown = true;
      startX = e.touches[0].pageX - carouselInner.offsetLeft;
  });

  carouselInner.addEventListener('touchend', (e) => {
      isDown = false;
      const x = e.changedTouches[0].pageX - carouselInner.offsetLeft;
      const walk = x - startX;
      if (walk < -50) { // Порог смещения для swipe влево
        if(hasJQuery) { $('#reviewsCarousel').carousel('next'); }
        else { new bootstrap.Carousel(carousel).next(); }
      } else if (walk > 50) { // Порог смещения для swipe вправо
        if(hasJQuery) { $('#reviewsCarousel').carousel('prev'); }
        else { new bootstrap.Carousel(carousel).prev(); }
      }
  });
});
</script>