<?php
if (!defined('DATALIFEENGINE')) die("Error!");
/**
 * Функция загрузки плаща на сервер
 * =======================================================
 * Автор:	GamerVII
 * URL:  	https://vk.com/gamervii
 * email:	gamervii.phone@gmail.com
 * =======================================================
 * Файл:  cloakupload.php
 * -------------------------------------------------------
 * Версия: 1.0.2 (05.07.2019)
 * =======================================================
 */
$privilage = $db->super_query("SELECT * FROM `cabinet_permissions` WHERE `name` = '{$member_id['name']}'");

$uploadCloak = $privilage['cloak'];
$uploadHDCloak = $privilage['hd_cloak'];

$redirect = "http://".$_SERVER['HTTP_HOST']."/cabinet.html";

if (isset($_FILES['cloak'])) {

	$username = $member_id['name'];
	$fileName = $_FILES['cloak']['name'];
	$fileSize = $_FILES['cloak']['size'];
	$fileTmp = $_FILES['cloak']['tmp_name'];
	$fileType = $_FILES['cloak']['type'];
	$fileExt = strtolower(end(explode('.', $_FILES['cloak']['name'])));
	$imageCloakInfo = getimagesize($_FILES['cloak']['tmp_name']);

	if ($fileType == null) {
		dumpErrors("Ошибка", "Вы не выбрали файл для загрузки");
		header("Location: $redirect");
	}elseif ($fileType == "image/png") {
		if ($uploadCloak == 1) {
			if ($uploadHDCloak == 1) {
				if ($imageCloakInfo["0"] == "1024" || $imageCloakInfo["0"] == "256" || $imageCloakInfo["0"] == "512" || $imageCloakInfo["0"] == "64") {
					if ($imageCloakInfo["1"] == "512" || $imageCloakInfo["1"] == "128" || $imageCloakInfo["1"] == "256" || $imageCloakInfo["1"] == "32") {
						move_uploaded_file($fileTmp, "./recloud/modules/cabinet/uploads/cloaks/". $username .".png");

						dumpErrors("Успешно", "Плащ загружен");
						header("Location: $redirect");
					}else{
						dumpErrors("Ошибка", "Неверный размер плаща");
						header("Location: $redirect");
					}
				}else{
					dumpErrors("Ошибка", "Неверный размер плаща");
					header("Location: $redirect");
				}
			}elseif ($imageCloakInfo["0"] == "64") {
				if ($imageCloakInfo["1"] == "32") {
					move_uploaded_file($fileTmp, "./recloud/modules/cabinet/uploads/cloaks/". $username .".png");

					dumpErrors("Успешно", "Плащ загружен");
					header("Location: $redirect");
				}else{
					dumpErrors("Ошибка", "Неверный размер скина, или вы пытаетесь установить HD плащ");
					header("Location: $redirect");
				}
			}else{
				dumpErrors("Ошибка", "Неверный размер скина, или вы пытаетесь установить HD плащ");
				header("Location: $redirect");
			}
		}else{
			dumpErrors("Ошибка", "Вы не можете загружать плащ");
			header("Location: $redirect");
		}
	}else{
		dumpErrors("Ошибка", "Файл должен быть в формате png");
		header("Location: $redirect");
	}
}
?>

<form action method="post" enctype="multipart/form-data">
	<div class="row cabinet-file-upload">
		<div class="col-xl-6 col-md-12">
			<div class="cabinet-form-group">
				<input type="file" name="cloak" class="input-file__cloak">
				<label for="file" class="cabinet-file js-labelFile mb-2">
					<span class="js-fileName">Выбрать Плащ</span>
				</label>
			</div>
		</div>
		<div class="col-xl-6 col-md-12">
			<input type="submit" value="Загрузить" class="cabinet-buttons">
		</div>
	</div>
</form>
