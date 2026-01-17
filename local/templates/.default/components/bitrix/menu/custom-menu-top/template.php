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

$menuBlockId = "catalog_menu_".$this->randString();
?>

<!-- version 2.3 - Adaptive Mega Menu (Fix) -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100 rounded-pill" id="<?=$menuBlockId?>">
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu<?=$menuBlockId?>" aria-controls="mainMenu<?=$menuBlockId?>" aria-expanded="false" aria-label="Переключить навигацию">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="mainMenu<?=$menuBlockId?>">
    <ul class="navbar-nav d-flex flex-column flex-lg-row justify-content-between w-100 mb-0">
      <?foreach($arResult["MENU_STRUCTURE"] as $itemID => $arColumns):?>
        <?php
        // ИСПРАВЛЕНИЕ: Заменили is-array на is_array
        $hasDropdown = is_array($arColumns) && !empty($arColumns);
        ?>
        <li class="nav-item<?= $hasDropdown ? ' dropdown' : '' ?> flex-lg-fill text-lg-center<?=($arResult["ALL_ITEMS"][$itemID]["SELECTED"] ? ' active' : '')?>">
          <a class="nav-link<?= $hasDropdown ? ' dropdown-toggle' : '' ?> py-3"
             href="<?=$arResult["ALL_ITEMS"][$itemID]["LINK"]?>"
             <?= $hasDropdown ? 'id="dropdownMenuLink-'.$itemID.'" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"' : '' ?>>
            <?=htmlspecialcharsbx($arResult["ALL_ITEMS"][$itemID]["TEXT"], ENT_COMPAT, false)?>
          </a>
          <?if ($hasDropdown):?>
            <div class="dropdown-menu mega-menu w-100 rounded-bottom" aria-labelledby="dropdownMenuLink-<?=$itemID?>">
              <div class="container-fluid">
                <div class="row py-3 py-lg-3">
                  <?
                  $subItems = [];
                  foreach ($arColumns as $arRow) {
                      foreach ($arRow as $itemIdLevel_2 => $arLevel_3) {
                          if (isset($arResult["ALL_ITEMS"][$itemIdLevel_2])) {
                              $subItems[] = $arResult["ALL_ITEMS"][$itemIdLevel_2];
                          }
                      }
                  }

                  $chunks = array_chunk($subItems, 7);
                  
                  $columnClass = 'col-lg-3 col-md-4 col-sm-6'; 
                  ?>
                  <?foreach($chunks as $chunk):?>
                    <div class="<?=$columnClass?>">
                      <ul class="list-unstyled">
                        <?foreach($chunk as $subItem):?>
                          <li>
                            <a class="dropdown-item px-3 py-2" href="<?=$subItem["LINK"]?>">
                              <?=$subItem["TEXT"]?>
                            </a>
                          </li>
                        <?endforeach;?>
                      </ul>
                    </div>
                  <?endforeach;?>
                </div>
              </div>
            </div>
          <?endif?>
        </li>
      <?endforeach;?>
    </ul>
  </div>
</nav>


<?/*<script>
	BX.ready(function () {
		window.obj_<?=$menuBlockId?> = new BX.Main.MenuComponent.CatalogHorizontal('<?=CUtil::JSEscape($menuBlockId)?>', <?= Json::encode($arResult["ITEMS_IMG_DESC"]) ?>);
	});
</script>*/?>