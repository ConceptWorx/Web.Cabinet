<?php
  $redirect = "http://".$_SERVER['HTTP_HOST']."/cabinet.html";
  dumpErrors("Ошибка", "Что-то пошло не так, оплата не была проведена, обратитьсь в техподдержку");
  header("Location: $redirect");
?>
