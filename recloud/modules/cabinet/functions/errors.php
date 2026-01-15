<?
if (!defined('DATALIFEENGINE')) die("Error!");
/**
 * вывод ошибок на странице
 * =======================================================
 * Автор:	GamerVII
 * URL:  	https://vk.com/gamervii
 * email:	gamervii.phone@gmail.com
 * =======================================================
 * Файл:  errors.php
 * -------------------------------------------------------
 * Версия: 1.2.1 (05.07.2019)
 * =======================================================
 */

if (empty($errorTitle) && 	 empty($errorTitle)) {
	$errorTitle = $_COOKIE['errorTitle'];
	$errorInfo = $_COOKIE['errorInfo'];
	if (!empty($errorTitle) && !empty($errorTitle)) {
		echo "
		<div class='error_content' id='error_content'>
		<div class='error_content-close' onclick='hideme()'><i class='fas fa-times'></i></div>
		<div class='error_content-title'>".$errorTitle."</div>
		<div class='error_content-body'>".$errorInfo."</div>
		<div class='error__progress-bar'>
		<div class='progress' id='progress'></div>
		</div>
		</div>";
		$errorTitle = "";
		$errorInfo = "";
		setcookie("errorTitle", $errorTitle);
		setcookie("errorInfo", $errorInfo);
	}else{

	}
}else{

}
?>
