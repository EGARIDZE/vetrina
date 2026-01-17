<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable;

/** @var array $arParams */
/** @var array $arResult */

if (!Loader::includeModule('highloadblock') || !Loader::includeModule('iblock')) {
    return;
}

// 1. Находим свойства типа "Справочник" (HLBlock)
$hlProperties = [];
$valuesToFetch = [];

foreach ($arResult['ITEMS'] as $item) {
    if (empty($item['OFFERS']))
        continue;
    foreach ($item['OFFERS'] as $offer) {
        foreach ($offer['PROPERTIES'] as $prop) {
            if ($prop['USER_TYPE'] === 'directory' && !empty($prop['VALUE'])) {
                if (!isset($hlProperties[$prop['ID']])) {
                    $tableName = '';
                    if (!empty($prop['USER_TYPE_SETTINGS']['TABLE_NAME'])) {
                        $tableName = $prop['USER_TYPE_SETTINGS']['TABLE_NAME'];
                    } else {
                        $propRes = \CIBlockProperty::GetByID($prop['ID']);
                        if ($p = $propRes->Fetch()) {
                            $tableName = $p['USER_TYPE_SETTINGS']['TABLE_NAME'];
                        }
                    }
                    $hlProperties[$prop['ID']] = $tableName;
                }

                $tableName = $hlProperties[$prop['ID']];
                if ($tableName) {
                    $vals = is_array($prop['VALUE']) ? $prop['VALUE'] : [$prop['VALUE']];
                    foreach ($vals as $v)
                        $valuesToFetch[$tableName][$v] = true;
                }
            }
        }
    }
}

// 2. Получаем названия и СОРТИРОВКУ из базы
$hlDataMap = [];
foreach ($valuesToFetch as $tableName => $xmlIds) {
    $hlblock = HighloadBlockTable::getList(['filter' => ['=TABLE_NAME' => $tableName]])->fetch();
    if ($hlblock) {
        $entity = HighloadBlockTable::compileEntity($hlblock);
        $entityClass = $entity->getDataClass();

        $rsData = $entityClass::getList([
            'select' => ['UF_NAME', 'UF_XML_ID', 'UF_SORT'],
            'filter' => ['=UF_XML_ID' => array_keys($xmlIds)]
        ]);

        while ($el = $rsData->fetch()) {
            $hlDataMap[$tableName][$el['UF_XML_ID']] = [
                'NAME' => $el['UF_NAME'],
                'SORT' => (int) ($el['UF_SORT'] ?? 100)
            ];
        }
    }
}

// 3. Собираем SKU_PROPS и ГЕНЕРИРУЕМ TREE
$propCodeToId = [];
foreach ($arResult['ITEMS'] as $item) {
    if (!empty($item['OFFERS'])) {
        foreach ($item['OFFERS'][0]['PROPERTIES'] as $code => $prop) {
            if (isset($prop['ID']))
                $propCodeToId[$code] = $prop['ID'];
        }
        break;
    }
}

foreach ($arResult['ITEMS'] as &$item) {
    if (empty($item['OFFERS']))
        continue;

    $skuProps = [];
    $offerTreeProps = $arParams['OFFER_TREE_PROPS'] ?? [];

    foreach ($offerTreeProps as $propCode) {
        $propId = is_numeric($propCode) ? $propCode : ($propCodeToId[$propCode] ?? null);
        if (!$propId)
            continue;

        $propName = $item['OFFERS'][0]['PROPERTIES'][$propCode]['NAME'] ?? $propCode;

        foreach ($item['OFFERS'] as &$offer) {
            $propData = $offer['PROPERTIES'][$propCode] ?? null;
            if (!$propData || empty($propData['VALUE']))
                continue;

            $valueId = is_array($propData['VALUE']) ? reset($propData['VALUE']) : $propData['VALUE'];

            if (!isset($offer['TREE'])) {
                $offer['TREE'] = [];
            }
            $offer['TREE']['PROP_' . $propId] = $valueId;

            $displayName = $valueId;
            $sortOrder = 500;

            if ($propData['USER_TYPE'] === 'directory') {
                $tableName = $hlProperties[$propId] ?? null;
                if ($tableName && isset($hlDataMap[$tableName][$valueId])) {
                    $displayName = $hlDataMap[$tableName][$valueId]['NAME'];
                    $sortOrder = $hlDataMap[$tableName][$valueId]['SORT'];
                }
            } else {
                $displayName = $valueId;
            }

            // --- НОВОЕ: Получаем цену и доступность для этого значения ---
            $price = '';
            if (!empty($offer['ITEM_PRICES'])) {
                $priceIndex = $offer['ITEM_PRICE_SELECTED'] ?? 0;
                $price = $offer['ITEM_PRICES'][$priceIndex]['PRINT_PRICE'] ?? '';
            }
            $canBuy = $offer['CAN_BUY'];
            // -------------------------------------------------------------

            if (!isset($skuProps[$propCode])) {
                $skuProps[$propCode] = [
                    'ID' => $propId,
                    'CODE' => $propCode,
                    'NAME' => $propName,
                    'VALUES' => []
                ];
            }

            if (!isset($skuProps[$propCode]['VALUES'][$valueId])) {
                $skuProps[$propCode]['VALUES'][$valueId] = [
                    'ID' => $valueId,
                    'NAME' => $displayName,
                    'SORT' => $sortOrder,
                    'SELECTED' => false,
                    'PRICE' => $price,   // Сохраняем цену
                    'CAN_BUY' => $canBuy // Сохраняем доступность
                ];
            }
        }
        unset($offer);
    }

    // 4. СОРТИРУЕМ ЗНАЧЕНИЯ
    foreach ($skuProps as &$prop) {
        if (!empty($prop['VALUES'])) {
            uasort($prop['VALUES'], function ($a, $b) {
                if ($a['SORT'] == $b['SORT'])
                    return 0;
                return ($a['SORT'] < $b['SORT']) ? -1 : 1;
            });

            $k = array_key_first($prop['VALUES']);
            $prop['VALUES'][$k]['SELECTED'] = true;
        }
    }
    unset($prop);

    $item['SKU_PROPS'] = $skuProps;
}
unset($item);
?>