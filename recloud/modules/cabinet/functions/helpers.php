<?php
/**
 * Общие helper-функции (PHP 8.3)
 */

if (!defined('DATALIFEENGINE')) {
    exit;
}

function cabinet_redirect(string $url): void {
    header("Location: {$url}");
    exit;
}

function cabinet_post(string $key): ?string {
    return isset($_POST[$key]) && is_string($_POST[$key])
        ? trim($_POST[$key])
        : null;
}
