<?php
/**
 * Загрузка плаща (PHP 8.3 compatible)
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
    !isset($_FILES['cloak']) ||
    $_FILES['cloak']['error'] !== UPLOAD_ERR_OK ||
    empty($_FILES['cloak']['tmp_name'])
) {
    dumpErrors("Ошибка", "Файл не был загружен");
    header("Location: $redirect");
    exit;
}

// MIME
$mime = mime_content_type($_FILES['cloak']['tmp_name']);
if ($mime !== 'image/png') {
    dumpErrors("Ошибка", "Файл должен быть в формате PNG");
    header("Location: $redirect");
    exit;
}

// Изображение
$imageInfo = getimagesize($_FILES['cloak']['tmp_name']);
if ($imageInfo === false) {
    dumpErrors("Ошибка", "Файл не является изображением");
    header("Location: $redirect");
    exit;
}

$width  = (int)$imageInfo[0];
$height = (int)$imageInfo[1];

// Проверка размера плаща (Minecraft)
if (!(($width === 64 && $height === 32) || ($width === 64 && $height === 64))) {
    dumpErrors("Ошибка", "Неверный размер плаща");
    header("Location: $redirect");
    exit;
}

// Сохранение
$targetDir = ROOT_DIR . "/recloud/modules/cabinet/uploads/cloaks/";
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0755, true);
}

$targetFile = $targetDir . $member_id['name'] . ".png";

if (!move_uploaded_file($_FILES['cloak']['tmp_name'], $targetFile)) {
    dumpErrors("Ошибка", "Не удалось сохранить файл");
    header("Location: $redirect");
    exit;
}

dumpErrors("Успешно", "Плащ успешно загружен");
header("Location: $redirect");
exit;
