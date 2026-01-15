<?
if (!defined('DATALIFEENGINE')) die("Error!");

/**
 * Функция вывода блоков возможностей
 * =======================================================
 * Автор:	GamerVII
 * URL:  	https://vk.com/gamervii
 * email:	gamervii.phone@gmail.com
 * =======================================================
 * Файл:  rights.php
 * -------------------------------------------------------
 * Версия: 1.0.1 (04.07.2019)
 * =======================================================
 */

$redirect = "http://".$_SERVER['HTTP_HOST']."/cabinet.html";
$pexlist = $db->super_query("SELECT * FROM `cabinet_permissions` WHERE `name` = '{$name}'");

$usercheck = $database->query("SELECT true FROM `cabinet_permissions` WHERE name = '". $name ."'");

if (empty($usercheck)) {

  $database->query("INSERT INTO `cabinet_permissions` (`name`, `hd_skin`, `cloak`, `hd_cloak`) VALUES ('". $name ."', '0', '0', '0')");

}

if (isset($_POST['hd_skin_pay'])) {

	$price = $cabinet_config['rights']['hd_skin_price'];

	if ($balance < $price) {
		dumpErrors("Ошибка", "На вашем счету недостаточно средств для покупки HD скина");
		header("Location: $redirect");
		return false;
	}

	$new_balance = $balance - $price;

	$query1 = $database->query("UPDATE `dle_users` SET `balance` = '{$new_balance}' WHERE `name` = '{$name}';");
	$query2 = $database->query("UPDATE `cabinet_permissions` SET `hd_skin` = '1' WHERE `name` = '{$name}'");

	if ($query1 != true || $query2 != true) {
		dumpErrors("Ошибка", "Что-то пошло не так, запрос не был проведён");
		header("Location: $redirect");
	}

	dumpErrors("Успешно", "Вы приобрели возможность загружать HD скин");
	header("Location: $redirect");


}

if (isset($_POST['cloak_pay'])) {

	$price = $cabinet_config['rights']['cloak_price'];

	if ($balance < $price) {
		dumpErrors("Ошибка", "На вашем счету недостаточно средств для покупки плаща");
		header("Location: $redirect");
		return false;
	}

	$new_balance = $balance - $price;

	$database->query("UPDATE `dle_users` SET `balance` = '{$new_balance}' WHERE `name` = '{$name}';");
	$database->query("UPDATE `cabinet_permissions` SET `cloak` = '1' WHERE `name` = '{$name}'");

	dumpErrors("Успешно", "Вы приобрели возможность загружать плащ");
	header("Location: $redirect");

}


if (isset($_POST['hd_cloak_pay'])) {

	$price = $cabinet_config['rights']['hd_cloak_price'];

	if ($pexlist['cloak'] == 0) {
		dumpErrors("Ошибка", "Для начала купите возможность загружать плащ");
		header("Location: $redirect");
		return false;
	}

	if ($balance < $price) {
		dumpErrors("Ошибка", "На вашем счету недостаточно средств для покупки HD плаща");
		header("Location: $redirect");
		return false;
	}

	$new_balance = $balance - $price;

	$database->query("UPDATE `dle_users` SET `balance` = '{$new_balance}' WHERE `name` = '{$name}';");
	$database->query("UPDATE `cabinet_permissions` SET `hd_cloak` = '1' WHERE `name` = '{$name}'");

	dumpErrors("Успешно", "Вы приобрели возможность загружать HD плащ");
	header("Location: $redirect");

}

?>
<div class="text-left">

	<div class="cabinet-block__name"><div class="span"></div>Возможности</div>

	<table class="table table-borderless cabinet-table">
		<tbody>

			<tr>
				<th scope="col" class="ml-5" width="170px">Загружать HD скин</th>
				<td>

					<?
					if ($pexlist['hd_skin'] == 1) {
						echo "<i class='fas fa-check'></i>";
					}else{
						echo "<form action method='POST'><input type='submit' class='cabinet-small-buttons cabinet-buttons__rights' name='hd_skin_pay' value='Купить за ". $cabinet_config['rights']['hd_skin_price'] ." руб.'></form>";
					}
					?>

				</td>
			</tr>

			<tr>
				<th scope="col" class="ml-5" width="170px">Загружать плащ</th>
				<td>

					<?
					if ($pexlist['cloak'] == 1) {
						echo "<i class='fas fa-check'></i>";
					}else{
						echo "<form action method='POST'><input type='submit' class='cabinet-small-buttons cabinet-buttons__rights' name='cloak_pay' value='Купить за ". $cabinet_config['rights']['cloak_price'] ." руб.'></form>";
					}
					?>

				</td>
			</tr>

			<tr>
				<th scope="col" class="ml-5" width="170px">Загружать HD плащ</th>
				<td>

					<?
					if ($pexlist['hd_cloak'] == 1) {
						echo "<i class='fas fa-check'></i>";
					}else{
						echo "<form action method='POST'><input type='submit' class='cabinet-small-buttons cabinet-buttons__rights' name='hd_cloak_pay' value='Купить за ". $cabinet_config['rights']['hd_cloak_price'] ." руб.'></form>";
					}
					?>

				</td>
			</tr>

		</tbody>
	</table>

</div>
