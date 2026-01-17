<div class="slider_block-custom">
  <div id="b3520" class="block-wrapper block-01-big-with-text-3-1">
    <section
      class="landing-block landing-block-node-img u-bg-overlay g-flex-centered g-bg-img-hero g-bg-size-cover g-mb-20 g-bg-image g-bg g-pt-30 g-pb-30 g-height-auto"
      style="
        --bg-url: ;
        --bg-url-2x: ;
        --bg-overlay: ;
        --bg-size: ;
        --bg-attachment: ;
        --bg: #ffffff;
      "
    >
      <div
        class="landing-block-node-container container text-center u-bg-overlay__inner g-mx-0 bounce"
      >
        <h2
          class="landing-block-node-title g-line-height-1 g-mt-20 text-left g-color-black g-font-size-46 g-font-weight-600 g-mb-10 g-font-nunito text-uppercase u-heading-v2-12--2"
          style="--color: ; --border-color: ; --border-color--hover: "
        >
          Отзывы о нас
        </h2>

        <div
          class="landing-block-node-text text-left g-color-black g-font-size-22 g-font-weight-400 g-mb-0 g-font-nunito"
          data-auto-font-scale=""
          style="--color: "
        >
          Vetrina - более 33 000 товаров для животных в Минске и доставкой по
          Беларуси
        </div>

<a
            href="https://yandex.by/maps/org/vetrina/8791982878/reviews/?ll=27.538550%2C53.871100&z=15"
            target="_self"
            class="testimonails_source"
          >Источник: Яндекс Карты. Читать все -></a>
      </div>
    </section>
  </div>

  <div class="custom-slider-container slider_block">
    <button class="custom-arrow" id="custom-leftArrow"></button>
    <div class="custom-items" id="custom-items">
      <!-- Элементы будут добавлены через JavaScript -->
    </div>
    <button class="custom-arrow" id="custom-rightArrow"></button>
  </div>
</div>
<script>
  // Данные для слайдов
  const customSliderData = [
    {
      img: "https://avatars.mds.yandex.net/get-yapic/29310/M6fo7LMVmFx2Xh6NJ3cvD8p4TY-1/islands-68",
      title: "Наталья Моисеева",
      subtitle: "⭐⭐⭐⭐⭐",
      text: "Этот магазин — идеальное место для владельцев питомцев! Удобное расположение. Ассортимент огромный: корма, игрушки и аксессуары. Просто глаза разбегаются. Очень стильный интерьер, все аккуратно и чисто...",
    },
    {
      img: "https://avatars.mds.yandex.net/get-yapic/62162/lUqFh5FqYpEqXqFXqa7HrALLec-1/islands-68",
      title: "Moodokot",
      subtitle: "⭐⭐⭐⭐⭐",
      text: "Очень симпатичный магазин , отличается от остальных приятной атмосферой в пастельных тонах, магазинчик небольшой , но ассортимент очень широкий Цены ниже чем в ближайших других зоомагазинах. Приветливый персонал. Буду приходить сюда постоянно",
    },
    {
      img: "https://avatars.mds.yandex.net/get-yapic/6214067/Diq4PN4iX0a3TTzoWyR3qd3Edxw-1/islands-68",
      title: "Ирина Щетко",
      subtitle: "⭐⭐⭐⭐⭐",
      text: "как же нам повезло, что открылся такой магазин - тут есть просто всё! :)))) Магазин рекомендую!!!  очень радуют продавцы, которые расскажут все и обо всём. Спасибо девочкам, что проконсультировали по корму. Я даже не знала, что кормлю популярным 'фастфудом'...",
    },
    {
      img: "",
      title: "Ольга Лапушка",
      subtitle: "⭐⭐⭐⭐⭐",
      text: "Рада что рядом с домом открылся такой магазин. Мы теперь ваши постоянные покупатели. Огромный ассортимент, отзывчивые продавцы-консультанты. Плюс ветеринарная аптека. Очень удобно когда всё необходимое можно найти в одном месте. Рекомендую 100%",
    },
    {
      img: "",
      title: "Арина Яцина",
      subtitle: "⭐⭐⭐⭐⭐",
      text: "Широкий выбор кормов , разных вкусняшек, продавец с ответственностью подходит к консультации , все расскажут понятно и покажут , в магазине уютно , все можно рассмотреть и потрогать , есть много нового, чего до этого нигде не видела",
    },
    {
      img: "https://avatars.mds.yandex.net/get-yapic/26057/enc-57aefde722948d965bbe907e1c0cc592b41aa9b79ee3ebc32ca8c29631b50fd6/islands-68",
      title: "Наталья Д.",
      subtitle: "⭐⭐⭐⭐⭐",
      text: "Ассортимент в магазине действительно впечатляет. Обслуживание на высшем уровне. Мне помогли выбрать подходящий корм для моего кота и дали рекомендации по уходу, девочки действительно заботятся о животных и знают, что продают....",
    },
    {
      img: "",
      title: "Дарья Варган",
      subtitle: "⭐⭐⭐⭐⭐",

      text: "Хочу поделиться своим опытом посещения ветеринарного магазина. Я была приятно удивлена индивидуальным ассортиментом, который здесь предлагают! В магазине есть все необходимое для ухода за питомцами, но особенно порадовала...",
    },

    {
      img: "https://avatars.mds.yandex.net/get-yapic/61207/0g-4/islands-68",
      title: "Кора винницкая",
      subtitle: "⭐⭐⭐⭐⭐",

      text: "Лучший зоомагазин, ассортимента море, персонал отзывчивый, все покажет расскажет и подберет под вашего питомца, то что нужно. Не далеко от дома, будем теперь постоянными покупателями!😍",
    },

    {
      img: "",
      title: "Ирина Вечерская",
      subtitle: "⭐⭐⭐⭐⭐",

      text: "Прекрасный магазин Большой выбор ассортимента , приветливые продавцы , всегда подскажут как и что лучше подобрать вашему питомцу 😁😁",
    },

    {
      img: "",
      title: "Кристина",
      subtitle: "⭐⭐⭐⭐⭐",

      text: "Лучший магазин в котором всегда встречает приветливый персонал, на полках огромный выбор кормов, в наличии всегда есть любимые товары 👍",
    },

    {
      img: "https://avatars.mds.yandex.net/get-yapic/41409/ponvYNbZER5fcE6ohqZfUJm1qxs-1/islands-68",
      title: "Анна",
      subtitle: "⭐⭐⭐⭐⭐",

      text: "Магазин как магазин, хороший, цены чуточку ниже чем в сетевых. Часто иду и вижу, что сотрудница курит на лавке, так что стараюсь подойти попозже, чтобы не смущать 😁",
    },

    {
      img: "https://avatars.mds.yandex.net/get-yapic/56823/sa5NXJcAyQSrK7xQThLLIc5ulQw-1/islands-68",
      title: "Egor Fateev",
      subtitle: "⭐⭐⭐⭐⭐",

      text: "Все отлично. Большой выбор кормов супер-премиум класса. Приветливые и грамотные продавцы.",
    },

    {
      img: "",
      title: "Алексей М.",
      subtitle: "⭐⭐⭐⭐⭐",

      text: "Свежая новая аптека где есть все нужное, приятное обслуживание. Проконсультировали по всем вопросам, т.к. я новоиспеченный хозяин кота :)",
    },

    {
      img: "https://avatars.mds.yandex.net/get-yapic/29310/vEqZaIHMJV9UAZGNm4PtUIOxEM-1/islands-68",
      title: "Иван Терещенко",
      subtitle: "⭐⭐⭐⭐⭐",

      text: "Вчера зашли в первый раз! Огонь! Ассортимент огромный, цены не кусаются, девочка нас проконсультировала как надо. Кормов и ништяков куча",
    },

    {
      img: "https://avatars.mds.yandex.net/get-yapic/36689/enc-8fdaa6fdc8b284fa3e43fb6227888d14300b912cb9948157cc2b71c2308deb9f/islands-68",
      title: "Мария Гнетько",
      subtitle: "⭐⭐⭐⭐⭐",

      text: "Симпатично, уютно. В продаже в основном только корма высокого качества, можно зайти с собакой Круто, что открылись прямо возле дома!",
    },

    {
      img: "https://avatars.mds.yandex.net/get-yapic/63032/0k-5/islands-68",
      title: "Марго Тен",
      subtitle: "⭐⭐⭐⭐⭐",

      text: "Хороший ассортимент товара",
    },

    {
      img: "https://avatars.mds.yandex.net/get-yapic/38663/0u-3/islands-68",
      title: "Василий Ф.",
      subtitle: "⭐⭐⭐⭐⭐",

      text: "Нормальный зоомагазин",
    },

    {
      img: "",
      title: "вика мур",
      subtitle: "⭐⭐⭐⭐⭐",

      text: "прекрасный магазинчик!🥹",
    },
  ];

  const customItemsContainer = document.getElementById("custom-items");
  const customLeftArrow = document.getElementById("custom-leftArrow");
  const customRightArrow = document.getElementById("custom-rightArrow");

  // Создаем элементы слайдов
  customSliderData.forEach((slide) => {
    const slideElement = document.createElement("div");
    slideElement.className = "custom-item";

    slideElement.innerHTML = `
    ${
      slide.img
        ? `<img class="custom-item-img" src="${slide.img}" alt="${slide.title}">`
        : `<div class="custom-item-letter">${slide.title
            .charAt(0)
            .toUpperCase()}</div>`
    }
    <h4 class="custom-item-title">${slide.title}</h4>
    <div class="custom-item-subtitle">${slide.subtitle}</div>
    <div class="custom-item-text">${slide.text}</div>
  `;

    customItemsContainer.append(slideElement);
  });

  // Логика слайдера
  let customItems = document.querySelectorAll(".custom-item");
  const customItemLength = customItems.length;

  let customSlider = [];
  for (let i = 0; i < customItemLength; i++) {
    customSlider[i] = customItems[i];
    customItems[i].remove();
  }

  let customStep = 0;
  let customOffset = 0;
  const customSlidesToMove = 
    window.innerWidth > 1024 ? 3 : window.innerWidth > 600 ? 2 : 1; 

  // Получаем ширину контейнера и рассчитываем ширину одного слайда в %
  function getCustomSlideWidth() {
    const itemsContainer = document.querySelector(".custom-items");
    const containerWidth = itemsContainer.offsetWidth;
    return 100 / (containerWidth / (containerWidth / customSlidesToMove));
  }

  // Функция для инициализации слайдера с дополнительными слайдами
  function initCustomSlider() {
    const itemsContainer = document.querySelector(".custom-items");
    itemsContainer.innerHTML = "";

    const slideWidth = getCustomSlideWidth();

    // Добавляем слайды перед текущими (для плавного перехода влево)
    for (let i = customSlidesToMove - 1; i >= 0; i--) {
      const prevIndex =
        (customStep - i - 1 + customSlider.length) % customSlider.length;
      const prevDiv = customSlider[prevIndex].cloneNode(true);
      prevDiv.classList.add("custom-item");
      prevDiv.style.left = -slideWidth * (i + 1) + "%";
      itemsContainer.appendChild(prevDiv);
    }

    // Добавляем текущие слайды
    for (let i = 0; i < customSlidesToMove; i++) {
      const currentIndex = (customStep + i) % customSlider.length;
      const currentDiv = customSlider[currentIndex].cloneNode(true);
      currentDiv.classList.add("custom-item");
      currentDiv.style.left = i * slideWidth + "%";
      itemsContainer.appendChild(currentDiv);
    }

    // Добавляем слайды после текущих (для плавного перехода вправо)
    for (let i = 0; i < customSlidesToMove; i++) {
      const nextIndex =
        (customStep + customSlidesToMove + i) % customSlider.length;
      const nextDiv = customSlider[nextIndex].cloneNode(true);
      nextDiv.classList.add("custom-item");
      nextDiv.style.left = (customSlidesToMove + i) * slideWidth + "%";
      itemsContainer.appendChild(nextDiv);
    }

    customOffset = customSlidesToMove;
  }

  // Функция для перемещения влево
  function moveCustomLeft() {
    customLeftArrow.onclick = null;

    const slideWidth = getCustomSlideWidth();
    let sliderItems = document.querySelectorAll(".custom-item");

    for (let i = 0; i < sliderItems.length; i++) {
      const currentLeft = parseFloat(sliderItems[i].style.left);
      sliderItems[i].style.left =
        currentLeft + slideWidth * customSlidesToMove + "%";
    }

    setTimeout(function () {
      // Удаляем правые слайды, которые вышли за пределы
      for (let i = 0; i < customSlidesToMove; i++) {
        if (sliderItems[sliderItems.length - 1]) {
          sliderItems[sliderItems.length - 1].remove();
        }
      }

      // Обновляем step
      customStep =
        (customStep - customSlidesToMove + customSlider.length) %
        customSlider.length;

      // Добавляем новые слайды слева
      for (let i = customSlidesToMove - 1; i >= 0; i--) {
        const prevIndex =
          (customStep - i - 1 + customSlider.length) % customSlider.length;
        const div = customSlider[prevIndex].cloneNode(true);
        div.classList.add("custom-item");
        div.style.left = -slideWidth * (i + 1) + "%";
        document
          .querySelector(".custom-items")
          .insertBefore(
            div,
            document.querySelector(".custom-items").firstChild
          );
      }

      customLeftArrow.onclick = moveCustomLeft;
    }, 600);
  }

  // Функция для перемещения вправо
  function moveCustomRight() {
    customRightArrow.onclick = null;

    const slideWidth = getCustomSlideWidth();
    let sliderItems = document.querySelectorAll(".custom-item");

    for (let i = 0; i < sliderItems.length; i++) {
      const currentLeft = parseFloat(sliderItems[i].style.left);
      sliderItems[i].style.left =
        currentLeft - slideWidth * customSlidesToMove + "%";
    }

    setTimeout(function () {
      // Удаляем левые слайды, которые вышли за пределы
      for (let i = 0; i < customSlidesToMove; i++) {
        if (sliderItems[0]) {
          sliderItems[0].remove();
        }
      }

      // Обновляем step
      customStep = (customStep + customSlidesToMove) % customSlider.length;

      // Добавляем новые слайды справа
      for (let i = 0; i < customSlidesToMove; i++) {
        const nextIndex = (customStep + customOffset + i) % customSlider.length;
        const div = customSlider[nextIndex].cloneNode(true);
        div.classList.add("custom-item");
        div.style.left = (customOffset + i) * slideWidth + "%";
        document.querySelector(".custom-items").appendChild(div);
      }

      customRightArrow.onclick = moveCustomRight;
    }, 600);
  }

  // Инициализация слайдера
  initCustomSlider();
  customLeftArrow.onclick = moveCustomLeft;
  customRightArrow.onclick = moveCustomRight;

  // Обновление при изменении размера окна
  window.addEventListener("resize", function () {
    initCustomSlider();
  });
</script>

<style>
  .slider_block-custom {
    margin: 50px auto;
    width: 100%;
  }

  .testimonails_source{
       width: 100%;
    color: #21a79b;
    display: block;
    text-align: left;
    margin: 10px 0 0 0;

  }
  .custom-slider_block {
    margin: 50px auto;
    padding: 0 50px;
  }

  .custom-header {
    margin-bottom: 30px;
  }

  .custom-title {
    font-size: 46px;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 10px;
    text-transform: uppercase;
  }

  .custom-link {
    font-size: 22px;
    color: #3498db;
    text-decoration: none;
  }

  .custom-link:hover {
    color: #ff6163;
  }

  .custom-slider-container {
    display: flex;
    justify-content: center;
    align-items: center;

    background: url(https://cdn-ru.bitrix24.by/b30573366/landing/be8/be89dab86454ce105e45014d5303377e/frame_2_1x.png)
      no-repeat center;
    background-attachment: fixed;
    background-size: cover;
  }

  .custom-item-subtitle {
    display: flex;
    flex-direction: column;
    gap: 20px;
    align-items: center;
    justify-content: center;

    margin-bottom: 20px;
  }
  .custom-item-subtitle::after {
    content: "";
    display: block;
    width: 35px;
    height: 35px;
    background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGFyaWEtaGlkZGVuPSJ0cnVlIiBjbGFzcz0ic3ZnLWlubGluZS0tZmEgZmEtcXVvdGUtbGVmdCIgZGF0YS1pY29uPSJxdW90ZS1sZWZ0IiBkYXRhLXByZWZpeD0iZmFzIiB2aWV3Qm94PSIwIDAgNDQ4IDUxMiI+PHBhdGggZmlsbD0iI2ZmZiIgZD0iTTk2IDIyNGMtMTEuMjggMC0yMS45NSAyLjMtMzIgNS45VjIyNGMwLTM1LjMgMjguNy02NCA2NC02NCAxNy42NyAwIDMyLTE0LjMzIDMyLTMycy0xNC4zLTMyLTMyLTMyQzU3LjQyIDk2IDAgMTUzLjQgMCAyMjR2OTZjMCA1My4wMiA0Mi45OCA5NiA5NiA5NnM5Ni00Mi45OCA5Ni05Ni00My05Ni05Ni05Nm0yNTYgMGMtMTEuMjggMC0yMS45NSAyLjMwNS0zMiA1Ljg3OVYyMjRjMC0zNS4zIDI4LjctNjQgNjQtNjQgMTcuNjcgMCAzMi0xNC4zMyAzMi0zMnMtMTQuMzMtMzItMzItMzJjLTcwLjU4IDAtMTI4IDU3LjQyLTEyOCAxMjh2OTZjMCA1My4wMiA0Mi45OCA5NiA5NiA5NnM5Ni00Mi45OCA5Ni05Ni00My05Ni05Ni05NiIvPjwvc3ZnPg==) !important;
    background-size: 14px 14px !important;
    background-repeat: no-repeat !important;
    background-position: 50% !important;
    background-color: var(--primary);
    line-height: 35px;
    border-radius: 50%;
  }

  .custom-arrow {
    height: 45px;
    width: 45px;
    color: #fff;
    font-size: 2rem;
    border-radius: 50%;
    background-color: #21a79b;
    border: none;
    outline: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;

    font-size: 30px;
    cursor: pointer;
    height: 45px;
    width: 45px !important;
    color: #fff !important;
    font-size: 2rem !important;
    border-radius: 50%;
    background-color: var(--primary) !important;
    border: none;
    outline: none !important;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  #custom-rightArrow {
    transform: rotate(0deg);
  }

  #custom-leftArrow {
    transform: rotate(180deg);
  }

  .custom-arrow::before {
    content: "➜";
    line-height: 2rem;
  }

  .custom-items {
    width: 90%;
    height: 500px;
    position: relative;
    margin: 0 auto;
    overflow: hidden;
    padding: 50px 0;
    display: flex;
    align-items: center;
  }

  .custom-item {
    width: calc(33.3333333333% - 20px);
    padding: 70px 30px 30px 30px;
    position: absolute;
    transition: all ease 0.6s;
    background: #fff;
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }

  .custom-item img {
    width: 100%;
    height: auto;
    max-width: 60px;
    border-radius: 500px;
    position: absolute;
    top: -30px;
  }

  .custom-item-letter {
    width: 60px;
    height: 60px;
    position: absolute;
    top: -30px;
    background: #31353e;
    color: white;
    border-radius: 500px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

    @media (max-width: 1024px) {
    .custom-item {
      width: 50%;
    }
   
  }

  @media (max-width: 600px) {
    .custom-item {
      width: 100%;
    }
 
  }
</style>
