<?php

require_once("Router.php");
require_once('/users/21914622/private/mysql_config.php');
require_once('storage/Storage.php');
require_once('model/Account.php');
require_once("view/View.php");
require_once("view/Private_view.php");
require_once("controller/Controller.php");

$string = MYSQL_HOST . ";" . "dbname=" . MYSQL_DB . ";" . "charset=utf8";

$router = new Router();
$router->main(new Storage(new PDO($string, MYSQL_USER, MYSQL_PASSWORD)));
?>