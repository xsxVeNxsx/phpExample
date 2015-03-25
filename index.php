<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
require_once "controller/auth_controller.php";

$controllers = ["index" => Profile_Controller,
                "auth" => Auth_Controller,
                "profile" => Profile_Controller];

$controller = $_GET['controller'];
if (!isset($controller))
    $controller = "index";
echo (new $controllers[$controller]($db))->execute();
?>
