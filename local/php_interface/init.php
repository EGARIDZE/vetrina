<?php
use Bitrix\Main\EventManager;

EventManager::getInstance()->addEventHandler(
    'main',
    'OnBuildGlobalMenu',
    'addImportAdminMenu'
);

function addImportAdminMenu(&$aGlobalMenu, &$aModuleMenu)
{
    global $USER;

    if (!$USER->IsAdmin()) {
        return;
    }

    $aGlobalMenu['global_menu_import'] = [
        'menu_id'   => 'import',
        'text'      => 'Импорт',
        'title'     => 'Импорт данных',
        'sort'      => 500,
        'items_id'  => 'global_menu_import',
        'icon'      => 'iblock_menu_icon',
        'page_icon' => 'iblock_page_icon',
        'items'     => [],
    ];

    $aGlobalMenu['global_menu_import']['items'][] = [
        'text'  => 'Импорт товаров (Excel)',
        'title'=> 'Загрузка Excel в очередь',
        'url'   => '/bitrix/admin/import_products.php',
        'sort'  => 10,
    ];

    $aGlobalMenu['global_menu_import']['items'][] = [
        'text'  => 'Очередь импорта',
        'title'=> 'Просмотр очереди',
        'url'   => '/bitrix/admin/import_products_batch.php',
        'sort'  => 20,
    ];
}
