<?
/**
 * Функция загрузки скина на сервер
 * =======================================================
 * Автор:	GamerVII
 * URL:  	https://vk.com/gamervii
 * email:	gamervii.phone@gmail.com
 * =======================================================
 * Файл:  skinupload.php
 * -------------------------------------------------------
 * Версия: 1.2.2 (05.07.2019)
 * =======================================================
 */

if (!defined('DATALIFEENGINE')) die("Error!");

$privilage = $db->super_query("SELECT * FROM `cabinet_permissions` WHERE `name` = '{$member_id['name']}'");

$uploadHDSkin = $privilage['hd_skin'];

$redirect = "http://".$_SERVER['HTTP_HOST']."/cabinet.html";

if (isset($_FILES['skin'])) {

	$username = $member_id['name'];
	$fileName = $_FILES['skin']['name'];
	$fileSize = $_FILES['skin']['size'];
	$fileTmp = $_FILES['skin']['tmp_name'];
	$fileType = $_FILES['skin']['type'];
	$fileExt = strtolower(end(explode('.', $_FILES['skin']['name'])));
	$imageSkinInfo = getimagesize($_FILES['skin']['tmp_name']);

	if ($fileType == null) {
		dumpErrors("Ошибка", "Вы не выбрали файл для загрузки");
		header("Location: $redirect");
	}elseif ($fileType == "image/png") {
		if ($uploadHDSkin == 1) {
			if ($imageSkinInfo["0"] == "64" || $imageSkinInfo["0"] == "1024" || $imageSkinInfo["0"] == "256" || $imageSkinInfo["0"] == "1023" || $imageSkinInfo["0"] == "512") {
				if ($imageSkinInfo["1"] == "32" || $imageSkinInfo["1"] == "64" || $imageSkinInfo["1"] == "512" || $imageSkinInfo["1"] == "128" || $imageSkinInfo["1"] == "256") {
					move_uploaded_file($fileTmp, "./recloud/modules/cabinet/uploads/skins/". $username .".png");

					dumpErrors("Успешно", "Скин успешно загружен");
					header("Location: $redirect");
				}else{
					dumpErrors("Ошибка", "Неверный размер скина");
					header("Location: $redirect");
				}
			}else{
				dumpErrors("Ошибка", "Неверный размер скина");
				header("Location: $redirect");
			}
		}else{
			if ($imageSkinInfo["0"] == "64") {
				if ($imageSkinInfo["1"] == "32") {
					move_uploaded_file($fileTmp, "./recloud/modules/cabinet/uploads/skins/". $username .".png");

					dumpErrors("Успешно", "Скин успешно загружен");
					header("Location: $redirect");
				}else{
					dumpErrors("Ошибка", "Неверный размер скина, или вы пытаетесь загрузить HD скин");
					header("Location: $redirect");
				}
			}else{
				dumpErrors("Ошибка", "Неверный размер скина, или вы пытаетесь загрузить HD скин");
				header("Location: $redirect");
			}
		}
	}else{
		dumpErrors("Ошибка", "Файл должен быть в формате png");
		header("Location: $redirect");
	}

}

?>

<form id="skinUpload" action method="post" enctype="multipart/form-data">
	<div class="row cabinet-file-upload">
		<div class="col-xl-6 col-md-12">
			<div class="cabinet-form-group">
				<input type="file" name="skin" id="sortpictureSkin" class="input-file">
				<label for="sortpictureSkin" class="cabinet-file js-labelFile mb-2">
					<span class="js-fileName">Выбрать скин</span>
				</label>
			</div>
		</div>
		<div class="col-xl-6 col-md-12">
			<input id="uploadSkin" type="submit" value="Загрузить" class="cabinet-buttons">
		</div>
	</div>
</form>
