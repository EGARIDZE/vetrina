<?php
define('NO_KEEP_STATISTIC', true);
define('NO_AGENT_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

use Bitrix\Main\Context;
use Bitrix\Sale\Basket;
use Bitrix\Sale\Fuser;
use Bitrix\Main\Loader;
use Bitrix\Main\Web\Json;

if (!check_bitrix_sessid()) {
    die(Json::encode(['status' => 'error', 'message' => 'Invalid session']));
}

if (!Loader::includeModule('sale') || !Loader::includeModule('catalog')) {
    die(Json::encode(['status' => 'error', 'message' => 'Modules not loaded']));
}

$request = Context::getCurrent()->getRequest();
$result = [];

if ($request->isPost() && $request->isAjaxRequest()) {
    try {
        $productId = (int) $request->get('productId');
        $quantity = (float) $request->get('quantity');

        if ($productId <= 0) {
            throw new \Exception('Invalid product ID');
        }

        $basket = Basket::loadItemsForFUser(Fuser::getId(), Context::getCurrent()->getSite());

        // --- КЛЮЧЕВОЕ ИСПРАВЛЕНИЕ ---
        // Ищем существующий элемент корзины по ID товара
        $targetBasketItem = null;
        /** @var \Bitrix\Sale\BasketItem $basketItem */
        foreach ($basket as $basketItem) {
            if ($basketItem->getProductId() == $productId) {
                $targetBasketItem = $basketItem;
                break;
            }
        }

        if ($targetBasketItem) {
            // Если товар НАЙДЕН в корзине, работаем с ним
            if ($quantity > 0) {
                // Обновляем количество
                $saveResult = $targetBasketItem->setField('QUANTITY', $quantity);
            } else {
                // Если количество 0 или меньше - удаляем товар
                $saveResult = $targetBasketItem->delete();
            }

            if (!$saveResult->isSuccess()) {
                // Если не удалось установить поле или удалить, добавляем ошибки в общий результат
                $result['message'] = implode('; ', $saveResult->getErrorMessages());
            }

        } else {
            // Если товар НЕ НАЙДЕН, ничего не делаем и возвращаем ошибку.
            // Этот скрипт не должен добавлять новые товары.
            throw new \Exception('Product not found in basket. Cannot update.');
        }

        // Сохраняем всю корзину после всех манипуляций
        $saveResult = $basket->save();
        if ($saveResult->isSuccess()) {
            $result['status'] = 'success';
        } else {
            $result['status'] = 'error';
            // Добавляем ошибки сохранения корзины к уже существующим (если они были)
            $result['message'] = ($result['message'] ? $result['message'] . '; ' : '') . implode('; ', $saveResult->getErrorMessages());
        }

    } catch (\Exception $e) {
        $result['status'] = 'error';
        $result['message'] = $e->getMessage();
    }
} else {
    $result['status'] = 'error';
    $result['message'] = 'Invalid request';
}

header('Content-Type: application/json');
echo Json::encode($result);
die();