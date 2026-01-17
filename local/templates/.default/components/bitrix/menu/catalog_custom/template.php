<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */

if (empty($arResult)) {
    return;
}

// --- ЛОГИКА ДЛЯ ПОДДЕРЖКИ SEF URL (ЧПУ) ---
// Массив, где мы будем хранить ссылки активной ветки каталога
$arActiveLinks = [];

// Проверяем, есть ли у нас ID текущего раздела каталога (устанавливается компонентом catalog)
if (isset($GLOBALS['CATALOG_CURRENT_SECTION_ID']) && $GLOBALS['CATALOG_CURRENT_SECTION_ID'] > 0 && CModule::IncludeModule('iblock')) {
    // Получаем цепочку навигации (всех родителей) для текущего раздела
    $rsPath = CIBlockSection::GetNavChain(
        false, // IBLOCK_ID - определится автоматически
        $GLOBALS['CATALOG_CURRENT_SECTION_ID'],
        ['ID', 'IBLOCK_ID', 'SECTION_PAGE_URL'] // Поля, которые нам нужны
    );

    while ($arPath = $rsPath->GetNext()) {
        // Собираем канонические ссылки всех родительских разделов в один массив
        if (!empty($arPath['SECTION_PAGE_URL'])) {
            $arActiveLinks[] = $arPath['SECTION_PAGE_URL'];
        }
    }
}
// --- КОНЕЦ ЛОГИКИ ДЛЯ ПОДДЕРЖКИ SEF URL ---
?>
<div class="catalog-menu">
    <div class="catalog-menu__title">Каталог товаров</div>
    <ul class="catalog-menu__list">
    <?php
    $previousLevel = 0;
    foreach ($arResult as $arItem):
        // Закрываем теги, если уровень вложенности уменьшился
        if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) {
            echo str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));
        }

        // --- ОБНОВЛЕННАЯ ЛОГИКА ОПРЕДЕЛЕНИЯ КЛАССОВ ---
        $itemClasses = ['catalog-menu__item'];
        if ($arItem['IS_PARENT']) {
            $itemClasses[] = 'catalog-menu__item--has-children';
        }

        // Проверяем, является ли ссылка текущего пункта частью активной ветки
        $isLinkInActiveChain = !empty($arActiveLinks) && in_array($arItem['LINK'], $arActiveLinks);

        // Пункт считается выбранным, если:
        // 1. Сработал стандартный механизм Битрикса ($arItem['SELECTED'])
        // 2. ИЛИ наша новая проверка нашла совпадение в активной ветке
        if ($arItem['SELECTED'] || $isLinkInActiveChain) {
            $itemClasses[] = 'catalog-menu__item--selected'; // Добавляем класс для подсветки
            if ($arItem['IS_PARENT']) {
                $itemClasses[] = 'is-open'; // Добавляем класс для раскрытия
            }
        }
    ?>
        <li class="<?= implode(' ', $itemClasses) ?>">
            <a class="catalog-menu__link" href="<?= htmlspecialcharsbx($arItem["LINK"]) ?>"><?= htmlspecialcharsbx($arItem["TEXT"]) ?></a>

            <?php if ($arItem["IS_PARENT"]): ?>
                <button type="button" class="catalog-menu__toggle" aria-label="Раскрыть подменю"></button>
                <ul class="catalog-menu__submenu">
            <?php else: ?>
                </li>
            <?php endif; ?>

    <?php
        $previousLevel = $arItem["DEPTH_LEVEL"];
    endforeach;

    // Закрываем оставшиеся теги в конце списка
    if ($previousLevel > 1) {
        echo str_repeat("</ul></li>", ($previousLevel - 1));
    }
    ?>
    </ul>
</div>