<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 */

$this->setFrameMode(true);

if (!empty($arResult['RECOMMENDED_IDS'])) {
	global $recommendedFilter;

	$recommendedFilter = array(
		'=ID' => $arResult['RECOMMENDED_IDS'],
	);

	if (empty($arParams['HIDE_BLOCK_TITLE']) || $arParams['HIDE_BLOCK_TITLE'] !== 'Y') {
		?>
		<div class="recommended-products-title">
			<?= Loc::getMessage('CT_BCS_ELEMENT_RECOMMENDED_PRODUCTS') ?: 'Рекомендуемые товары' ?>
		</div>
		<?php
	}

	// ============================================
	// ПОДГОТОВКА ПАРАМЕТРОВ ДЛЯ CATALOG.SECTION
	// ============================================

	// Извлекаем OFFER_TREE_PROPS из параметров
	$offerTreeProps = array();

	// Компонент передает параметры с суффиксом _IBLOCK_ID
	// Например: OFFER_TREE_PROPS_5 => array(5 => array('WEIGHT_REFERENCE'))
	foreach ($arParams as $key => $value) {
		if (strpos($key, 'OFFER_TREE_PROPS_') === 0 && is_array($value) && !empty($value)) {
			// Извлекаем ID инфоблока из ключа
			$iblockId = str_replace('OFFER_TREE_PROPS_', '', $key);

			// Проверяем, если это вложенный массив с ID инфоблока как ключом
			if (isset($value[$iblockId]) && is_array($value[$iblockId])) {
				$offerTreeProps = $value[$iblockId];
			} else {
				// Или это просто массив значений
				$offerTreeProps = $value;
			}

			// Нашли, выходим
			if (!empty($offerTreeProps)) {
				break;
			}
		}
	}

	// Если не нашли, пробуем напрямую
	if (empty($offerTreeProps) && !empty($arParams['OFFER_TREE_PROPS'])) {
		if (is_array($arParams['OFFER_TREE_PROPS'])) {
			// Проверяем, есть ли вложенная структура
			$firstValue = reset($arParams['OFFER_TREE_PROPS']);
			if (is_array($firstValue)) {
				// Берем первый вложенный массив
				$offerTreeProps = $firstValue;
			} else {
				$offerTreeProps = $arParams['OFFER_TREE_PROPS'];
			}
		}
	}

	// Извлекаем OFFERS_PROPERTY_CODE аналогично
	$offersPropertyCode = array();
	foreach ($arParams as $key => $value) {
		if (strpos($key, 'PROPERTY_CODE_') === 0 && is_array($value)) {
			// Проверяем, что это код торговых предложений (обычно больший ID)
			$id = str_replace('PROPERTY_CODE_', '', $key);
			if (is_numeric($id) && intval($id) > $arParams['IBLOCK_ID']) {
				$offersPropertyCode = $value;
				break;
			}
		}
	}

	// Извлекаем OFFERS_PROPERTY_CODE из OFFERS_PROPERTY_CODE параметра
	if (empty($offersPropertyCode) && !empty($arParams['OFFERS_PROPERTY_CODE'])) {
		$offersPropertyCode = $arParams['OFFERS_PROPERTY_CODE'];
	}

	// Отладка (можно убрать после проверки)

	// echo '<pre>DEBUG OFFER_TREE_PROPS:';
	// print_r($offerTreeProps);
	// echo '</pre>';


	$APPLICATION->IncludeComponent(
		'bitrix:catalog.section',
		'slider', // ← НАШ ШАБЛОН СЛАЙДЕРА
		array(
			'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
			'IBLOCK_ID' => $arParams['IBLOCK_ID'],
			'ELEMENT_SORT_FIELD' => $arParams['ELEMENT_SORT_FIELD'] ?? 'sort',
			'ELEMENT_SORT_ORDER' => $arParams['ELEMENT_SORT_ORDER'] ?? 'asc',
			'ELEMENT_SORT_FIELD2' => $arParams['ELEMENT_SORT_FIELD2'] ?? 'id',
			'ELEMENT_SORT_ORDER2' => $arParams['ELEMENT_SORT_ORDER2'] ?? 'desc',
			'FILTER_NAME' => 'recommendedFilter',
			'INCLUDE_SUBSECTIONS' => 'Y',
			'SHOW_ALL_WO_SECTION' => 'Y',
			'PAGE_ELEMENT_COUNT' => $arParams['PAGE_ELEMENT_COUNT'] ?? 12,

			// ============================================
			// ПАРАМЕТРЫ СЛАЙДЕРА
			// ============================================
			'SECTION_TITLE' => Loc::getMessage('CT_BCS_ELEMENT_RECOMMENDED_PRODUCTS') ?: 'Рекомендуемые товары',
			'SLIDER_AUTOPLAY' => 'N',

			// ============================================
			// НАСТРОЙКИ ЦЕН
			// ============================================
			'PRICE_CODE' => $arParams['PRICE_CODE'] ?? array('BASE'),
			'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'] ?? 'N',
			'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'] ?? 1,
			'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'] ?? 'Y',

			// ============================================
			// КОРЗИНА
			// ============================================
			'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'] ?? 'Y',
			'ADD_PROPERTIES_TO_BASKET' => $arParams['ADD_PROPERTIES_TO_BASKET'] ?? 'Y',
			'PRODUCT_PROPS_VARIABLE' => 'prop',
			'PARTIAL_PRODUCT_PROPERTIES' => 'N',
			'PRODUCT_PROPERTIES' => array(),
			'BASKET_URL' => $arParams['BASKET_URL'] ?? '/personal/cart/',
			'ACTION_VARIABLE' => 'action',
			'PRODUCT_ID_VARIABLE' => 'id',
			'PRODUCT_QUANTITY_VARIABLE' => 'quantity',

			// ============================================
			// ⚠️ ВАЖНО! SKU (ТОРГОВЫЕ ПРЕДЛОЖЕНИЯ)
			// ============================================
			'PRODUCT_DISPLAY_MODE' => 'Y',
			'OFFER_TREE_PROPS' => $offerTreeProps, // ← ПЕРЕДАЕМ ПАРАМЕТР!
			'OFFERS_PROPERTY_CODE' => $offersPropertyCode,
			'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'] ?? array(),
			'OFFERS_FIELD_CODE' => $arParams['OFFERS_FIELD_CODE'] ?? array(),
			'OFFERS_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'] ?? 'sort',
			'OFFERS_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'] ?? 'asc',
			'OFFERS_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'] ?? 'id',
			'OFFERS_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'] ?? 'desc',
			'OFFERS_LIMIT' => $arParams['OFFERS_LIMIT'] ?? 0,
			'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'] ?? 'Y',
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] ?? 'Y',
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] ?? 'Y',

			// ============================================
			// СВОЙСТВА И ИЗОБРАЖЕНИЯ
			// ============================================
			'PROPERTY_CODE' => $arParams['PROPERTY_CODE_' . $arParams['IBLOCK_ID']] ?? $arParams['PROPERTY_CODE'] ?? array(),
			'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] ?? 'N',
			'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'] ?? 'Купить',
			'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'] ?? 'В корзину',
			'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'] ?? 'Подробнее',
			'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'] ?? 'Нет в наличии',

			// ============================================
			// КЭШИРОВАНИЕ
			// ============================================
			'CACHE_TYPE' => $arParams['CACHE_TYPE'] ?? 'A',
			'CACHE_TIME' => $arParams['CACHE_TIME'] ?? 36000000,
			'CACHE_GROUPS' => $arParams['CACHE_GROUPS'] ?? 'Y',

			// ============================================
			// URL
			// ============================================
			'SECTION_URL' => $arParams['SECTION_URL'] ?? '',
			'DETAIL_URL' => $arParams['DETAIL_URL'] ?? '',
		),
		false,
		array('HIDE_ICONS' => 'Y')
	);
}
?>