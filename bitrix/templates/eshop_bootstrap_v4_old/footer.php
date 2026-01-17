
	<footer class="bx-footer">
		<div class="bx-footer-section py-5 bg-dark">
			<div class="container">
				<div class="row  justify-content-between">
					<div class="col-sm-6 col-lg-3 order-lg-2 order-1 mb-4 mb-lg-0">
						<h4 class="bx-block-title text-light">
							<? $APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR . "include/about_title.php"
								)
							); ?>
						</h4>
						<? $APPLICATION->IncludeComponent(
							"bitrix:menu",
							"bottom_menu",
							array(
								"CACHE_SELECTED_ITEMS" => "N",
								"MAX_LEVEL" => "1",
								"MENU_CACHE_GET_VARS" => array(),
								"MENU_CACHE_TIME" => "36000000",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"ROOT_MENU_TYPE" => "bottom"
							)
						); ?>
					</div>
					
					<div class="col-sm-6 col-lg-3 order-lg-4 order-3">
						<!-- Соцсети -->
						<h4 class="bx-block-title text-light">Мы в соцсетях</h4>
						<div class="social-icons mb-4">
							<a href="https://www.instagram.com/vetrina_minsk" target="_blank" class="social-icon">
								<img src="https://cdn-icons-png.flaticon.com/512/15707/15707749.png" alt="">
							</a>
							<a href="https://www.tiktok.com/@vetrina_minsk" target="_blank" class="social-icon">
								<img src="https://cdn-icons-png.flaticon.com/512/3670/3670313.png" alt="">
							</a>
							<a href="https://t.me/vetrina_minsk" target="_blank" class="social-icon">
								<img src="https://cdn-icons-png.flaticon.com/512/2111/2111646.png" alt="">
							</a>
						</div>
						<!-- 
						<h4 class="bx-block-title text-light">Способы оплаты</h4>
						<div class="payment-methods">
							<div class="payment-icon">
								<i class="fa fa-cc-visa"></i>
							</div>
							<div class="payment-icon">
								<i class="fa fa-cc-mastercard"></i>
							</div>
							<div class="payment-icon">
								<i class="fa fa-cc-amex"></i>
							</div>
							<div class="payment-icon">
								<i class="fa fa-cc-paypal"></i>
							</div>
						</div> -->
					</div>
					<div class="col-sm-6 col-lg-3 order-lg-1 order-4">
						<div class="mb-3">
							<a class="bx-footer-logo" href="<?= SITE_DIR ?>"> <? $APPLICATION->IncludeComponent(
							  	"bitrix:main.include",
							  	"",
							  	array(
							  		"AREA_FILE_SHOW" => "file",
							  		"PATH" => SITE_DIR . "include/company_logo_mobile.php"
							  	)
							  ); ?> </a>
						</div>
						<a href="tel:+375296303043" class="header-phone white color-white">
							<i class="bx-header-phone-icon sidebar-icon-phone"></i>
							<span>+375 29 630 30 43</span>
						</a>
						<div class="mb-3  align-items-center">
							<span class="text-white">Минск, И. Лученка 2</span>
						</div>

						<div class="mb-3 text-white">
							<? $APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR . "include/schedule.php"
								)
							); ?>
						</div>
						<div class="mb-3 text-white">
							<? $APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR . "include/personal.php"
								)
							); ?>
						</div>
						<div class="mb-3  align-items-center">
							<a href="mailto:vetrina.minskworld@gmail.com"
								class="text-white">vetrina.minskworld@gmail.com</a>

							<div class="col-sm-6 text-white ">
								<? $APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									array(
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR . "include/copyright.php"
									)
								); ?>
								<a href="/policy/" class="text-white">Политика конфиденциальности</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</footer>
</div>
<style>
	/* Стили для футера */
	.bx-footer {
		font-family: 'Arial', sans-serif;
	}

	.bx-block-title {
		font-size: 18px;
		font-weight: 600;
		margin-bottom: 20px;
		position: relative;
		padding-bottom: 10px;
	}

	.bx-block-title:after {
		content: '';
		position: absolute;
		bottom: 0;
		left: 0;
		width: 40px;
		height: 2px;
		background-color: #fff;
	}

	/* Стили для иконок соцсетей */
	.social-icons {
		display: flex;
		gap: 15px;
	}

	.social-icon img {
		width: 100%;


	}

	.social-icon {
		display: flex;
		align-items: center;
		justify-content: center;
		width: 40px;
		height: 40px;
		background-color: rgba(255, 255, 255, 0.1);
		border-radius: 50%;
		color: #fff;
		text-decoration: none;
		transition: all 0.3s ease;
	}

	.social-icon:hover {
		background-color: #fff;
		color: #343a40;
		transform: translateY(-3px);
	}

	.social-icon i {
		font-size: 18px;
	}

	/* Стили для способов оплаты */
	.payment-methods {
		display: flex;
		flex-wrap: wrap;
		gap: 10px;
		margin-top: 10px;
	}

	.payment-icon {
		display: flex;
		align-items: center;
		justify-content: center;
		width: 45px;
		height: 30px;
		background-color: rgba(255, 255, 255, 0.9);
		border-radius: 4px;
		color: #343a40;
	}

	.payment-icon i {
		font-size: 24px;
	}

	/* Стили для контактной информации */
	.bx-footer-logo {
		display: inline-block;
		margin-bottom: 20px;
	}

	.bx-footer a.text-white:hover {
		color: #f8f9fa !important;
		text-decoration: underline;
	}

	/* Адаптивность */
	@media (max-width: 768px) {
		.bx-footer-section .row>div {
			margin-bottom: 25px;
		}

		.social-icons,
		.payment-methods {
			justify-content: center;
		}

		.bx-block-title {
			text-align: center;
		}

		.bx-block-title:after {
			left: 50%;
			transform: translateX(-50%);
		}
	}
</style>
<script>
	BX.ready(function () {
		var upButton = document.querySelector('[data-role="eshopUpButton"]');
		BX.bind(upButton, "click", function () {
			var windowScroll = BX.GetWindowScrollPos();
			(new BX.easing({ duration: 500, start: { scroll: windowScroll.scrollTop }, finish: { scroll: 0 }, transition: BX.easing.makeEaseOut(BX.easing.transitions.quart), step: function (state) { window.scrollTo(0, state.scroll); }, complete: function () { } })).animate();
		})
	}); 
</script>