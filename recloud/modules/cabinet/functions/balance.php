<?php
if (!defined('DATALIFEENGINE')) die("Error!");

/**
 * Модуль пополнения баланса
 * =======================================================
 * Автор:	GamerVII
 * URL:  	https://vk.com/gamervii
 * email:	gamervii.phone@gmail.com
 * =======================================================
 * Файл:  balance.php
 * -------------------------------------------------------
 * Версия: 1.0.1 (04.07.2019)
 * =======================================================
 */

?>

<div class="cabinet-block__name"><div class="span"></div>Управление балансом</div>

<div class="row">
	<div class="col-xl-6 col-md-12 mt-4 mb-4">
		<div class="cabinet-balance__value"><?= $member_id['balance']?><span>руб.</span></div>
	</div>
	<div class="col-xl-6 col-md-12 mt-4 mb-4">
		<button type="button" class="cabinet-small-buttons" data-toggle="modal" data-target="#paycabinet"><i class="fas fa-plus"></i> Пополнить</button>
	</div>
</div>
