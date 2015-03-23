<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
require_once "controller/base_controller.php";
require_once "controller/auth_controller.php";

$controllers = array("index" => base_controller,
                    "auth" => auth_controller);

function db_connect($host, $name, $user, $pass)
{
    $db = new PDO('mysql:host='.$host.';dbname='.$name, $user, $pass);
    $db->query('SET character_set_connection = utf8');
    $db->query('SET character_set_client = utf8');
    $db->query('SET character_set_results = utf8');
    return $db;
}

$controller = $_GET['controller'];
if (!isset($controller))
    $controller = "index";
//$db = db_connect('localhost', 'u272679865_admin', 'u272679865_photo', '123123123');
$db = db_connect('localhost', 'photos', 'admin', '123123123');
echo (new $controllers[$controller]($db))->execute();
?>
