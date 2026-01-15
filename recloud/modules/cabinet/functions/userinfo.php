<?php if (!defined('DATALIFEENGINE')) die("Error!");

/**
 * Вывод информации о пользователе
 * =======================================================
 * Автор:	GamerVII
 * URL:  	https://vk.com/gamervii
 * email:	gamervii.phone@gmail.com
 * =======================================================
 * Файл:  userinfo.php
 * -------------------------------------------------------
 * Версия: 1.0.1 (03.07.2019)
 * =======================================================
 */
?>
<div class="text-left">

	<div class="cabinet-block__name"><div class="span"></div>Информация</div>

	<table class="table table-borderless cabinet-table">
		<tbody>

			<tr>
				<th scope="col" class="ml-5" width="170px">Ваш ник:</th>
				<td><?= $name ?></td>
			</tr>

			<tr>
				<th scope="col" class="ml-5" width="170px">Статус</th>
				<td>Игрок</td>
			</tr>

			<tr>
				<th scope="col" class="ml-5" width="170px">Ваша почта:</th>
				<td><?= $member_id['email'] ?></td>
			</tr>

			<tr>
				<th scope="col" class="ml-5" width="170px">Ваш баланс:</th>
				<td><?= $balance ?> рублей</td>
			</tr>

			<tr>
				<th scope="col" class="ml-5" width="170px">Дата регистрации:</th>
				<td><?= date("j.m.Y в g:i", $member_id['reg_date']); ?></td>
			</tr>

			<tr>
				<th scope="col" class="ml-5" width="170px">Последний вход:</th>
				<td><?= date("j.m.Y в g:i", $member_id['lastdate']); ?></td>
			</tr>

		</tbody>
	</table>

</div>
