<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

// ID инфоблока каталога (должен совпадать с параметром IBLOCK_ID в index.php)
$iblockId = 4;

// Определяем текущий раздел (если на корневой странице – будет 0)
$currentSectionId = (int)($GLOBALS['CATALOG_CURRENT_SECTION_ID'] ?? 0);

// Папка и шаблон SEF для разделов (как в index.php компонента)
$sefFolder      = '/catalog/';
$sectionTpl     = $sefFolder . '#SECTION_CODE_PATH#/';

/**
 * Рекурсивно строит дерево разделов с SEF-ссылками
 *
 * @param int    $parentId        – ID родительского раздела
 * @param int    $depth           – уровень вложенности (0,1,2…)
 * @param int    $iblockId        – ID инфоблока
 * @param int    $currentSection  – ID текущего раздела
 * @param string $parentCodePath  – накопленный путь CODE (например "koshki")
 * @param string $urlTpl          – шаблон ссылки ("/catalog/#SECTION_CODE_PATH#/")
 * @return string HTML списка `<ul>`…`</ul>`
 */
function buildSectionTree($parentId, $depth, $iblockId, $currentSection, $parentCodePath, $urlTpl) {
    $html = '';
    $rs = CIBlockSection::GetList(
        ['SORT'=>'ASC'],
        [
            'IBLOCK_ID'     => $iblockId,
            'SECTION_ID'    => $parentId,
            'GLOBAL_ACTIVE' => 'Y',
            'ACTIVE'        => 'Y',
        ],
        false,
        ['ID','NAME','CODE']
    );
    if ($rs->SelectedRowsCount() > 0) {
        $html .= '<ul class="sidebar-menu depth-' . $depth . '">';
        while ($ar = $rs->GetNext()) {
            // собираем SECTION_CODE_PATH
            $codePath = $parentCodePath
                ? $parentCodePath . '/' . $ar['CODE']
                : $ar['CODE'];

            // генерируем SEF-URL
            $url = CComponentEngine::MakePathFromTemplate(
                $urlTpl,
                [
                  'SECTION_ID'        => $ar['ID'],
                  'SECTION_CODE_PATH' => $codePath,
                ]
            );

            // проверяем текущее состояние и наличие детей
            $isActive    = ($ar['ID'] == $currentSection);
            $children    = buildSectionTree($ar['ID'], $depth+1, $iblockId, $currentSection, $codePath, $urlTpl);
            $hasChildren = $children !== '';

            // собираем CSS-классы
            $classes = 'sidebar-menu-item';
            if ($isActive)    $classes .= ' active';
            if ($hasChildren) $classes .= ' has-children';

            // выводим пункт
            $html .= '<li class="' . $classes . '">';
            $html .= '<a href="' . htmlspecialcharsbx($url) . '">'
                  .  htmlspecialcharsbx($ar['NAME'])
                  . '</a>';

            // вложенный список
            if ($hasChildren) {
                $html .= $children;
            }

            $html .= '</li>';
        }
        $html .= '</ul>';
    }
    return $html;
}
?>
<div class="catalog-sidebar">
	<h3>Категории</h3>
	 <?= buildSectionTree(
       0,               // стартовый родитель
       0,               // глубина
       $iblockId,
       $currentSectionId,
       '',              // пока нет накопленного пути
       $sectionTpl
     ) ?>
</div>
<br>