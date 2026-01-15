<?php if (!defined('DATALIFEENGINE')) die("Error!");
/**
 * Функция вывода скина пользователя
 * =======================================================
 * Автор:	GamerVII
 * URL:  	https://vk.com/gamervii
 * email:	gamervii.phone@gmail.com
 * =======================================================
 * Файл:  2Dskinviewer.php
 * -------------------------------------------------------
 * Версия: 1.0.1 (03.07.2019)
 * =======================================================
 */
?>
<div class="row">


	<!--
		=========================
			Скин: Вид спереди
		=========================
	-->
	<div class="col-xl-6 col-sm-12 mb-2">
		<div class="skin-viewer__view skin-viewer__back text-center">
			<img src="recloud/modules/cabinet/skin.php?user=<?= $member_id['name'] ?>&mode=1&size=140" alt="Скин спереди" class="skin-viewer__view__img">
		</div>
	</div>

	<!--
		=========================
			Скин: Вид сзади
		=========================
	-->
	<div class="col-xl-6 col-sm-12 mb-2">
		<div class="skin-viewer__view skin-viewer__front text-center">
			<img src="recloud/modules/cabinet/skin.php?user=<?= $member_id['name'] ?>&mode=2&size=140" alt="Скин сзади" class="skin-viewer__view__img">
		</div>
	</div>

</div>
