<?php
/**
 * Права пользователя (PHP 8.3 compatible)
 */

if (!defined('DATALIFEENGINE')) {
    http_response_code(403);
    exit('Access denied');
}

if (!isset($member_id['name'])) {
    exit;
}

$name = $db->safesql($member_id['name']);

$perm = $db->super_query("SELECT * FROM cabinet_permissions WHERE name='{$name}'");

if (!$perm) {
    // Создаём дефолтные права
    $db->query("
        INSERT INTO cabinet_permissions 
        (name, hd_skin, hd_cloak) 
        VALUES 
        ('{$name}', 0, 0)
    ");

    $perm = [
        'hd_skin'  => 0,
        'hd_cloak' => 0,
    ];
}

// Гарантия типов
$perm['hd_skin']  = (int)$perm['hd_skin'];
$perm['hd_cloak'] = (int)$perm['hd_cloak'];
