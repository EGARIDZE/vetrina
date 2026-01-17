<?php
// Подключаем "пролог" Битрикса, но без вывода HTML
define('NO_KEEP_STATISTIC', true);
define('NO_AGENT_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true); // Разрешаем доступ всем
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

use Bitrix\Main\Context;
use Bitrix\Sale\Basket;
use Bitrix\Sale\Fuser;
use Bitrix\Main\Loader;
use Bitrix\Main\Web\Json;

// Обязательно проверяем, что сессия корректна
if (!check_bitrix_sessid()) {
    die(Json::encode(['error' => 'Invalid session']));
}

// Подключаем необходимые модули
if (!Loader::includeModule('sale') || !Loader::includeModule('catalog')) {
    die(Json::encode(['error' => 'Modules not loaded']));
}

$request = Context::getCurrent()->getRequest();
$result = [];

if ($request->isAjaxRequest()) {
    try {
        // Получаем корзину текущего пользователя
        $basket = Basket::loadItemsForFUser(Fuser::getId(), Context::getCurrent()->getSite());
        $basketItems = $basket->getBasketItems();

        $itemsData = [];
        foreach ($basketItems as $item) {
            $itemsData[] = [
                'PRODUCT_ID' => $item->getProductId(),
                'QUANTITY' => $item->getQuantity(),
            ];
        }

        $result['status'] = 'success';
        $result['data'] = $itemsData;

    } catch (\Exception $e) {
        $result['status'] = 'error';
        $result['message'] = $e->getMessage();
    }
} else {
    $result['status'] = 'error';
    $result['message'] = 'Not an ajax request';
}

// Устанавливаем заголовок, что ответ в формате JSON
header('Content-Type: application/json');
// Выводим результат в формате JSON и завершаем работу скрипта
echo Json::encode($result);
die();