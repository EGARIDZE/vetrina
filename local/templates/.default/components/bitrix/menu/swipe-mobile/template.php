<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
if (!empty($arResult)): ?>
<div class="menu-swipe-container" id="mainMenu">
    <!-- Бургер-кнопка без изменений -->
    <div class="menu-swipe-btn" onclick="BX.toggleClass(BX('mainMenu'), ['opened', 'closed'])">
        <svg width="23" height="19" viewBox="0 0 23 19" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect rx="1" fill="#121212" width="23" height="2"/>
            <rect rx="1" fill="#121212" width="23" height="2" y="8"/>
            <rect rx="1" fill="#121212" width="23" height="2" y="16"/>
        </svg>
    </div>
    <!-- Overlay-слой -->
    <div class="menu-swipe-overlay" onclick="BX.removeClass(BX('mainMenu'), 'opened')"></div>
    <div class="menu-swipe-items-container">
        <div class="menu-swipe-items-scroll-block">
            <?$APPLICATION->IncludeComponent(
                "bitrix:catalog.section.list",
                "store_v3_menu",
                Array(
                    "ADD_SECTIONS_CHAIN" => "Y",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "N",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "COUNT_ELEMENTS" => "N",
                    "COUNT_ELEMENTS_FILTER" => "CNT_AVAILABLE",
                    "FILTER_NAME" => "sectionsFilter",
                    "HIDE_SECTION_NAME" => "N",
                    "IBLOCK_ID" => "5",
                    "IBLOCK_TYPE" => "catalog",
                    "SECTION_CODE" => "",
                    "SECTION_FIELDS" => array("",""),
                    "SECTION_ID" => $_REQUEST["SECTION_ID"],
                    "SECTION_URL" => "",
                    "SECTION_USER_FIELDS" => array("",""),
                    "SHOW_PARENT_NAME" => "Y",
                    "SHOW_TITLE" => "Y",
                    "TOP_DEPTH" => "2",
                    "VIEW_MODE" => "TILE"
                )
            );?>
            <ul class="nav flex-column menu-swipe-items">
                <?php foreach ($arResult as $item): ?>
                    <?php if ($arParams['MAX_LEVEL'] === 1 && $item['DEPTH_LEVEL'] > 1) continue; ?>
                    <li class="nav-item menu-swipe-item<?=($item['SELECTED'] ? ' active selected' : '')?>">
                        <a href="<?=$item['LINK']?>" class="nav-link menu-swipe-item-link d-flex justify-content-between align-items-center">
                            <span class="menu-swipe-item-text"><?=$item['TEXT']?></span>
                            <span class="menu-swipe-item-angle"></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
			
			<hr class="bg-primary-vetrina mx-3" style="height:1px;">

			<div class="">
				<div class="d-flex justify-content-center col-12 p-lg-3 p-1">
					<div class="bx-header-phone-block">
						<i class="contact-icon fas fa-phone m-0"></i>
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
				</div>
				<div class="d-flex justify-content-center col-12 p-lg-3 p-1"> 
					<div class="bx-header-phone-block" style="gap: 10px;">
						<i class="contact-icon fas fa-map-marker-alt m-0" style="font-size: initial; min-width: initial;"></i>
						<div class="bx-worktime-schedule">					
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
				<div class="d-flex justify-content-center col-12 p-lg-3 p-1 pt-2">
					<div class="d-flex bx-header-worktime text-center" style="gap: 10px;">
						<i class="contact-icon fas fa-clock m-0" style="font-size: initial; min-width: initial;"></i>
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
				<a class="d-flex bx-logo-block text-center pt-3" href="<?=SITE_DIR?>">
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
        </div>
        <button type="button" class="close menu-swipe-close-btn" onclick="BX.removeClass(BX('mainMenu'), 'opened')" aria-label="Закрыть">
            <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.9165 1.60282L11.3137 0L6.25966 5.05407L1.60282 0.39723L0 2.00005L4.65684 6.65689L2.11e-05 11.3137L1.60284 12.9165L6.25966 8.2597L11.3137 13.3138L12.9165 11.7109L7.86247 6.65689L12.9165 1.60282Z" fill="#fff"/>
            </svg>
        </button>
    </div>
</div>
<?php endif; ?>
