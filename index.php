<?php
ini_set('error_reporting', E_ALL & ~E_DEPRECATED);

date_default_timezone_set('Asia/Ho_Chi_Minh');

session_start();

require_once(__DIR__ . '/Core/functions.php');
require_once './vendor/autoload.php';

spl_autoload_register(function ($Name) {
    require_once(__DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $Name) . '.php');
});

$Router = new Core\Router();
$Router->GetRoute();


