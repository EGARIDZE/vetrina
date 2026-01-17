<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Web\Json;

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

// Подключаем библиотеки
$this->addExternalCss("https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css");
$this->addExternalJs("https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js");

$this->setFrameMode(true);

if (empty($arResult['ITEMS']))
    return;

$sliderID = 'product-slider-' . $this->randString();
$navID = 'nav-' . $this->randString();

$btnBasket = $arParams['~MESS_BTN_ADD_TO_BASKET'] ?? 'В корзину';
$messNotAvail = $arParams['~MESS_NOT_AVAILABLE'] ?? 'Нет в наличии';
?>

<div class="catalog-section-slider" data-slider-id="<?= $sliderID ?>">
    <?php if (!empty($arParams['SECTION_TITLE'])): ?>
        <h2 class="slider-title"><?= $arParams['SECTION_TITLE'] ?></h2>
    <?php endif; ?>

    <div class="swiper-container" id="<?= $sliderID ?>">
        <div class="swiper-wrapper">

            <?php foreach ($arResult['ITEMS'] as $item): ?>

                <?php
                $areaId = $this->GetEditAreaId($item['ID']);
                $haveOffers = !empty($item['OFFERS']);
                $actualItem = $haveOffers ? ($item['OFFERS'][0] ?? $item) : $item;

                $price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']] ?? $item['MIN_PRICE'] ?? null;
                $image = $actualItem['PREVIEW_PICTURE'] ?? $actualItem['DETAIL_PICTURE'] ?? $item['PREVIEW_PICTURE'] ?? $item['DETAIL_PICTURE'] ?? null;
                $imageSrc = $image ? $image['SRC'] : '/bitrix/templates/.default/images/no-photo.png';
                ?>

                <div class="swiper-slide" id="<?= $areaId ?>" data-entity="item">
                    <div class="product-card">
                        <div class="product-image">
                            <a href="<?= $item['DETAIL_PAGE_URL'] ?>">
                                <img src="<?= $imageSrc ?>" alt="<?= htmlspecialchars($item['NAME']) ?>" loading="lazy">
                            </a>
                        </div>

                        <div class="product-title">
                            <a href="<?= $item['DETAIL_PAGE_URL'] ?>"><?= htmlspecialchars($item['NAME']) ?></a>
                        </div>

                        <div class="product-price-block">
                            <div class="product-price">
                                <?php if ($price): ?>
                                    <?php if ($price['DISCOUNT'] > 0 && $price['PRINT_RATIO_BASE_PRICE'] !== $price['PRINT_RATIO_PRICE']): ?>
                                        <span class="price-old"><?= $price['PRINT_RATIO_BASE_PRICE'] ?></span>
                                    <?php endif; ?>
                                    <span class="price-current"><?= $price['PRINT_RATIO_PRICE'] ?></span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- ВЫВОД КНОПОК SKU -->
                        <?php if ($haveOffers && !empty($item['SKU_PROPS'])): ?>
                            <div class="product-sku-props mb-3" data-entity="sku-props">
                                <?php foreach ($item['SKU_PROPS'] as $propCode => $skuProp): ?>
                                    <div data-entity="sku-line-block" class="mb-3">
                                        <div class="product-item-scu-container-title"><?= htmlspecialchars($skuProp['NAME']) ?>
                                        </div>
                                        <div class="product-item-scu-container">
                                            <div class="product-item-scu-block">
                                                <div class="product-item-scu-list">
                                                    <ul class="product-item-scu-item-list">
                                                        <?php foreach ($skuProp['VALUES'] as $valueId => $val):
                                                            $isSelected = $val['SELECTED'];
                                                            $isAllowed = $val['CAN_BUY']; // Достаем доступность из result_modifier
                                                            ?>
                                                            <li class="product-item-scu-item-text-container <?= $isSelected ? 'selected' : '' ?> <?= !$isAllowed ? 'notallowed' : '' ?>"
                                                                title="<?= htmlspecialchars($val['NAME']) ?>"
                                                                data-sku-prop="<?= $skuProp['ID'] ?>" data-value-id="<?= $valueId ?>"
                                                                data-entity="sku-block-element">
                                                                <div class="product-item-scu-item-text-block">
                                                                    <div class="product-item-scu-item-text">
                                                                        <span
                                                                            class="product-item-scu-item-value"><?= htmlspecialchars($val['NAME']) ?></span>
                                                                        <?php if (!empty($val['PRICE'])): ?>
                                                                            <span
                                                                                class="product-item-scu-item-price"><?= $val['PRICE'] ?></span>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <div class="product-actions">
                            <!-- ВАЖНО: Здесь не нужен action в URL, так как JS сам его формирует -->
                            <button class="btn <?= $actualItem['CAN_BUY'] ? 'btn-primary' : 'btn-disabled' ?>"
                                data-entity="buy-button" data-product-id="<?= $actualItem['ID'] ?>"
                                <?= !$actualItem['CAN_BUY'] ? 'disabled' : '' ?>>
                                <?= $actualItem['CAN_BUY'] ? $btnBasket : $messNotAvail ?>
                            </button>
                            <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="btn btn-secondary">
                                <?= $arParams['~MESS_BTN_DETAIL'] ?? 'Подробнее' ?>
                            </a>
                        </div>

                        <!-- JSON -->
                        <?php if ($haveOffers):
                            $jsOffers = [];
                            foreach ($item['OFFERS'] as $offer) {
                                $jsOffers[$offer['ID']] = [
                                    'ID' => $offer['ID'],
                                    'TREE' => $offer['TREE'] ?? [],
                                    'CAN_BUY' => $offer['CAN_BUY'],
                                    'ITEM_PRICES' => $offer['ITEM_PRICES'],
                                    'PREVIEW_PICTURE' => $offer['PREVIEW_PICTURE'] ? ['SRC' => $offer['PREVIEW_PICTURE']['SRC']] : null,
                                    'DETAIL_PICTURE' => $offer['DETAIL_PICTURE'] ? ['SRC' => $offer['DETAIL_PICTURE']['SRC']] : null,
                                ];
                            }
                            ?>
                            <script type="application/json" data-entity="offers"><?= Json::encode($jsOffers) ?></script>
                        <?php endif; ?>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Навигация -->
        <div class="swiper-button-prev" id="<?= $navID ?>-prev"></div>
        <div class="swiper-button-next" id="<?= $navID ?>-next"></div>

        <!-- Пагинация (Табы) -->
        <div class="swiper-pagination" id="<?= $navID ?>-pagination"></div>
    </div>
</div>

<script>
    BX.ready(function () {
        new Swiper('#<?= $sliderID ?>', {
            slidesPerView: 1,
            spaceBetween: 20,
            // Порог 10px: слайдер не начнет двигаться, пока вы не протянете мышь на 10px. 
            // Это предотвращает случайные сдвиги при клике.
            threshold: 10,
            watchOverflow: true, // Скрывает навигацию, если слайдов мало
            navigation: {
                nextEl: '#<?= $navID ?>-next',
                prevEl: '#<?= $navID ?>-prev'
            },
            pagination: {
                el: '#<?= $navID ?>-pagination',
                clickable: true,
                dynamicBullets: true // Красивый эффект разного размера точек
            },
            breakpoints: {
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 4 }
            },
            autoplay: <?= ($arParams['SLIDER_AUTOPLAY'] === 'Y') ? '{delay: 5000, pauseOnMouseEnter: true}' : 'false' ?>,
        });

        if (window.CatalogSectionSlider) {
            new window.CatalogSectionSlider({
                sliderNode: document.querySelector('[data-slider-id="<?= $sliderID ?>"]')
            });
        }
    });
</script>