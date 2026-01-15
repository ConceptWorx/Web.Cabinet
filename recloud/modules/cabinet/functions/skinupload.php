<?php
/**
 * Загрузка скина (PHP 8.3 compatible)
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

// Проверка файла
if (
    !isset($_FILES['skin']) ||
    $_FILES['skin']['error'] !== UPLOAD_ERR_OK ||
    empty($_FILES['skin']['tmp_name'])
) {
    dumpErrors("Ошибка", "Файл не был загружен");
    header("Location: $redirect");
    exit;
}

// MIME-проверка
$mime = mime_content_type($_FILES['skin']['tmp_name']);
if ($mime !== 'image/png') {
    dumpErrors("Ошибка", "Файл должен быть в формате PNG");
    header("Location: $redirect");
    exit;
}

// Проверка изображения
$imageInfo = getimagesize($_FILES['skin']['tmp_name']);
if ($imageInfo === false) {
    dumpErrors("Ошибка", "Файл не является изображением");
    header("Location: $redirect");
    exit;
}

$width  = (int)$imageInfo[0];
$height = (int)$imageInfo[1];

// Права пользователя
$name = $db->safesql($member_id['name']);
$privilage = $db->super_query("SELECT * FROM cabinet_permissions WHERE name='{$name}'");
$uploadHDSkin = (int)($privilage['hd_skin'] ?? 0);

// Проверка размеров
$allowed = false;

if ($uploadHDSkin === 1) {
    $allowedWidths  = [64, 128, 256, 512, 1024];
    $allowedHeights = [32, 64, 128, 256, 512];

    if (in_array($width, $allowedWidths, true) && in_array($height, $allowedHeights, true)) {
        $allowed = true;
    }
} else {
    if ($width === 64 && $height === 32) {
        $allowed = true;
    }
}

if (!$allowed) {
    dumpErrors("Ошибка", "Неверный размер скина");
    header("Location: $redirect");
    exit;
}

// Сохранение
$targetDir = ROOT_DIR . "/recloud/modules/cabinet/uploads/skins/";
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0755, true);
}

$targetFile = $targetDir . $member_id['name'] . ".png";

if (!move_uploaded_file($_FILES['skin']['tmp_name'], $targetFile)) {
    dumpErrors("Ошибка", "Не удалось сохранить файл");
    header("Location: $redirect");
    exit;
}

dumpErrors("Успешно", "Скин успешно загружен");
header("Location: $redirect");
exit;
