<?php

use MVC\core\Database;
use MVC\core\Router;

define("DS",DIRECTORY_SEPARATOR);
define("ROOT",dirname(__DIR__).DS);
define("APP",ROOT."app".DS);
define("CORE",APP."core".DS);
define("CONTROLLER",APP."controllers".DS);
define("MODEL",APP."models".DS);
define("VIEWS",APP."views".DS);
define("CONFIG",APP."config".DS);

require ROOT . "vendor/autoload.php";

$router = new Router();


//$db_info = require __DIR__ . '/config/database.php';

//$connect = mysqli_connect($db_info['host'], $db_info['username'], $db_info['password'], $db_info['db_name']);
//
//$sql = "INSERT INTO `users` (`name`,`email`,`password`) values ('ahmed younis','correiaftw@gmail.com','123123123')";
//
//$result = mysqli_query($connect, $sql);

//die($result);
//echo 'x';
//mysqli_close($connect);