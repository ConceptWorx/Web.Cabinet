<?php

if (!defined('DATALIFEENGINE')) die("Error!");

/**
 * Класс подключения и работы с базой данных
 * =======================================================
 * Автор:	GamerVII
 * URL:  	https://vk.com/gamervii
 * email:	gamervii.phone@gmail.com
 * =======================================================
 * Файл:  class.connect.php
 * -------------------------------------------------------
 * Версия: 1.0.1 (6.07.2019)
 * =======================================================
 */

class Database {
    private $link;

    # +---------------------------------------------------+ #
    # |            Конструктор класса Database            | #
    # +---------------------------------------------------+ #
    public function __construct()
    {
        $this->connect();
    }

    # +---------------------------------------------------+ #
    # |           Метод connect класса Database           | #
    # +---------------------------------------------------+ #
    private function connect()
    {
        $cabinet_config = require_once $_SERVER['DOCUMENT_ROOT'] . '/recloud/modules/cabinet/db_config.php';
        $dsn = 'mysql:host=' . $cabinet_config['host'] . ';dbname=' . $cabinet_config['db_name'] . ';charset=' . $cabinet_config['charset'];
        $this->link = new PDO($dsn, $cabinet_config['db_user'], $cabinet_config['db_pass']);
        return $this;
    }

    # +---------------------------------------------------+ #
    # |           Метод execute класса Database           | #
    # +---------------------------------------------------+ #
    public function execute($sql)
    {
        $sth = $this->link->prepare($sql);

        return $sth->execute();
    }

    # +---------------------------------------------------+ #
    # |            Метод query класса Database            | #
    # +---------------------------------------------------+ #
    public function query($sql)
    {
        $sth = $this->link->prepare($sql);
        $sth->execute();
        $resault = $sth->fetchAll(PDO::FETCH_ASSOC);

        if ($resault === false) {
            return [];
        }

        return $resault;
    }
}
?>
