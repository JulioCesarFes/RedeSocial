<?php

require_once 'system/constants.php';
require_once 'system/controller.php';
require_once 'system/autoloader.php';
require_once 'system/routes.php';
require_once 'config/routes.php';

$method = $_SERVER['REQUEST_METHOD'];

$url = 'root';
if (isset($_GET['url'])) { $url = $_GET['url']; }

list($controller_name, $action_name) = Routes::getControllerAction($method, $url);

$controller_name::$action_name();
