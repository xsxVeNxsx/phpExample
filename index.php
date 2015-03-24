<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
require_once "controller/auth_controller.php";

$controllers = ["index" => auth_controller,
                "auth" => auth_controller];

$controller = $_GET['controller'];
if (!isset($controller))
    $controller = "index";
echo (new $controllers[$controller]($db))->execute();
?>
