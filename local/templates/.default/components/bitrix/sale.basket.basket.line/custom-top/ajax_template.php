<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$this->IncludeLangFile('template.php');

$cartId = $arParams['cartId'];
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
?>
<div class="sbb-cart-wrapper">
    <div class="sbb-icons-row">
        <?php // --- Копируем блок иконок профиля сюда, чтобы шаблон был целостным --- ?>
        <?php if (!$compositeStub && $arParams['SHOW_AUTHOR'] == 'Y'): ?>
            <?php if ($USER->IsAuthorized()): ?>
                <a href="<?= $arParams['PATH_TO_PROFILE'] ?>" class="sbb-icon" title="<?= GetMessage('TSB1_PERSONAL') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </a>
                <a href="?logout=yes&<?= bitrix_sessid_get() ?>" class="sbb-icon" title="<?= GetMessage('TSB1_LOGOUT') ?>">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                </a>
            <?php else:
                $currentUrl = '#CURRENT_URL#';
                $pathToAuthorize = $arParams['PATH_TO_AUTHORIZE'];
                $pathToAuthorize .= (mb_stripos($pathToAuthorize, '?') === false ? '?' : '&');
                $pathToAuthorize .= 'login=yes&backurl=' . $currentUrl;
                ?>
                <a href="<?= $pathToAuthorize ?>" class="sbb-icon" title="<?= GetMessage('TSB1_LOGIN') ?>">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </a>
            <?php endif; ?>
        <?php endif; ?>

        <?php // --- ИЗМЕНЕНИЕ 2: Создаем обертку и помещаем ВНУТРЬ нее и иконку, и выпадающий список --- ?>
        <div class="sbb-cart-hover-area">
            <?php if (!$arResult["DISABLE_USE_BASKET"]): ?>
                <a href="<?= $arParams['PATH_TO_BASKET'] ?>" class="sbb-icon sbb-icon-cart" title="<?= GetMessage('TSB1_CART') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                    <?php if (!$compositeStub && $arResult['NUM_PRODUCTS'] > 0): ?>
                        <span class="sbb-cart-count"><?= $arResult['NUM_PRODUCTS'] ?></span>
                    <?php endif; ?>
                </a>
            <?php endif; ?>

            <?php
            // --- Блок выпадающего списка теперь находится внутри .sbb-cart-hover-area
            if ($arParams["SHOW_PRODUCTS"] == "Y" && ($arResult['NUM_PRODUCTS'] > 0 || !empty($arResult['CATEGORIES']['DELAY'])))
            {
                ?>
                <div data-role="basket-item-list" class="bx-basket-item-list sbb-dropdown">
                    <div id="<?= $cartId ?>products" class="bx-basket-item-list-container sbb-dropdown-items">
                        <? foreach ($arResult["CATEGORIES"]["READY"] as $v): ?>
                            <div class="sbb-dropdown-item">
                                <div class="sbb-dropdown-item-img">
                                    <? if ($arParams["SHOW_IMAGE"] == "Y" && $v["PICTURE_SRC"]): ?>
                                        <a href="<?= $v["DETAIL_PAGE_URL"] ?>"><img src="<?= $v["PICTURE_SRC"] ?>" alt="<?= $v["NAME"] ?>"></a>
                                    <? else: ?>
                                        <img src="<?= $v["PICTURE_SRC"] ?>" alt="<?= $v["NAME"] ?>"/>
                                    <? endif ?>
                                </div>
                                <div class="sbb-dropdown-item-info">
                                    <a href="<?= $v["DETAIL_PAGE_URL"] ?>" class="sbb-dropdown-item-name"><?= $v["NAME"] ?></a>
                                    <? if ($arParams["SHOW_PRICE"] == "Y"): ?>
                                        <div class="sbb-dropdown-item-price-line">
                                            <span class="sbb-dropdown-item-price"><?= $v["PRICE_FMT"] ?></span>
                                            <span class="sbb-dropdown-item-quantity"> x <?= $v["QUANTITY"] ?> <?= $v["MEASURE_NAME"] ?></span>
                                        </div>
                                    <? endif; ?>
                                </div>
                                <div class="sbb-dropdown-item-remove" onclick="<?= $cartId ?>.removeItemFromCart(<?= $v['ID'] ?>)" title="<?= GetMessage("TSB1_DELETE") ?>"></div>
                            </div>
                        <? endforeach ?>
                    </div>
                    <? if ($arResult["CATEGORIES"]["READY"]): ?>
                         <div class="sbb-dropdown-footer">
                            <div class="sbb-dropdown-total">
                                <span>Итого</span>
                                <span><?= $arResult['TOTAL_PRICE'] ?></span>
                            </div>
                            <a href="<?= $arParams['PATH_TO_BASKET'] ?>" class="sbb-dropdown-btn">Перейти в корзину</a>
                        </div>
                    <? endif; ?>
                </div>
                <script>
                    BX.ready(function(){ <?=$cartId?>.fixCart(); });
                </script>
                <?
            }
            ?>
        </div> <? // --- Конец обертки .sbb-cart-hover-area --- ?>
    </div>
</div>