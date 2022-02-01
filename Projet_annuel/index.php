<?php

//set_include_path("./src");

require_once("Router.php");
//require_once('/users/21914622/private/mysql_config.php');
require_once('/users/21904876/private/mysql_config.php');
require_once('storage/Storage.php');
require_once('model/Account.php');
require_once("view/View.php");
require_once("view/Private_view.php");
require_once("controller/Controller.php");


try {



  /*Pour Nicolas :
  $dsn = MYSQL_HOST . ";" . "dbname=" . MYSQL_DB . ";" . "charset=utf8";

  $router = new Router();
  $router->main(new Storage(new PDO($dsn, MYSQL_USER, MYSQL_PASSWORD)));

  */

  /*Pour nathan : */

  $db = new PDO($dsn, $MYSQL_USER, $MYSQL_PASSWORD);
  $router = new Router();
  $router->main(new Storage($db));

} catch (\Exception $e) {
  echo $e;
}

?>
