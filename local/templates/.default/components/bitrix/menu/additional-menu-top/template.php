<?php

use Bitrix\Main\Web\Json;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);

if (empty($arResult["ALL_ITEMS"]))
	return;

CUtil::InitJSCore();
\Bitrix\Main\UI\Extension::load('ui.fonts.opensans');

//$menuBlockId = "catalog_menu_".$this->randString();
?>



<div class="d-flex justify-content-start gap-4 text-secondary fs-4 fw-normal">
    <?foreach ($arResult["ALL_ITEMS"] as $itemID => $arColumns) {?>
        <a href="<?=$arColumns["LINK"]?>" class="text-decoration-none text-secondary p-2 additional-menu"><?= $arColumns["TEXT"] ?></a>
    <?}?>
</div>

<?/*<script>
	BX.ready(function () {
		window.obj_<?=$menuBlockId?> = new BX.Main.MenuComponent.CatalogHorizontal('<?=CUtil::JSEscape($menuBlockId)?>', <?= Json::encode($arResult["ITEMS_IMG_DESC"]) ?>);
	});
</script>*/?>
