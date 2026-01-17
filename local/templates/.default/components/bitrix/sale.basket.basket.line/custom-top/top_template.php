<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */

$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
?>
<div class="sbb-cart-wrapper">
    <div class="sbb-icons-row">
        <?php if (!$compositeStub && $arParams['SHOW_AUTHOR'] == 'Y'): ?>
            <?php if ($USER->IsAuthorized()): ?>
                <a href="<?= $arParams['PATH_TO_PROFILE'] ?>" class="sbb-icon" title="<?= GetMessage('TSB1_PERSONAL') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </a>
                <a href="?logout=yes&<?= bitrix_sessid_get() ?>" class="sbb-icon" title="<?= GetMessage('TSB1_LOGOUT') ?>">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                </a>
            <?php else:
                $arParamsToDelete = ["login", "login_form", "logout", "register", "forgot_password", "change_password", "confirm_registration", "confirm_code", "confirm_user_id", "logout_butt", "auth_service_id", "clear_cache", "backurl"];
                $currentUrl = urlencode($APPLICATION->GetCurPageParam("", $arParamsToDelete));
                if ($arParams['AJAX'] == 'N') { ?><script><?= $cartId ?>.currentUrl = '<?= $currentUrl ?>';</script><? } else { $currentUrl = '#CURRENT_URL#'; }
                $pathToAuthorize = $arParams['PATH_TO_AUTHORIZE'];
                $pathToAuthorize .= (mb_stripos($pathToAuthorize, '?') === false ? '?' : '&');
                $pathToAuthorize .= 'login=yes&backurl=' . $currentUrl;
                ?>
                <a href="<?= $pathToAuthorize ?>" class="sbb-icon" title="<?= GetMessage('TSB1_LOGIN') ?>">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </a>
            <?php endif; ?>
        <?php endif; ?>

        <div class="sbb-cart-hover-area">
            <?php if (!$arResult["DISABLE_USE_BASKET"]): ?>
                <a href="<?= $arParams['PATH_TO_BASKET'] ?>" class="sbb-icon sbb-icon-cart" title="<?= GetMessage('TSB1_CART') ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                    <?php if (!$compositeStub && $arResult['NUM_PRODUCTS'] > 0): ?>
                        <span class="sbb-cart-count"><?= $arResult['NUM_PRODUCTS'] ?></span>
                    <?php endif; ?>
                </a>
            <?php endif; ?>
        </div> 
    </div>
</div>