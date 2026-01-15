<?php
/**
 * Работа с балансом (PHP 8.3 compatible)
 */

if (!defined('DATALIFEENGINE')) {
    http_response_code(403);
    exit('Access denied');
}

if (!isset($member_id['name'])) {
    header("Location: /");
    exit;
}

$redirect = CABINET_URL;

$name = $db->safesql($member_id['name']);

// Получаем баланс
$user = $db->super_query("SELECT balance FROM cabinet_balance WHERE name='{$name}'");

$balance = isset($user['balance']) ? (float)$user['balance'] : 0.0;

// Пополнение (пример)
if (isset($_POST['amount'])) {

    $amount = (float)$_POST['amount'];

    if ($amount <= 0) {
        dumpErrors("Ошибка", "Некорректная сумма");
        header("Location: $redirect");
        exit;
    }

    // Обновление баланса
    if ($user) {
        $db->query("UPDATE cabinet_balance SET balance = balance + {$amount} WHERE name='{$name}'");
    } else {
        $db->query("INSERT INTO cabinet_balance (name, balance) VALUES ('{$name}', {$amount})");
    }

    dumpErrors("Успешно", "Баланс пополнен");
    header("Location: $redirect");
    exit;
}
