<?
// template.php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\UI\Extension::load(["ui.fonts.ruble", "ui.fonts.opensans"]);

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 * @var string $templateName
 * @var CMain $APPLICATION
 * @var CBitrixBasketComponent $component
 * @var CBitrixComponentTemplate $this
 * @var array $giftParameters
 */

if (!isset($arParams['DISPLAY_MODE']) || !in_array($arParams['DISPLAY_MODE'], array('extended', 'compact'))) {
	$arParams['DISPLAY_MODE'] = 'extended';
}

$arParams['USE_DYNAMIC_SCROLL'] = isset($arParams['USE_DYNAMIC_SCROLL']) && $arParams['USE_DYNAMIC_SCROLL'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_FILTER'] = isset($arParams['SHOW_FILTER']) && $arParams['SHOW_FILTER'] === 'N' ? 'N' : 'Y';

$arParams['PRICE_DISPLAY_MODE'] = isset($arParams['PRICE_DISPLAY_MODE']) && $arParams['PRICE_DISPLAY_MODE'] === 'N' ? 'N' : 'Y';

if (!isset($arParams['TOTAL_BLOCK_DISPLAY']) || !is_array($arParams['TOTAL_BLOCK_DISPLAY'])) {
	$arParams['TOTAL_BLOCK_DISPLAY'] = array('top');
}

if (empty($arParams['PRODUCT_BLOCKS_ORDER'])) {
	$arParams['PRODUCT_BLOCKS_ORDER'] = 'props,sku,columns';
}

if (is_string($arParams['PRODUCT_BLOCKS_ORDER'])) {
	$arParams['PRODUCT_BLOCKS_ORDER'] = explode(',', $arParams['PRODUCT_BLOCKS_ORDER']);
}

$arParams['USE_PRICE_ANIMATION'] = isset($arParams['USE_PRICE_ANIMATION']) && $arParams['USE_PRICE_ANIMATION'] === 'N' ? 'N' : 'Y';
$arParams['EMPTY_BASKET_HINT_PATH'] = isset($arParams['EMPTY_BASKET_HINT_PATH']) ? (string) $arParams['EMPTY_BASKET_HINT_PATH'] : '/';
$arParams['USE_ENHANCED_ECOMMERCE'] = isset($arParams['USE_ENHANCED_ECOMMERCE']) && $arParams['USE_ENHANCED_ECOMMERCE'] === 'Y' ? 'Y' : 'N';
$arParams['DATA_LAYER_NAME'] = isset($arParams['DATA_LAYER_NAME']) ? trim($arParams['DATA_LAYER_NAME']) : 'dataLayer';
$arParams['BRAND_PROPERTY'] = isset($arParams['BRAND_PROPERTY']) ? trim($arParams['BRAND_PROPERTY']) : '';

if ($arParams['USE_GIFTS'] === 'Y') {
	$arParams['GIFTS_BLOCK_TITLE'] = isset($arParams['GIFTS_BLOCK_TITLE']) ? trim((string) $arParams['GIFTS_BLOCK_TITLE']) : Loc::getMessage('SBB_GIFTS_BLOCK_TITLE');

	CBitrixComponent::includeComponentClass('bitrix:sale.products.gift.basket');

	$giftParameters = array(
		'SHOW_PRICE_COUNT' => 1,
		'PRODUCT_SUBSCRIPTION' => 'N',
		'PRODUCT_ID_VARIABLE' => 'id',
		'USE_PRODUCT_QUANTITY' => 'N',
		'ACTION_VARIABLE' => 'actionGift',
		'ADD_PROPERTIES_TO_BASKET' => 'Y',
		'PARTIAL_PRODUCT_PROPERTIES' => 'Y',

		'BASKET_URL' => $APPLICATION->GetCurPage(),
		'APPLIED_DISCOUNT_LIST' => $arResult['APPLIED_DISCOUNT_LIST'],
		'FULL_DISCOUNT_LIST' => $arResult['FULL_DISCOUNT_LIST'],

		'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
		'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_SHOW_VALUE'],
		'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],

		'BLOCK_TITLE' => $arParams['GIFTS_BLOCK_TITLE'] ?? '',
		'HIDE_BLOCK_TITLE' => $arParams['GIFTS_HIDE_BLOCK_TITLE'] ?? '',
		'TEXT_LABEL_GIFT' => $arParams['GIFTS_TEXT_LABEL_GIFT'] ?? '',

		'DETAIL_URL' => $arParams['GIFTS_DETAIL_URL'] ?? null,
		'PRODUCT_QUANTITY_VARIABLE' => $arParams['GIFTS_PRODUCT_QUANTITY_VARIABLE'] ?? '',
		'PRODUCT_PROPS_VARIABLE' => $arParams['GIFTS_PRODUCT_PROPS_VARIABLE'] ?? '',
		'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'] ?? '',
		'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'] ?? '',
		'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'] ?? '',
		'MESS_BTN_BUY' => $arParams['GIFTS_MESS_BTN_BUY'] ?? '',
		'MESS_BTN_DETAIL' => $arParams['GIFTS_MESS_BTN_DETAIL'] ?? '',
		'CONVERT_CURRENCY' => $arParams['GIFTS_CONVERT_CURRENCY'] ?? '',
		'HIDE_NOT_AVAILABLE' => $arParams['GIFTS_HIDE_NOT_AVAILABLE'] ?? '',

		'PRODUCT_ROW_VARIANTS' => '',
		'PAGE_ELEMENT_COUNT' => 0,
		'DEFERRED_PRODUCT_ROW_VARIANTS' => \Bitrix\Main\Web\Json::encode(
			SaleProductsGiftBasketComponent::predictRowVariants(
				$arParams['GIFTS_PAGE_ELEMENT_COUNT'],
				$arParams['GIFTS_PAGE_ELEMENT_COUNT']
			)
		),
		'DEFERRED_PAGE_ELEMENT_COUNT' => $arParams['GIFTS_PAGE_ELEMENT_COUNT'],

		'ADD_TO_BASKET_ACTION' => 'BUY',
		'PRODUCT_DISPLAY_MODE' => 'Y',
		'PRODUCT_BLOCKS_ORDER' => isset($arParams['GIFTS_PRODUCT_BLOCKS_ORDER']) ? $arParams['GIFTS_PRODUCT_BLOCKS_ORDER'] : '',
		'SHOW_SLIDER' => isset($arParams['GIFTS_SHOW_SLIDER']) ? $arParams['GIFTS_SHOW_SLIDER'] : '',
		'SLIDER_INTERVAL' => isset($arParams['GIFTS_SLIDER_INTERVAL']) ? $arParams['GIFTS_SLIDER_INTERVAL'] : '',
		'SLIDER_PROGRESS' => isset($arParams['GIFTS_SLIDER_PROGRESS']) ? $arParams['GIFTS_SLIDER_PROGRESS'] : '',
		'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],

		'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
		'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
		'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY']
	);
}

\CJSCore::Init(array('fx', 'popup', 'ajax'));
Main\UI\Extension::load(['ui.mustache']);

//$this->addExternalCss($templateFolder.'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css');

$this->addExternalJs($templateFolder . '/js/action-pool.js');
$this->addExternalJs($templateFolder . '/js/filter.js');
$this->addExternalJs($templateFolder . '/js/component.js');

$mobileColumns = isset($arParams['COLUMNS_LIST_MOBILE'])
	? $arParams['COLUMNS_LIST_MOBILE']
	: $arParams['COLUMNS_LIST'];
$mobileColumns = array_fill_keys($mobileColumns, true);

$jsTemplates = new Main\IO\Directory(Main\Application::getDocumentRoot() . $templateFolder . '/js-templates');
/** @var Main\IO\File $jsTemplate */
foreach ($jsTemplates->getChildren() as $jsTemplate) {
	include($jsTemplate->getPath());
}

$displayModeClass = $arParams['DISPLAY_MODE'] === 'compact' ? ' basket-items-list-wrapper-compact' : '';

if (empty($arResult['ERROR_MESSAGE'])) {
	if ($arParams['USE_GIFTS'] === 'Y' && $arParams['GIFTS_PLACE'] === 'TOP') {
		?>
		<div data-entity="parent-container">
			<div class="catalog-block-header" data-entity="header" data-showed="false" style="display: none; opacity: 0;">
				<?= $arParams['GIFTS_BLOCK_TITLE'] ?>
			</div>
			<?
			$APPLICATION->IncludeComponent(
				'bitrix:sale.products.gift.basket',
				'bootstrap_v4',
				$giftParameters,
				$component
			);
			?>
		</div>
	<?
	}

	if ($arResult['BASKET_ITEM_MAX_COUNT_EXCEEDED']) {
		?>
		<div id="basket-item-message">
			<?= Loc::getMessage('SBB_BASKET_ITEM_MAX_COUNT_EXCEEDED', array('#PATH#' => $arParams['PATH_TO_BASKET'])) ?>
		</div>
	<?
	}
	?>
	<div id="basket-root" class="bx-basket bx-<?= $arParams['TEMPLATE_THEME'] ?> bx-step-opacity" style="opacity: 0;">
		<? if (!empty($arResult['WARNING_MESSAGE_WITH_CODE'])) { ?>
			<div class="row">
				<div class="col">
					<div class="alert alert-warning alert-dismissable" id="basket-warning">
						<span class="close" data-entity="basket-items-warning-notification-close">&times;</span>
						<div data-entity="basket-general-warnings"></div>
						<div data-entity="basket-item-warnings">
							<?= Loc::getMessage('SBB_BASKET_ITEM_WARNING') ?>
						</div>
					</div>
				</div>
			</div>
		<? } ?>

		<div class="cart__container">
			<div class="cart__main">
				<h1 class="h1"><?= Loc::getMessage('SBB_TITLE') ?></h1>

				<div class="basket-items-list-wrapper" id="basket-items-list-wrapper">
					<div class="basket-items-list-container" id="basket-items-list-container">
						<div class="basket-items-list-overlay" id="basket-items-list-overlay" style="display: none;"></div>
						<div class="basket-items-list" id="basket-item-list">

							<!-- NEW: Блок "Выбрать все" для мобильных устройств -->
							<div class="cart-select-all--mobile">
								<div class="cart-goods-item-checkbox">
									<label class="checkbox black">
										<!-- Важно: data-entity такой же, как и у десктопной версии -->
										<input class="checkbox__input" type="checkbox" data-entity="basket-select-all-items" checked="checked">
										<span class="checkbox__mock"></span>
									</label>
								</div>
								<div class="cart-goods-item-description">
									<p class="p2 gray bold"><?= Loc::getMessage('SBB_SELECT_ALL') ?></p>
								</div>
							</div>

							<!-- UPDATED: Добавлен класс cart-goods__header--desktop -->
							<div class="cart-goods__header cart-goods__header--desktop">
								<!-- Колонка 1: Чекбокс -->
								<div class="cart-goods-item-checkbox">
									<label class="checkbox black">
										<input class="checkbox__input" type="checkbox" data-entity="basket-select-all-items" checked="checked">
										<span class="checkbox__mock"></span>
									</label>
								</div>
								<!-- Колонка 2: Заголовок "Выбрать все" -->
								<div class="cart-goods-item-description">
									<p class="p2 gray"><?= Loc::getMessage('SBB_SELECT_ALL') ?></p>
								</div>
								<!-- Колонка 3: Заголовок "Цена" -->
								<div class="cart-goods-item__price">
									<p class="p2 gray"><?= Loc::getMessage('SBB_PRICE') ?></p>
								</div>
								<!-- Колонка 4: Заголовок "Количество" -->
								<div class="cart-goods-item__quantity">
									<p class="p2 gray"><?= Loc::getMessage('SBB_QUANTITY') ?></p>
								</div>
								<!-- Колонка 5: Заголовок "Сумма" -->
								<div class="cart-goods-item__sum">
									<p class="p2 gray"><?= Loc::getMessage('SBB_SUM') ?></p>
								</div>
								<!-- Колонка 6: Пустое место для кнопки удаления -->
								<div class="cart-goods-item-buttons"></div>
							</div>

							<div class="cart-goods" id="basket-item-table"></div>
						</div>
					</div>
				</div>

				<a href="<?= $arParams['EMPTY_BASKET_HINT_PATH'] ?>" class="cart__return">
					<svg class="icon" width="12" height="13" viewBox="0 0 12 13" fill="#3D9CEA" xmlns="http://www.w3.org/2000/svg">
						<g clip-path="url(#clip0_5631:228654)">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M9.35384 1.44025C9.56863 1.22546 9.56863 0.877222 9.35384 0.662434C9.13906 0.447646 8.79081 0.447646 8.57603 0.662434L3.11617 6.12229C3.00872 6.22974 2.95502 6.3706 2.95508 6.51143C2.95502 6.65227 3.00872 6.79312 3.11617 6.90058L8.57603 12.3604C8.79081 12.5752 9.13906 12.5752 9.35384 12.3604C9.56863 12.1456 9.56863 11.7974 9.35384 11.5826L4.28266 6.51143L9.35384 1.44025Z">
							</path>
						</g>
						<defs>
							<clipPath id="clip0_5631:228654">
								<rect width="12" height="12" fill="white" transform="translate(12 0.5) rotate(90)"></rect>
							</clipPath>
						</defs>
					</svg>
					<?= Loc::getMessage('SBB_CONTINUE_SHOPPING') ?>
				</a>

			</div>

			<div class="cart__side">
				<div data-entity="basket-total-block"></div>
			</div>
		</div>

	</div>
	<?
	if (!empty($arResult['CURRENCIES']) && Main\Loader::includeModule('currency')) {
		CJSCore::Init('currency');

		?>
		<script>
			BX.Currency.setCurrencies(<?= CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true) ?>);
		</script>
	<?
	}

	$signer = new \Bitrix\Main\Security\Sign\Signer;
	$signedTemplate = $signer->sign($templateName, 'sale.basket.basket');
	$signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.basket.basket');
	$messages = Loc::loadLanguageFile(__FILE__);
	?>
	<script>
		BX.message(<?= CUtil::PhpToJSObject($messages) ?>);
		BX.Sale.BasketComponent.init({
			result: <?= CUtil::PhpToJSObject($arResult, false, false, true) ?>,
			params: <?= CUtil::PhpToJSObject($arParams) ?>,
			template: '<?= CUtil::JSEscape($signedTemplate) ?>',
			signedParamsString: '<?= CUtil::JSEscape($signedParams) ?>',
			siteId: '<?= CUtil::JSEscape($component->getSiteId()) ?>',
			siteTemplateId: '<?= CUtil::JSEscape($component->getSiteTemplateId()) ?>',
			templateFolder: '<?= CUtil::JSEscape($templateFolder) ?>'
		});
	</script>
	<?
	if ($arParams['USE_GIFTS'] === 'Y' && $arParams['GIFTS_PLACE'] === 'BOTTOM') {
		?>
		<div data-entity="parent-container">
			<div class="catalog-block-header" data-entity="header" data-showed="false" style="display: none; opacity: 0;">
				<?= $arParams['GIFTS_BLOCK_TITLE'] ?>
			</div>
			<?
			$APPLICATION->IncludeComponent(
				'bitrix:sale.products.gift.basket',
				'bootstrap_v4',
				$giftParameters,
				$component
			);
			?>
		</div>
	<?
	}
} elseif ($arResult['EMPTY_BASKET']) {
	include(Main\Application::getDocumentRoot() . $templateFolder . '/empty.php');
} else {
	ShowError($arResult['ERROR_MESSAGE']);
}