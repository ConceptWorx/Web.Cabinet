<?php
if (!defined('DATALIFEENGINE')) die("Error!");

function dumpErrors($title, $value)
{

	setcookie("errorTitle", $title);
	setcookie("errorInfo", $value);

}


?>
