<?php $APPLICATION->
    ShowHead(); ?>
<div class="header">
	<div class="header-main container">
 <button class="mobile-toggle"> <i class="fas fa-bars"></i> </button>
		<div class="logo">
 <a href="<?= SITE_DIR ?>"> <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/company_logo.php"
	)
);?> </a>
		</div>
		<div class="header_formob">
 <a href="tel:+375296303043" class="header-phone"> <i class="bx-header-phone-icon sidebar-icon-phone"></i>
			+375296303043 </a>
			<div class="search_srapper">
				<div class="header-search">
					<form class="search-form">
						<div class="col w-100">
							 <?$APPLICATION->IncludeComponent(
	"bitrix:search.title",
	"bootstrap_v4",
	Array(
		"CATEGORY_0" => ["iblock_catalog"],
		"CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),
		"CATEGORY_0_iblock_catalog" => ["all"],
		"CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
		"CHECK_DATES" => "N",
		"CONTAINER_ID" => "search",
		"CONVERT_CURRENCY" => "Y",
		"INPUT_ID" => "title-search-input",
		"NUM_CATEGORIES" => "1",
		"PAGE" => SITE_DIR."catalog/",
		"PREVIEW_HEIGHT" => "75",
		"PREVIEW_WIDTH" => "75",
		"PRICE_CODE" => ["BASE"],
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"SHOW_PREVIEW" => "Y",
		"TOP_COUNT" => "5"
	)
);?>
						</div>
					</form>
				</div>
				<div class="search-toggle">
				</div>
			</div>
			 <?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line",
	"bootstrap_v4",
	Array(
		"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"POSITION_FIXED" => "N",
		"SHOW_AUTHOR" => "Y",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_PERSONAL_LINK" => "N",
		"SHOW_PRODUCTS" => "N",
		"SHOW_TOTAL_PRICE" => "Y"
	)
);?>
		</div>
	</div>
 <nav class="header-nav">
	<div class="nav-container container">
		<ul class="catalog-menu">
			<li class="catalog-item"> <a href="#" class="catalog-link">
			Кошки </a>
			<div class="submenu">
				<div class="submenu-item">
 <a href="#" class="submenu-link">Сухие корма</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Консервы</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Лакомства</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Витамины и добавки</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Миски, контейнеры, кормушки</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Наполнители</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Лотки, совки</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Игрушки</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Когтеточки</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Переноски</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Домики и лежаки</a>
				</div>
			</div>
 </li>
			<li class="catalog-item"> <a href="#" class="catalog-link">
			Собаки </a>
			<div class="submenu">
				<div class="submenu-item">
 <a href="#" class="submenu-link">Сухие корма</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Консервы</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Лакомства</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Витамины и добавки</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Миски, кормушки</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Ошейники и поводки</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Игрушки</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Лежаки и домики</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Уход и гигиена</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Дрессировка</a>
				</div>
			</div>
 </li>
			<li class="catalog-item"> <a href="#" class="catalog-link">
			Грызуны </a>
			<div class="submenu">
				<div class="submenu-item">
 <a href="#" class="submenu-link">Корм для грызунов</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Лакомства</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Клетки и аксессуары</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Поилки и кормушки</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Игрушки</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Домики и гамаки</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Наполнители</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Витамины</a>
				</div>
			</div>
 </li>
			<li class="catalog-item"> <a href="#" class="catalog-link">
			Птицы </a>
			<div class="submenu">
				<div class="submenu-item">
 <a href="#" class="submenu-link">Корм для птиц</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Лакомства</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Клетки и вольеры</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Аксессуары для клеток</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Игрушки</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Витамины</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Гигиена и уход</a>
				</div>
			</div>
 </li>
			<li class="catalog-item"> <a href="#" class="catalog-link">
			Рыбки </a>
			<div class="submenu">
				<div class="submenu-item">
 <a href="#" class="submenu-link">Корм для рыбок</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Аквариумы</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Фильтры и помпы</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Обогреватели</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Декорации</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Растения</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Уход и чистка</a>
				</div>
				<div class="submenu-item">
 <a href="#" class="submenu-link">Водоподготовка</a>
				</div>
			</div>
 </li>
			<li class="catalog-item"> <a href="#" class="catalog-link"> <span class="burger_header"> </span> </a>
			<div class="submenu">
				<div class="submenu-item">
 <a href="https://vetrina.by/about/howto/" class="submenu-link">Условия оплаты</a>
				</div>
				<div class="submenu-item">
 <a href="https://vetrina.by/about/delivery/" class="submenu-link">Доставка</a>
				</div>
				<div class="submenu-item">
 <a href="https://vetrina.by/about/contacts/" class="submenu-link">Контакты</a>
				</div>
			</div>
 </li>
		</ul>
	</div>
 </nav>
</div>
<div style="background: #ffeb3b; padding: 15px; text-align: center; margin: 20px 0; border: 2px solid #ffc107; border-radius: 5px;">
	<h2 style="margin: 0; color: #333;">🚧 Сайт находится в разработке</h2>
	<p style="margin: 10px 0 0 0; color: #666;">
		 Приносим извинения за временные неудобства. Мы работаем над улучшением сайта.
	</p>
</div>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const mobileToggle = document.querySelector(".mobile-toggle");
        const headerNav = document.querySelector(".header-nav");

        mobileToggle.addEventListener("click", function () {
          headerNav.style.display =
            headerNav.style.display === "block" ? "none" : "block";
        });

        // Закрытие мобильного меню при клике вне его области
        document.addEventListener('click', function(e) {
          if (!headerNav.contains(e.target) && e.target !== mobileToggle && window.innerWidth <= 768) {
            headerNav.style.display = 'none';
          }
        });
      });
    </script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const headerSearch = document.querySelector(".search_srapper");
        const toggle = headerSearch.querySelector(".search-toggle");

        toggle.addEventListener("click", function (e) {
          e.preventDefault();
          headerSearch.classList.toggle("active");
        });

        // Закрытие поиска при клике вне его области
        document.addEventListener('click', function(e) {
          if (!headerSearch.contains(e.target)) {
            headerSearch.classList.remove("active");
          }
        });
      });
    </script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const catalogItems = document.querySelectorAll('.catalog-item');
        
        // Закрытие всех выпадающих меню
        function closeAllDropdowns() {
          catalogItems.forEach(item => {
            item.classList.remove('active');
          });
        }
        
        // Обработчик клика на пункты меню
        catalogItems.forEach(item => {
          const catalogLink = item.querySelector('.catalog-link');
          
          catalogLink.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Если меню уже открыто, закрываем его
            if (item.classList.contains('active')) {
              item.classList.remove('active');
            } else {
              // Закрываем все остальные меню и открываем текущее
              closeAllDropdowns();
              item.classList.add('active');
            }
          });
        });
        
        // Закрытие выпадающих меню при клике вне их области
        document.addEventListener('click', function(e) {
          if (!e.target.closest('.catalog-item')) {
            closeAllDropdowns();
          }
        });
        
        // Закрытие меню при нажатии Escape
        document.addEventListener('keydown', function(e) {
          if (e.key === 'Escape') {
            closeAllDropdowns();
          }
        });
      });
    </script>
    <style>
      :root {
        --primary-color: #4a9fff;
        --secondary-color: #ff6b6b;
        --dark-color: #2c3e50;
        --light-color: #f8f9fa;
        --gray-color: #6c757d;
        --border-radius: 8px;
        --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
      }

      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      .header {
        background: white;
        box-shadow: var(--box-shadow);
        position: sticky;
        top: 0;
        z-index: 1000;
      }
      .header_formob {
        display: contents;
      }
      .header-top {
        background: var(--dark-color);
        padding: 8px 0;
        color: white;
      }

      .header-top-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
      }

      .header-contact {
        display: flex;
        align-items: center;
        gap: 20px;
      }

      .header-phone {
        display: flex;
        align-items: center;
        font-weight: 500;
        color: black;
        text-decoration: none;
      }

      .header-phone:hover {
        color: black;
      }

      .header-phone i {
        color: var(--primary-color);
        margin: 0 !important;
      }

      .header-worktime {
        font-size: 14px;
        color: #ccc;
      }

      .header-auth {
        display: flex;
        gap: 15px;
      }

      .auth-link {
        color: white;
        text-decoration: none;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: var(--transition);
      }

      .auth-link:hover {
        color: var(--primary-color);
      }

      .header-main {
        padding: 15px;

        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .header-main-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .logo {
        display: flex;
        align-items: center;
      }

      .header-search {
        flex: 1;
        max-width: 500px;
        margin: 0 30px;
        position: relative;
      }

      .search-form {
        display: flex;
        width: 100%;
      }

      .search-input {
        flex: 1;
        padding: 12px 20px;
        border: 2px solid #e1e5eb;
        border-radius: var(--border-radius) 0 0 var(--border-radius);
        font-size: 16px;
        outline: none;
        transition: var(--transition);
      }

      .search-input:focus {
        border-color: var(--primary-color);
      }

      .search-btn {
        padding: 0 20px;
        background: var(--primary-color);
        color: white;
        border: none;
        border-radius: 0 var(--border-radius) var(--border-radius) 0;
        cursor: pointer;
        transition: var(--transition);
      }

      .search-btn:hover {
        background: #3a8aee;
      }

      .header-cart {
        position: relative;
      }

      .cart-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: var(--secondary-color);
        color: white;
        border: none;
        border-radius: var(--border-radius);
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
      }

      .cart-btn:hover {
        background: #ff5252;
      }

      .cart-count {
        background: white;
        color: var(--secondary-color);
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
      }

      .header-nav {
        background: #31353e;
        border-radius: var(--border-radius);
      }

      .nav-container {
        margin: 0 auto;
        padding: 0 15px;
      }

      .catalog-menu {
        display: flex;
        list-style: none;
        justify-content: stretch;
        width: 100%;
      }

      .catalog-item {
        position: relative;
        width: 100%;
      }

      .catalog-link {
        display: block;
        padding: 10px;
        color: white !important;
        text-decoration: none;
        font-weight: 500;
        transition: var(--transition);
        position: relative;
        display: flex;
        align-items: center;
        height: 100%;
        cursor: pointer;
      }

      .catalog-link:hover {
        background: rgba(255, 255, 255, 0.1);
      }

      .catalog-link i {
        margin-left: 5px;
        font-size: 14px;
      }

      .submenu {
        position: absolute;
        top: 100%;
        width: 100%;
        left: 0;
        background: white;
        box-shadow: var(--box-shadow);
        border-radius: 0 0 var(--border-radius) var(--border-radius);
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: var(--transition);
        z-index: 100;
        max-height: 0;
        overflow: hidden;
      }

      /* Добавлено открытие по клику */
      .catalog-item.active .submenu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
        max-height: 500px;
        overflow-y: auto;
      }

      .catalog-item.active .catalog-link {
        background: rgba(255, 255, 255, 0.2);
      }

      .submenu-item {
      }

      .submenu-link {
        display: block;
        padding: 12px 20px;
        color: black !important;
        text-decoration: none;
        transition: var(--transition);
        font-size: 14px;
      }

      .submenu-link:hover {
        color: #00ab9a !important;
      }

      .submenu-link:hover {
        background: #f5f7fa;
        color: var(--primary-color);
      }

      .mobile-toggle {
        display: none;
        background: none;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
      }

      .catalog-menu {
        margin: 0 !important;
        padding: 0 !important;
      }

      @media (max-width: 992px) {
        .header-search {
          max-width: 300px;
        }

        .catalog-link {
          padding: 15px 12px;
          font-size: 14px;
        }
        
        .catalog-item.active .submenu {
          position: static;
          box-shadow: none;
          border-radius: 0;
        }
      }

      @media (max-width: 768px) {
        .search-toggle {
          content: "";

          background: no-repeat center
            url(/bitrix/components/bitrix/sale.basket.basket.line/templates/bootstrap_v4/images/lupa.svg);
          display: block;
          width: 40px;
          height: 40px;
          min-height: 40px;
          min-width: 40px;
          overflow: hidden;
          border-radius: 10px;
          border: 1px solid rgba(0, 0, 0, 0.325);
          margin: 0 !important;
          padding: 9px;
          display: flex;
          gap: 10px;
          z-index: 999;
        }

        .header-top-container,
        .header-main-container {
          flex-direction: column;
          gap: 15px;
        }

        .header-search {
          max-width: 100%;
          margin: 15px 0;
          display: flex;
          justify-content: end;
        }
        .search-form {
          max-width: 0px;
          opacity: 0;
        }
        .header_formob {
          display: flex;
          align-items: center;
          gap: 10px;
        }
        .search_srapper.active {
          display: flex;
          align-items: center;
          gap: 20px;
          width: 100vw;
          position: absolute;
          left: 0;
          right: 0;
          z-index: 99999999;
          background: #ffffff;
          padding: 10px 0;
          justify-content: center;
          display: flex;
          align-items: center;
          gap: 20px;
        }

        .header-phone {
          content: "";

          background: no-repeat center
            url(/bitrix/components/bitrix/sale.basket.basket.line/templates/bootstrap_v4/images/tel.svg);
          display: block;
          width: 40px;
          height: 40px;
          min-height: 40px;
          min-width: 40px;
          overflow: hidden;
          border-radius: 10px;
          border: 1px solid rgba(0, 0, 0, 0.325);
          margin: 0 !important;
          padding: 9px;
          display: flex;
          gap: 10px;
          z-index: 999;
        }
        .header-phone i,
        .header-phone span {
          display: none;
        }
        .logo {
          width: 80px;
        }
        .logo img {
          height: auto;
          width: 100%;
        }
        .search_srapper.active .header-search {
          justify-content: center;
          max-width: 300px;
        }
        .search_srapper.active .search-form {
          max-width: 500px;
          opacity: 1;
        }
        .input-group {
          flex-wrap: nowrap;
        }
        .search_srapper {
          display: flex;
          align-items: center;
        }
        .header-main {
        }
        .search_srapper.active .search-toggle {
          background: no-repeat center
            url(/bitrix/components/bitrix/sale.basket.basket.line/templates/bootstrap_v4/images/cross.svg);
        }

        .header-contact {
          flex-direction: column;
          gap: 10px;
          text-align: center;
        }

        .header-auth {
          justify-content: center;
        }

        .header-nav {
          display: none;
        }

        .mobile-toggle {
          display: block;
          position: absolute;
          top: 15px;
          right: 15px;
        }

        .header-main-container {
          padding-top: 40px;
        }
        
        .catalog-item.active .submenu {
          position: relative;
        }
      }
    </style>