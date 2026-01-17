<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */

$this->setFrameMode(true);

// Если секций нет, ничего не выводим
if (empty($arResult['SECTIONS'])) {
	return;
}

/**
 * Функция для правильного склонения слов (товар, товара, товаров)
 * @param int $number Число, для которого нужно склонение
 * @param array $forms Массив из трех форм слова. Например: ['товар', 'товара', 'товаров']
 * @return string Возвращает правильную форму слова
 */
if (!function_exists('getPluralForm')) {
	function getPluralForm(int $number, array $forms): string
	{
		$number = abs($number);
		if ($number % 100 >= 11 && $number % 100 <= 19) {
			return $forms[2];
		}
		$lastDigit = $number % 10;
		if ($lastDigit == 1) {
			return $forms[0];
		}
		if ($lastDigit >= 2 && $lastDigit <= 4) {
			return $forms[1];
		}
		return $forms[2];
	}
}


$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
?>
<div class="catalog-categories__wrap">
	<? if ('Y' == $arParams['SHOW_PARENT_NAME'] && 0 < $arResult['SECTION']['ID']): ?>
		<?
		$this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
		$this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
		?>
		<div class="catalog-categories__title" id="<? echo $this->GetEditAreaId($arResult['SECTION']['ID']); ?>">
			<span class="h2">
				<a href="<? echo $arResult['SECTION']['SECTION_PAGE_URL']; ?>">
					<? echo (
						isset($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != ""
						? $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]
						: $arResult['SECTION']['NAME']
					); ?>
				</a>
			</span>
		</div>
	<? endif; ?>

	<div class="catalog-categories">
		<?
		foreach ($arResult['SECTIONS'] as $arSection):
			$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

			$pictureSrc = $arSection['PICTURE']['SRC'] ?? $this->GetFolder() . '/images/tile-empty.png';
			$pictureAlt = $arSection['PICTURE']['ALT'] ?? $arSection['NAME'];
			$pictureTitle = $arSection['PICTURE']['TITLE'] ?? $arSection['NAME'];
			?>
			<!-- ИЗМЕНЕНИЕ: Убраны классы сетки (col-lg-3 и т.д.). Оставлен только один класс для управления из CSS. -->
			<div class="catalog-categories_col" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
				<a href="<?= $arSection['SECTION_PAGE_URL']; ?>" class="catalog-categories-item">
					<span class="catalog-categories-item_img">
						<img src="<?= $pictureSrc ?>" alt="<?= $pictureAlt ?>" title="<?= $pictureTitle ?>">
					</span>
					<span class="catalog-categories-item_info">
						<span class="link"><?= $arSection['NAME']; ?></span>
						<? if ($arParams["COUNT_ELEMENTS"] && $arSection['ELEMENT_CNT'] !== null): ?>
							<span class="p3 gray">
								<?
								$count = (int) $arSection['ELEMENT_CNT'];
								$word = getPluralForm($count, ['товар', 'товара', 'товаров']);
								echo $count . ' ' . $word;
								?>
							</span>
						<? endif; ?>
					</span>
				</a>
			</div>
			<?
		endforeach;
		?>
	</div>
</div>