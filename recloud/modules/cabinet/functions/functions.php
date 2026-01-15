<?php
if (!defined('DATALIFEENGINE')) die("Error!");
if (!defined('DATALIFEENGINE')) {
    http_response_code(403);
    exit('Access denied');
}

if (!isset($member_id['name'])) {
    header("Location: /");
    exit;
}


function dumpErrors($title, $value)
{

	setcookie("errorTitle", $title);
	setcookie("errorInfo", $value);

}


?>
