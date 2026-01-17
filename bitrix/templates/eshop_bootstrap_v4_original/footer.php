<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
				</div><!--end .bx-content -->

				<!-- region Sidebar -->
				<?/*if (!$needSidebar):?>
					<div class="sidebar col-md-3 col-sm-4">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "sect",
								"AREA_FILE_SUFFIX" => "sidebar",
								"AREA_FILE_RECURSIVE" => "Y",
								"EDIT_MODE" => "html",
							),
							false,
							Array('HIDE_ICONS' => 'Y')
						);?>
					</div>
				<?endif*/?>
				<!--endregion -->

			</div><!--end row-->
			<?/*$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
					"AREA_FILE_SHOW" => "sect",
					"AREA_FILE_SUFFIX" => "bottom",
					"AREA_FILE_RECURSIVE" => "N",
					"EDIT_MODE" => "html",
				),
				false,
				Array('HIDE_ICONS' => 'Y')
			);*/?>
		</div><!--end .container.bx-content-section-->
	</div><!--end .workarea-->

	<footer class="bx-footer">
		<?/*<div class="bx-footer-section bx-footer-bg">
			<div class="container">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_DIR."include/socnet_footer.php",
						"AREA_FILE_RECURSIVE" => "N",
						"EDIT_MODE" => "html",
					),
					false,
					Array('HIDE_ICONS' => 'Y')
				);?>
			</div>
		</div>*/?>
		<div class="bx-footer-section py-5 bg-dark">
			<div class="container">
				<div class="row flex-sm-row-reverse flex-lg-row px-4 foooter-col-sm">
					<div class="col-sm-6 col-lg-3 order-lg-2 order-1 mb-4 mb-lg-0">
						<h4 class="bx-block-title color-primary mb-3">
							<? $APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."include/about_title.php"
								),
								false
							);?>
						</h4>
						<? $APPLICATION->IncludeComponent(
						"bitrix:menu", 
						"bottom_menu_custom", 
						[
							"ROOT_MENU_TYPE" => "bottom",
							"MAX_LEVEL" => "1",
							"MENU_CACHE_TYPE" => "A",
							"CACHE_SELECTED_ITEMS" => "N",
							"MENU_CACHE_TIME" => "36000000",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => [
							],
							"COMPONENT_TEMPLATE" => "bottom_menu_custom",
							"CHILD_MENU_TYPE" => "left",
							"USE_EXT" => "N",
							"DELAY" => "N",
							"ALLOW_MULTI_SELECT" => "N"
						],
						false
					);?>
					</div>
					<div class="col-sm-6 col-lg-3 order-lg-3 order-2 mb-4 mb-lg-0">
						<h4 class="bx-block-title color-primary mb-3">
							<? $APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."include/catalog_title.php"
								),
								false
							);?>
						</h4>
						<?$APPLICATION->IncludeComponent(
							"bitrix:menu", 
							"bottom_menu_catalog", 
							[
								"ROOT_MENU_TYPE" => "top",
								"MENU_CACHE_TYPE" => "N",
								"MENU_CACHE_TIME" => "36000000",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"MENU_CACHE_GET_VARS" => [
								],
								"CACHE_SELECTED_ITEMS" => "N",
								"MAX_LEVEL" => "2",
								"USE_EXT" => "Y",
								"DELAY" => "N",
								"ALLOW_MULTI_SELECT" => "N",
								"COMPONENT_TEMPLATE" => "bottom_menu_catalog",
								"CHILD_MENU_TYPE" => "left"
							],
							false
						);?>
					</div>
					<div class="col-sm-6 col-lg-3 order-lg-4 order-3">
						<? $APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR."include/pay.php"
							),
							false
						);?>

						<?/*
						<div style="padding: 20px;background:#eaeaeb">
							<? $APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."include/sender.php",
									"AREA_FILE_RECURSIVE" => "N",
									"EDIT_MODE" => "html",
								),
								false,
								array('HIDE_ICONS' => 'Y')
							);?>
						</div>
						<div id="bx-composite-banner" style="padding-top: 20px"></div>
						*/?>
					</div>
					<div class="col-sm-6 col-lg-3 order-lg-1 order-4 d-flex-xs flex-column-xs align-items-xs-center pt-4 pt-sm-0">
						<div class="mb-3">
							<a class="bx-footer-logo" href="<?=SITE_DIR?>">
								<? $APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									array(
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR."include/company_logo_mobile.php"
									),
								false
								);?>
							</a>
						</div>
						<div class="mb-2 d-flex align-items-center">
							<i class="contact-icon fas fa-phone"></i>
							<span class="bx-footer-phone-number">
								<? $APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"", array(
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR."include/telephone.php"
									),
									false
								);?>
							</span>
						</div>
						<div class="d-flex mb-2 text-white bx-footer-addres-block">
							<div><i class="contact-icon fas fa-map-marker-alt"></i></div>
							<div class="bx-footer-addres-number">
								<?$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									array(
										"AREA_FILE_SHOW" => "file",
										"PATH" => SITE_DIR."include/adress.php"
									),
									false
								);?>
							</div>
						</div>
						<div class="d-flex mb-3 text-white">
							<div><i class="contact-icon fas fa-clock"></i></div>
							<div>
								<? $APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."include/schedule.php"
								),
								false
								);?>
							</div>
						</div>
						<div class="mb-3 text-white">
							<? $APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."include/socnet_footer.php"
								),
								false
							);?>
						</div>

					</div>
				</div>
				<div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-start justify-content-sm-between mt-0 mt-sm-4 mb-5 mb-sm-0 px-4">
					<div style="color: #6c757d;">
						<? $APPLICATION->IncludeComponent("bitrix:main.include", "", array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR."include/copyright.php"
						), false);?>
					</div>
					<div class="politics-href">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" style="fill: #6c757d;"><path data-name="Rounded Rectangle 801 copy 5" class="cls-1" d="M449,140v6a3,3,0,0,1-3,3h-8a3,3,0,0,1-3-3v-2h0v-2h3v-6a3,3,0,0,1,3-3h9a3,3,0,0,1,3,3v4h-4Zm-12,4v2a1,1,0,0,0,1,1h5.184a2.96,2.96,0,0,1-.184-1v-2h-6Zm10,0v-9h-6a1,1,0,0,0-1,1v6h5v4a1,1,0,0,0,2,0v-2Zm4-8a1,1,0,0,0-1-1h0a1,1,0,0,0-1,1v2h2v-2Z" transform="translate(-435 -133)"></path></svg>
						<? $APPLICATION->IncludeComponent("bitrix:main.include", "", array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => SITE_DIR."include/politics.php"
						), false);?>
					</div>
				</div>
			</div>
		</div>
		<!--div class="bx-footer-section py-2 bg-secondary">
				<div class="container">
					<div class="row">
						<div class="col-sm-6 bx-up">
							<a href="javascript:void(0)" data-role="eshopUpButton" class="text-white"><i class="fa fa-caret-up"></i> <?=GetMessage("FOOTER_UP_BUTTON")?></a>
						</div>
						<div class="col-sm-6 text-white text-right">
							<? $APPLICATION->IncludeComponent("bitrix:main.include", "", array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR."include/copyright.php"
							), false);?>
						</div>
					</div>
				</div>
			</div-->
	</footer>
	<div class="col d-sm-none bg-secondary">
		<?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "custom-top", array(
				"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
				"PATH_TO_PERSONAL" => SITE_DIR."personal/",
				"SHOW_PERSONAL_LINK" => "N",
				"SHOW_NUM_PRODUCTS" => "Y",
				"SHOW_TOTAL_PRICE" => "Y",
				"SHOW_PRODUCTS" => "N",
				"POSITION_FIXED" =>"Y",
				"POSITION_HORIZONTAL" => "center",
				"POSITION_VERTICAL" => "bottom",
				"SHOW_AUTHOR" => "Y",
				"PATH_TO_REGISTER" => SITE_DIR."login/",
				"PATH_TO_PROFILE" => SITE_DIR."personal/"
			),
			false,
			array()
		);?>
	</div>
</div> <!-- //bx-wrapper -->


<script>
	BX.ready(function(){
		var upButton = document.querySelector('[data-role="eshopUpButton"]');
		BX.bind(upButton, "click", function(){
			var windowScroll = BX.GetWindowScrollPos();
			(new BX.easing({
				duration : 500,
				start : { scroll : windowScroll.scrollTop },
				finish : { scroll : 0 },
				transition : BX.easing.makeEaseOut(BX.easing.transitions.quart),
				step : function(state){
					window.scrollTo(0, state.scroll);
				},
				complete: function() {
				}
			})).animate();
		})
	});
</script>

<script type="text/javascript" src="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.9.0/slick/slick.min.js"></script>

</body>
</html>

<button id="btnUp" class=" btn btn-up">
		<!--svg width="38" height="38" viewBox="0 0 44 44" xmlns="http://www.w3.org/2000/svg">
    <g fill="#fff">
      <ellipse cx="22" cy="31" rx="13" ry="9"/>
      <ellipse cx="9.5" cy="17" rx="5" ry="7"/>
      <ellipse cx="22" cy="12" rx="5" ry="8"/>
      <ellipse cx="34.5" cy="17" rx="5" ry="7"/>
    </g>
  </svg-->
</button>
<script>
  const btnUp = document.getElementById('btnUp');
  function toggleBtnUp() {
    const isWide = window.innerWidth >= 768;
    const isScroll = window.scrollY > 400;
    btnUp.style.display = isWide && isScroll ? 'block' : 'none';
  }
  window.addEventListener('scroll', toggleBtnUp);
  window.addEventListener('resize', toggleBtnUp);
  // Чтобы сразу корректно отобразился при загрузке страницы
  toggleBtnUp();
  btnUp.addEventListener('click', () => {
    window.scrollTo({top: 0, behavior: 'smooth'});
  });
</script>