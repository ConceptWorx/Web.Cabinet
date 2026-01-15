<?

/**
 * Скрипт успешного пополнения
 * =======================================================
 * Автор:	GamerVII 
 * URL:  	https://vk.com/gamervii
 * email:	gamervii.phone@gmail.com
 * =======================================================
 * Файл:  success.php
 * -------------------------------------------------------
 * Версия: 1.1.1 (5.07.2019)
 * =======================================================
 */

include 'config.php';

if (!defined('DATALIFEENGINE')) die("Error!");

require "{$_SERVER['DOCUMENT_ROOT']}/recloud/modules/cabinet/core/class/class.connect.php";
$database = new Database();

// регистрационная информация (пароль #1)
$mrh_pass1 = $config['paysettings']['roboPassOne'];

// чтение параметров
$out_summ = $_REQUEST["OutSum"];
$inv_id = $_REQUEST["InvId"];
$crc = $_REQUEST["SignatureValue"];
$login = $_REQUEST["shp_login"];
$pay_id = $_REQUEST["shp_id"];
$redirect = "http://".$_SERVER['HTTP_HOST']."/cabinet.html";

$crc = strtoupper($crc);

$my_crc = strtoupper(md5("$out_summ:$inv_id:$mrh_pass1:shp_id=$pay_id:shp_login=$login"));

// проверка корректности подписи
if ($my_crc != $crc)
{
	echo "bad sign\n";
	exit();
}

// проверка наличия номера счета в истории операций
if ($_REQUEST) {
	$pay_resault = $db->super_query("SELECT * FROM `dle_users` WHERE `name` = '{$login}'");

	$name = $pay_resault['name'];
	$balance = $pay_resault['money'];
	$out_summ = round($out_summ);
	$new_balance = $balance + $out_summ;
	$pay_time = time();

	$db->super_query("UPDATE `dle_users` SET `balance` = '{$new_balance}' WHERE `dle_users`.`name` = '{$name}'");
	$db->super_query("UPDATE `cabinet_pay_logs` SET `status` = 'paid' WHERE `cabinet_pay_logs`.`name` = '{$name}'");
	$db->super_query("UPDATE `cabinet_pay_logs` SET `pay_date_success` = '{$pay_time}' WHERE `cabinet_pay_logs`.`id` = '{$pay_id}'");

	dumpErrors("Успешно", "Вы успешно пополнили баланс $out_summ монет");
	header("Location: $redirect");

}
?>


