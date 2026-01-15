<?php
/**
 * Вывод личного кабинета
 * =======================================================
 * Автор:	GamerVII
 * URL:  	https://vk.com/gamervii
 * email:	gamervii.phone@gmail.com
 * =======================================================
 * Файл:  index.php
 * -------------------------------------------------------
 * Версия: 1.4.1 (07.07.2019)
 * =======================================================
 */

if (!defined('DATALIFEENGINE')) die("Error!");

define('DIR', $_SERVER['DOCUMENT_ROOT']);
$name = $member_id['name'];
$balance = $member_id['balance'];

require "{$_SERVER['DOCUMENT_ROOT']}/recloud/modules/cabinet/core/class/class.connect.php";
$database = new Database();

require "{$_SERVER['DOCUMENT_ROOT']}/recloud/modules/cabinet/config.php";
require "{$_SERVER['DOCUMENT_ROOT']}/recloud/modules/cabinet/functions/functions.php";
require "{$_SERVER['DOCUMENT_ROOT']}/recloud/modules/payment/robokassa/robokassa.php";


?>
<link rel="stylesheet" href="/recloud/assets/css/style.css">
<link rel="stylesheet" href="/recloud/assets/css/grid.css">
<script src="/recloud/assets/js/scripts.js?v=10"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/c4e511f3f8.js"></script>

<div class="row cabinet-content block-body">
	<div class="col-xl-6 col-md-12 mb-2">

		<div class="cabinet-block">

			<div class="2Dskin-viewer mb-3">
        <?php require_once DIR . "/recloud/modules/cabinet/functions/2Dskinviewer.php"; ?>
			</div>

			<div class="skin-upload mb-2">
        <?php require_once DIR . "/recloud/modules/cabinet/functions/skinupload.php"; ?>
			</div>

			<div class="cloak-upload">
        <?php require_once DIR . "/recloud/modules/cabinet/functions/cloakupload.php"; ?>
			</div>

		</div>

	</div>
	<div class="col-xl-6 col-md-12 mb-2">

		<div class="cabinet-block">

			<div class="cabinet-errors">
        <?php require_once DIR . "/recloud/modules/cabinet/functions/errors.php"; ?>
			</div>

			<div class="cabinet-info">
        <?php require_once DIR . "/recloud/modules/cabinet/functions/userinfo.php"; ?>
			</div>

		</div>

		<div class="cabinet-block">

			<div class="cabinet-balance">
        <?php require_once DIR . "/recloud/modules/cabinet/functions/balance.php"; ?>
			</div>

		</div>

		<div class="cabinet-block">

			<div class="cabinet-rights">
        <?php require_once DIR . "/recloud/modules/cabinet/functions/rights.php"; ?>
			</div>

		</div>


	</div>
</div>
