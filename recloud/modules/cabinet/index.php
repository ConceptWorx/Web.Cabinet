<?php
/**
 * Личный кабинет — основной файл
 * PHP 8.3 compatible
 */

if (!defined('DATALIFEENGINE')) {
    http_response_code(403);
    exit('Access denied');
}

if (!isset($member_id['name'])) {
    header("Location: /");
    exit;
}

// ------------------------------------------------------------------
// Константы и пути
// ------------------------------------------------------------------
define('CABINET_DIR', ROOT_DIR . '/recloud/modules/cabinet');
define('CABINET_URL', '/index.php?do=static&page=cabinet');

$username = $member_id['name'];
$name     = $db->safesql($username);

// ------------------------------------------------------------------
// Подключение функций
// ------------------------------------------------------------------
require_once CABINET_DIR . '/functions/helpers.php';
require_once CABINET_DIR . '/functions/permissions.php';

// Дополнительные функции подключаем по необходимости
$action = $_GET['action'] ?? null;

switch ($action) {
    case 'upload_skin':
        require_once CABINET_DIR . '/functions/skinupload.php';
        return;

    case 'upload_cloak':
        require_once CABINET_DIR . '/functions/cloakupload.php';
        return;

    case 'balance':
        require_once CABINET_DIR . '/functions/balance.php';
        return;
}

// ------------------------------------------------------------------
// Получение данных пользователя
// ------------------------------------------------------------------

// Баланс
$balanceRow = $db->super_query("SELECT balance FROM cabinet_balance WHERE name='{$name}'");
$balance = isset($balanceRow['balance']) ? (float)$balanceRow['balance'] : 0.0;

// Права (из permissions.php)
$hdSkin  = (int)($perm['hd_skin'] ?? 0);
$hdCloak = (int)($perm['hd_cloak'] ?? 0);

// ------------------------------------------------------------------
// Проверка файлов пользователя
// ------------------------------------------------------------------
$skinPath  = CABINET_DIR . '/uploads/skins/' . $username . '.png';
$cloakPath = CABINET_DIR . '/uploads/cloaks/' . $username . '.png';

$hasSkin  = is_file($skinPath);
$hasCloak = is_file($cloakPath);

// ------------------------------------------------------------------
// Передача данных в шаблон
// ------------------------------------------------------------------
$cabinetData = [
    'username'  => htmlspecialchars($username, ENT_QUOTES, 'UTF-8'),
    'balance'   => number_format($balance, 2, '.', ''),
    'hd_skin'   => $hdSkin,
    'hd_cloak'  => $hdCloak,
    'has_skin'  => $hasSkin,
    'has_cloak' => $hasCloak,
];

// Регистрируем переменные в DLE
foreach ($cabinetData as $key => $value) {
    $tpl->set("{cabinet.$key}", (string)$value);
}

// ------------------------------------------------------------------
// Подключение шаблона
// ------------------------------------------------------------------
$tpl->load_template('cabinet.tpl');
$tpl->compile('cabinet');
$tpl->clear();

// Вывод
echo $tpl->result['cabinet'];
