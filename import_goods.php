<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

ini_set('memory_limit', '512M'); 

use Bitrix\Main\Loader;
use Bitrix\Iblock\SectionTable;
use PhpOffice\PhpSpreadsheet\IOFactory;

global $USER;
if (!$USER->IsAdmin()) die("Доступ закрыт");

Loader::includeModule('iblock');
Loader::includeModule('catalog');

// --- НАСТРОЙКИ ---
$IBLOCK_ID = 4; // ID инфоблока
$FILE_PATH = $_SERVER["DOCUMENT_ROOT"] . "/upload/import_file.xlsx";
$PROP_ARTNUMBER_CODE = "ARTNUMBER"; 

// --- ФУНКЦИИ ---

function normalizeName($str) {
    $str = (string)$str;
    // Чистим неразрывные пробелы и прочий мусор
    $str = str_replace([chr(194).chr(160), "\xA0", '&nbsp;'], ' ', $str);
    $str = trim($str);
    $str = preg_replace('/\s+/', ' ', $str); 
    $str = mb_strtolower($str);
    return $str;
}

function findSectionId($iblockId, $parentName, $subName = '') {
    $parentName = trim((string)$parentName);
    $subName = trim((string)$subName);
    
    if (empty($parentName)) return null;

    // 1. Ищем родителя (в корне)
    $rsSec = CIBlockSection::GetList([], [
        'IBLOCK_ID' => $iblockId,
        'NAME' => $parentName,
        'SECTION_ID' => false 
    ], false, ['ID']);
    
    if ($arSec = $rsSec->Fetch()) {
        $parentId = $arSec['ID'];
    } else {
        return "PARENT_NOT_FOUND";
    }

    // 2. Ищем подкатегорию
    if (!empty($subName)) {
        $rsSub = CIBlockSection::GetList([], [
            'IBLOCK_ID' => $iblockId,
            'NAME' => $subName,
            'SECTION_ID' => $parentId
        ], false, ['ID']);

        if ($arSub = $rsSub->Fetch()) {
            return $arSub['ID'];
        } else {
            return "SUB_NOT_FOUND";
        }
    }
    return $parentId;
}

function getMeasureIdByName($measureSymbol) {
    $measureSymbol = trim((string)$measureSymbol);
    if (empty($measureSymbol)) return null;
    
    static $measures = [];
    if (empty($measures)) {
        $res = CCatalogMeasure::getList([], []);
        while($item = $res->Fetch()) {
            $measures[normalizeName($item['SYMBOL_RUS'])] = $item['ID'];
            $measures[normalizeName($item['MEASURE_TITLE'])] = $item['ID'];
        }
    }
    return $measures[normalizeName($measureSymbol)] ?? null;
}

// --- ЛОГИКА ---

$isPost = $_SERVER['REQUEST_METHOD'] === 'POST';
$action = $_POST['action'] ?? '';

// 1. Получаем товары с сайта
$arSiteProducts = [];
$rsElements = CIBlockElement::GetList(
    [], 
    ['IBLOCK_ID' => $IBLOCK_ID], 
    false, 
    false, 
    ['ID', 'NAME'] 
);
while ($el = $rsElements->Fetch()) {
    $arSiteProducts[normalizeName($el['NAME'])] = $el['ID'];
}

// 2. Анализ Excel
$arData = [];
$stats = ['move' => 0, 'ok' => 0, 'error' => 0, 'new' => 0];

if (file_exists($FILE_PATH)) {
    require $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';
    $spreadsheet = IOFactory::load($FILE_PATH);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    foreach ($rows as $k => $row) {
        if ($k == 0) continue; 

        $nameRaw    = $row[0]; // A
        $measureRaw = $row[2]; // C
        $artRaw     = $row[4]; // E
        $catRaw     = $row[6]; // G
        $subCatRaw  = $row[7]; // H

        if (empty($nameRaw)) continue;

        $normName = normalizeName($nameRaw);
        $siteId = $arSiteProducts[$normName] ?? null;

        // Разбиваем строку категорий (и, запятые)
        $catsArray = preg_split('/( и |,|;)/u', $catRaw);
        
        $targetSectionIds = []; // Сюда складываем только найденные
        $catErrors = [];        // Сюда складываем ошибки

        foreach ($catsArray as $cName) {
            $cName = trim($cName);
            if (empty($cName)) continue;
            
            $foundId = findSectionId($IBLOCK_ID, $cName, $subCatRaw);
            
            if (is_numeric($foundId)) {
                $targetSectionIds[] = $foundId;
            } elseif ($foundId === "PARENT_NOT_FOUND") {
                $catErrors[] = "Нет раздела '$cName'";
            } elseif ($foundId === "SUB_NOT_FOUND") {
                $catErrors[] = "В '$cName' нет подраздела '$subCatRaw'";
            }
        }
        $targetSectionIds = array_unique($targetSectionIds);
        sort($targetSectionIds);

        // Статус
        $status = '';
        $currentSectionIds = [];

        if (!$siteId) {
            $status = 'NEW_IN_EXCEL';
            $stats['new']++;
        } elseif (empty($targetSectionIds)) {
            // Если НЕ НАШЛОСЬ НИ ОДНОГО раздела вообще
            $status = 'ERROR_CAT';
            $stats['error']++;
        } else {
            // Если нашелся ХОТЯ БЫ ОДИН раздел
            
            // Получаем текущие разделы товара
            $dbGroups = CIBlockElement::GetElementGroups($siteId, true);
            while($g = $dbGroups->Fetch()) {
                $currentSectionIds[] = $g['ID'];
            }
            $currentSectionIds = array_unique($currentSectionIds);
            sort($currentSectionIds);

            // Сравниваем
            if ($currentSectionIds == $targetSectionIds) {
                $status = 'OK';
                $stats['ok']++;
            } else {
                $status = 'READY_MOVE'; // Переносим в те, что нашли
                $stats['move']++;
            }
        }
        
        if ($siteId) unset($arSiteProducts[$normName]);

        $arData[] = [
            'STATUS' => $status,
            'NAME' => $nameRaw,
            'SITE_ID' => $siteId,
            'ART' => $artRaw,
            'MEASURE' => $measureRaw,
            'TARGET_SECTIONS' => $targetSectionIds,
            'ERRORS' => $catErrors // Ошибки передаем даже при успешном статусе
        ];
    }

    // Сортировка
    usort($arData, function($a, $b) {
        $weights = ['READY_MOVE' => 1, 'ERROR_CAT' => 2, 'NEW_IN_EXCEL' => 3, 'OK' => 10];
        $wa = $weights[$a['STATUS']] ?? 5;
        $wb = $weights[$b['STATUS']] ?? 5;
        if ($wa == $wb) return 0;
        return ($wa < $wb) ? -1 : 1;
    });

} else {
    die("Файл не найден");
}

// --- ВЫПОЛНЕНИЕ ---
if ($isPost && $action == 'distribute') {
    $processed = 0;
    
    foreach ($arData as $item) {
        // Переносим всё, что имеет статус READY_MOVE
        // (значит там есть хотя бы 1 целевой раздел)
        if ($item['STATUS'] === 'READY_MOVE' && $item['SITE_ID']) {
            $PROD_ID = $item['SITE_ID'];
            
            // 1. Перенос (SetElementSection перезаписывает привязки)
            if (!empty($item['TARGET_SECTIONS'])) {
                CIBlockElement::SetElementSection($PROD_ID, $item['TARGET_SECTIONS']);
            }

            // 2. Свойства
            if (!empty($item['ART'])) {
                CIBlockElement::SetPropertyValuesEx($PROD_ID, $IBLOCK_ID, [
                    $PROP_ARTNUMBER_CODE => $item['ART']
                ]);
            }
            if (!empty($item['MEASURE'])) {
                $mId = getMeasureIdByName($item['MEASURE']);
                if ($mId) CCatalogProduct::Update($PROD_ID, ['MEASURE' => $mId]);
            }

            $processed++;
        }
    }
    
    echo "<div class='msg-success'><b>Готово!</b> Перемещено товаров: $processed. <br><a href='?'>Обновить список</a></div>";
    die();
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_after.php");
?>

<style>
    .log-table { width: 100%; border-collapse: collapse; font-size: 13px; background: #fff; }
    .log-table th, .log-table td { border: 1px solid #ccc; padding: 8px; }
    
    .row-move { background: #dff0d8; } 
    .row-error { background: #f2dede; color: #a94442; }
    .row-ok { color: #999; }
    .row-new { background: #f9f9f9; color: #999; }

    .msg-success { padding: 20px; background: #dff0d8; border: 1px solid #d6e9c6; color: #3c763d; margin-bottom: 20px;}
    .stats-box { padding: 15px; background: #f8f9fa; border: 1px solid #ddd; margin-bottom: 20px; }
    .badge { padding: 3px 6px; border-radius: 4px; color: #fff; font-size: 11px; }
    .bg-green { background: green; }
    .warn-text { color: #d58512; font-size: 11px; display: block; margin-top: 5px; }
</style>

<h2>Умное распределение (Частичное совпадение)</h2>

<div class="stats-box">
    <b>Статистика:</b><br>
    <span style="color:green; font-weight:bold">● Готовы к переносу (Найден хотя бы 1 раздел): <?= $stats['move'] ?></span><br>
    <span style="color:gray">● Уже на месте (ВЕРНО): <?= $stats['ok'] ?></span><br>
    <span style="color:red">● Ошибка (Ни один раздел не найден): <?= $stats['error'] ?></span><br>
    <span style="color:#777">● Нет на сайте: <?= $stats['new'] ?></span>
</div>

<form method="post" onsubmit="return confirm('Перенести <?= $stats['move'] ?> товаров в найденные разделы?');">
    <input type="hidden" name="action" value="distribute">
    
    <? if ($stats['move'] > 0): ?>
        <input type="submit" value="ВЫПОЛНИТЬ ПЕРЕНОС (<?= $stats['move'] ?> шт.)" class="adm-btn-save">
    <? else: ?>
        <input type="button" value="Нет товаров для переноса" disabled>
    <? endif; ?>
    
    <br><br>

    <table class="log-table">
        <thead>
            <tr>
                <th>Статус</th>
                <th>Товар</th>
                <th>Действие / Примечание</th>
            </tr>
        </thead>
        <tbody>
            <? foreach ($arData as $row): 
                $class = ''; $label = '';
                switch($row['STATUS']) {
                    case 'READY_MOVE': 
                        $class='row-move'; $label='<span class="badge bg-green">К ПЕРЕНОСУ</span>'; break;
                    case 'OK': 
                        $class='row-ok'; $label='ОК'; break;
                    case 'ERROR_CAT': 
                        $class='row-error'; $label='ОШИБКА'; break;
                    case 'NEW_IN_EXCEL': 
                        $class='row-new'; $label='НЕТ'; break;
                }
            ?>
            <tr class="<?= $class ?>">
                <td style="text-align:center"><?= $label ?></td>
                <td><?= htmlspecialchars($row['NAME']) ?></td>
                <td>
                    <? if ($row['STATUS'] == 'READY_MOVE'): ?>
                        <div>Будет привязан к ID: <b><?= implode(', ', $row['TARGET_SECTIONS']) ?></b></div>
                        <? if (!empty($row['ERRORS'])): ?>
                            <div class="warn-text">
                                ⚠ Не найдено (исключено):<br>
                                <?= implode('<br>', $row['ERRORS']) ?>
                            </div>
                        <? endif; ?>
                        
                    <? elseif ($row['STATUS'] == 'ERROR_CAT'): ?>
                        <b>Некуда переносить:</b><br>
                        <?= implode('<br>', $row['ERRORS']) ?>
                        
                    <? elseif ($row['STATUS'] == 'OK'): ?>
                        Лежит верно.
                        <? if (!empty($row['ERRORS'])): ?>
                            <br><span style="font-size:10px; color:#aaa">(Исключено: <?= implode('; ', $row['ERRORS']) ?>)</span>
                        <? endif; ?>
                    <? endif; ?>
                </td>
            </tr>
            <? endforeach; ?>
        </tbody>
    </table>
</form>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog.php"); ?>