<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
CJSCore::Init(array("fx"));

\Bitrix\Main\UI\Extension::load(["ui.bootstrap4", "ui.fonts.opensans"]);

if (isset($_GET["theme"]) && in_array($_GET["theme"], array("blue", "green", "yellow", "red")))
{
	COption::SetOptionString("main", "wizard_eshop_bootstrap_theme_id", $_GET["theme"], false, SITE_ID);
}
$theme = COption::GetOptionString("main", "wizard_eshop_bootstrap_theme_id", "green", SITE_ID);

$curPage = $APPLICATION->GetCurPage(true);

?><!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
	<title><?$APPLICATION->ShowTitle()?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>favicon.ico" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
	<!-- Добавляем стили из CDN -->
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.9.0/slick/slick.css"/>
	<!-- Добавляем тему по умолчанию из CDN -->
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/gh/kenwheeler/slick@1.9.0/slick/slick-theme.css"/>
	<? $APPLICATION->ShowHead(); ?>
</head>
<body class="bx-background-image bx-theme-<?=$theme?>" <?$APPLICATION->ShowProperty("backgroundImage");?>>
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
<?$APPLICATION->IncludeComponent(
	"bitrix:eshop.banner",
	"",
	array()
);?>
<div class="bx-wrapper" id="bx_eshop_wrap">
	<header class="bx-header">
		<div class="bx-header-section container">
			<!--region bx-header-->
			<div class="row pt-0 pt-md-3 mt-0 mb-3 align-items-center justify-content-between bg-md" style="position: relative;">

				<!-- <div class="d-block d-md-none bx-menu-button-mobile" data-role='bx-menu-button-mobile-position'></div> -->

				<div class="col-auto col-lg-3 d-block d-lg-none">
					<?$APPLICATION->IncludeComponent(
						"bitrix:menu",
						"swipe-mobile",
						Array(
							"ALLOW_MULTI_SELECT" => "N",
							"CHILD_MENU_TYPE" => "left",
							"DELAY" => "N",
							"MAX_LEVEL" => "1",
							"MENU_CACHE_GET_VARS" => [0=>"",],
							"MENU_CACHE_TIME" => "3600",
							"MENU_CACHE_TYPE" => "A",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_THEME" => "site",
							"ROOT_MENU_TYPE" => "mobile",
							"USE_EXT" => "Y"
						)
					);?>
				</div>
				
				<div class="col-auto bx-header-logo">
					<a class="bx-logo-block d-none d-md-block" href="<?=SITE_DIR?>">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR."include/company_logo.php"),
							false
						);?>
					</a>
					<a class="bx-logo-block d-block d-md-none text-center" href="<?=SITE_DIR?>">
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							array(
								"AREA_FILE_SHOW" => "file",
								"PATH" => SITE_DIR."include/company_logo.php"
							),
							false
						);?>
					</a>
				</div>

				<div class="col-auto bx-header-personal">
					<div class="row align-items-center">
						<div class="col-auto сol-lg-2 col-md-auto">
							 <?$APPLICATION->IncludeComponent(
	"bitrix:search.form", 
	"top-search", 
	[
		"COMPONENT_TEMPLATE" => "top-search",
		"PAGE" => "#SITE_DIR#search/index.php",
		"USE_SUGGEST" => "Y"
	],
	false
);?>
						</div>
						<div class="col-auto p-0 d-none d-md-block">
							<?$APPLICATION->IncludeComponent(
							"bitrix:sale.basket.basket.line", 
							"custom-top", 
							[
								"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
								"PATH_TO_PERSONAL" => SITE_DIR."personal/",
								"SHOW_PERSONAL_LINK" => "N",
								"SHOW_NUM_PRODUCTS" => "Y",
								"SHOW_TOTAL_PRICE" => "Y",
								"SHOW_PRODUCTS" => "Y",
								"POSITION_FIXED" => "N",
								"SHOW_AUTHOR" => "Y",
								"PATH_TO_REGISTER" => SITE_DIR."login/",
								"PATH_TO_PROFILE" => SITE_DIR."personal/",
								"COMPONENT_TEMPLATE" => "custom-top",
								"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
								"SHOW_EMPTY_VALUES" => "Y",
								"PATH_TO_AUTHORIZE" => "",
								"SHOW_REGISTRATION" => "Y",
								"HIDE_ON_BASKET_PAGES" => "Y",
								"SHOW_DELAY" => "Y",
								"SHOW_NOTAVAIL" => "Y",
								"SHOW_IMAGE" => "Y",
								"SHOW_PRICE" => "Y",
								"SHOW_SUMMARY" => "Y",
								"MAX_IMAGE_SIZE" => "70"
							],
							false
						);?>
						</div>
						<div class="col-auto сol-lg-2 p-1 d-block d-md-none">
							 <?$APPLICATION->IncludeComponent(
								"bitrix:sale.basket.basket.line",
								"custom-top",
								Array(
									"HIDE_ON_BASKET_PAGES" => "Y",
									"PATH_TO_AUTHORIZE" => "",
									"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
									"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
									"PATH_TO_PERSONAL" => SITE_DIR."personal/",
									"PATH_TO_PROFILE" => SITE_DIR."personal/",
									"PATH_TO_REGISTER" => SITE_DIR."login/",
									"POSITION_FIXED" => "N",
									"SHOW_AUTHOR" => "N",
									"SHOW_EMPTY_VALUES" => "Y",
									"SHOW_NUM_PRODUCTS" => "Y",
									"SHOW_PERSONAL_LINK" => "N",
									"SHOW_PRODUCTS" => "N",
									"SHOW_REGISTRATION" => "N",
									"SHOW_TOTAL_PRICE" => "Y"
								)
							);?>
						</div>
					</div>
				</div>

				<div class="col d-none d-md-block bx-header-contact">
					<div class="d-flex align-items-center justify-content-around justify-content-md-around flex-column flex-sm-row flex-md-column flex-lg-row">
						<div class="p-lg-1 p-1">
							<div class="bx-header-phone-block pb-1">
								<i class="contact-icon fas fa-phone"></i>
								<span class="bx-header-phone-number">
									<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										array(
											"AREA_FILE_SHOW" => "file",
											"PATH" => SITE_DIR."include/telephone.php"
										),
										false
									);?>
								</span>
							</div>
							<div class="d-flex bx-header-addres-block">
								<div><i class="contact-icon fas fa-map-marker-alt"></i></div>
								<div class="bx-header-addres-number">
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
						</div>
						<div class="p-lg-1 p-1 d-none d-lg-block">
							<div class="bx-header-worktime">
								<div class="bx-worktime-title"><?=GetMessage('HEADER_WORK_TIME'); ?></div>
								<div class="bx-worktime-schedule">
									<?$APPLICATION->IncludeComponent(
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
						</div>
						<div class="p-lg-1 p-1 d-none d-lg-block">
						  <?$APPLICATION->IncludeComponent(
							"bitrix:menu",
							"additional-menu-top",
							Array(
								"ALLOW_MULTI_SELECT" => "N",
								"CHILD_MENU_TYPE" => "left",
								"COMPONENT_TEMPLATE" => "bootstrap_v4",
								"DELAY" => "N",
								"MAX_LEVEL" => "2",
								"MENU_CACHE_GET_VARS" => "",
								"MENU_CACHE_TIME" => "3600",
								"MENU_CACHE_TYPE" => "A",
								"MENU_CACHE_USE_GROUPS" => "Y",
								"MENU_THEME" => "site",
								"ROOT_MENU_TYPE" => "top",
								"USE_EXT" => "N"
							)
						);?> 
						</div>
					</div>
				</div>


			</div>
			<!--endregion-->


			<!--region menu-->
			<div class="row mb-4 d-none d-md-block">
				<div class="col p-0">
					<?$APPLICATION->IncludeComponent(
					"bitrix:menu", 
					"custom-menu-top", 
					[
						"ROOT_MENU_TYPE" => "top",
						"MENU_CACHE_TYPE" => "A",
						"MENU_CACHE_TIME" => "36000000",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_THEME" => "site",
						"CACHE_SELECTED_ITEMS" => "N",
						"MENU_CACHE_GET_VARS" => [
						],
						"MAX_LEVEL" => "3",
						"CHILD_MENU_TYPE" => "left",
						"USE_EXT" => "Y",
						"DELAY" => "N",
						"ALLOW_MULTI_SELECT" => "N",
						"COMPONENT_TEMPLATE" => "custom-menu-top"
					],
					false
				);?>
				</div>
			</div>
			<!--endregion-->

			
			<!--region search.title -->
			<?/*php
			if ($curPage != SITE_DIR."index.php"):
				if (\Bitrix\Main\ModuleManager::isModuleInstalled('search')):
				?>
				<div class="row mb-4">
					<div class="col">
						<?$APPLICATION->IncludeComponent(
							"bitrix:search.title",
							"bootstrap_v4",
							array(
								"NUM_CATEGORIES" => "1",
								"TOP_COUNT" => "5",
								"CHECK_DATES" => "N",
								"SHOW_OTHERS" => "N",
								"PAGE" => SITE_DIR."catalog/",
								"CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS") ,
								"CATEGORY_0" => array(
									0 => "iblock_catalog",
								),
								"CATEGORY_0_iblock_catalog" => array(
									0 => "all",
								),
								"CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
								"SHOW_INPUT" => "Y",
								"INPUT_ID" => "title-search-input",
								"CONTAINER_ID" => "search",
								"PRICE_CODE" => array(
									0 => "BASE",
								),
								"SHOW_PREVIEW" => "Y",
								"PREVIEW_WIDTH" => "75",
								"PREVIEW_HEIGHT" => "75",
								"CONVERT_CURRENCY" => "Y"
							),
							false
						);?>
					</div>
				</div>
			<?php
				endif;
			endif;*/
			?>
			<!--endregion-->

			<!--region breadcrumb-->
			<?if ($curPage != SITE_DIR."index.php"):?>
				<div class="row mb-4">
					<div class="col" id="navigation">
						<?$APPLICATION->IncludeComponent(
							"bitrix:breadcrumb",
							"custom-breadcrumb",
							array(
								"START_FROM" => "0",
								"PATH" => "",
								"SITE_ID" => "-"
							),
							false,
							Array('HIDE_ICONS' => 'Y')
						);?>
					</div>
				</div>
				<h1 id="pagetitle"><?$APPLICATION->ShowTitle(false);?></h1>
			<?endif?>
			<!--endregion-->
		</div>
	</header>

			<div style="background: #ffeb3b; padding: 15px; text-align: center; margin: 20px 0; border: 2px solid #ffc107; border-radius: 5px;">
				<h2 style="margin: 0; color: #333;">🚧 Сайт находится в разработке</h2>
				<p style="margin: 10px 0 0 0; color: #666;">
					Приносим извинения за временные неудобства. Мы работаем над улучшением сайта.
				</p>
			</div>

	<div class="workarea">
		<div class="container bx-content-section">
			<div class="row">
			<?$needSidebar = preg_match("~^".SITE_DIR."(catalog|personal\/cart|personal\/order\/make)/~", $curPage);?>
				<div class="bx-content <?=($needSidebar ? "col" : "col-md-12 col-sm-12")?>">
					