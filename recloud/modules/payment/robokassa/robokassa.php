<?php

/**
 * Создание цифоровой подписи
 * =======================================================
 * Автор: GamerVII
 * URL:   https://vk.com/gamervii
 * email: gamervii.phone@gmail.com
 * =======================================================
 * Файл:  robokassa.php
 * -------------------------------------------------------
 * Версия: 1.1.1 (7.07.2019)
 * =======================================================
 */
$redirect = "http://".$_SERVER['HTTP_HOST']."/cabinet.html";


if (isset($_POST['pay_submit'])) {

  if (empty($_POST['pay_sum'])) {
    dumpErrors("Ошибка", "Введите сумму пополнения");
    header("Location: $redirect");
    return false;
  }

  if (!is_numeric($_POST['pay_sum'])) {
    dumpErrors("Ошибка", "Cумма должно быть числом");
    header("Location: $redirect");
    return false;
  }

  if ($_POST['pay_sum'] <= 0) {
    dumpErrors("Ошибка", "Сумма пополнения не может быть меньше или равна 0");
    header("Location: $redirect");
    return false;
  }

  $email = $member_id['email'];
  $summ = intval($_POST['pay_sum']);
  $date_pay = time();
  $redirect = "http://".$_SERVER['HTTP_HOST']."/cabinet.html";

  $database->query("INSERT INTO `cabinet_pay_logs` (`name`, `sum`, `pay_date`, `status`, `pay_date_success`) VALUES ('{$name}', '{$summ}', '{$date_pay}', 'wait', '0')");

  $id = $database->query("SELECT `id` FROM `cabinet_pay_logs` WHERE `name` = '{$name}' ORDER BY id DESC LIMIT 1");
  $id = $id['id'];

  $SignatureValue  = md5("". $cabinet_config['paysettings']['roboId'] .":$summ:0:". $cabinet_config['paysettings']['roboPassOne'] .":shp_id=$id:shp_login=$name");

  $desc = $cabinet_config['paysettings']['roboDesc'] . " игроком: $name на сумму $summ";

  $pay_link = "https://auth.robokassa.ru/Merchant/Index.aspx?MerchantLogin=". $cabinet_config['paysettings']['roboId'] ."&OutSum=$summ&InvoiceID=0&Description=$desc&Email=$email&SignatureValue=$SignatureValue&shp_id=$id&shp_login=$name";

  header("Location: $pay_link");

}

?>

<div class="modal fade" id="paycabinet" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Пополнение баланса</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action method="POST">

          <div class="form__group">
            <input type="number" name="pay_sum" class="form__input" placeholder=" " required>
            <label for="pay_sum" class="form__label">Введите сумму</label>
          </div>

          <input type="submit" name="pay_submit" class="cabinet-buttons w-100 mb-2" value="Оплатить">
        </form>
      </div>
    </div>
  </div>
</div>
