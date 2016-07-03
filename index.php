<?php
/**
 * Created by PhpStorm.
 * User: matej
 * Date: 08/06/16
 * Time: 07:13
 */
session_start();

mb_internal_encoding("UTF-8");
function autoloadFunction($class)
{
    if (preg_match('/Controller$/', $class))
        require("controllers/" . $class . ".php");
    else
        require("models/" . $class . ".php");
}
spl_autoload_register("autoloadFunction");

Db::connect("192.168.0.103", "root", "", "mati_db");

$router = new RouterController();
$router->compile(array($_SERVER['REQUEST_URI']));

$router->extractView();