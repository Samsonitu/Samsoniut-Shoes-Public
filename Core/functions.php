<?php

function dd($v)
{
    var_dump($v);
    exit();
}

function prd($v) 
{
    echo "<pre>";
    print_r($v);
    echo "</pre>";
    exit();
}

function view($Name, $Data = [])
{
    extract($Data);
    if (file_exists(__DIR__ . "/../Views/$Name.php")):
        require_once __DIR__ . "/../Views/$Name.php";
    else:
        echo "<h1 style='color: red;text-align: center'>View [$Name] Not found</h1>";
        exit();
    endif;
}

function config($Key)
{
    $Config = require __DIR__ . '/config.php';

    if (array_key_exists($Key, $Config)):

        return $Config[$Key];
    else:
        echo "<h1 style='color: red;text-align: center'>[$Key] not found in config.php file</h1>";
        exit();
    endif;
}

function route($RouteName, $Data = []): string
{
    return config('app_url') . (new Core\Router)->GetRouteByName($RouteName, $Data);
}

function redirect($RouteName, $Data = [])
{
    header('Location: ' . route($RouteName, $Data));
    exit();
}

function public_dir(string $File): string
{
    if (strpos($File, '/') === 0):
        $File = substr($File, 1);
    endif;

    return config('public_url') . $File;
}

function abort($Code = 404)
{
    http_response_code($Code);

    if (file_exists(__DIR__ . "/../Views/errors/$Code.php")) {
        view("errors/$Code");
    } else {
        echo "Error $Code";
    }

    exit();
}

function toastMessage($type = 'info', $title = '', $message = '', $duration = '') 
{
    $_SESSION['toastMessage'] = [
        'type' => $type, 
        'title' => $title, 
        'message' => $message, 
        'duration' => $duration
    ];
}

function formatDate($date) 
{
    $date = strtotime($date);
    return date('d/m/Y', $date);
}

function formatDateTime($dateTime) {
    return date('H:i:s d/m/Y', strtotime($dateTime));
}

function formatPrice($price)
{
    return number_format($price, '0', '.', '.');
}

function convertToSlug($string) {
    // Loại bỏ dấu tiếng Việt
    $string = transliterator_transliterate('Any-Latin; Latin-ASCII', $string);
    
    // Chuyển về chữ thường
    $string = strtolower($string);
    
    // Xóa ký tự đặc biệt, chỉ giữ lại chữ cái, số và khoảng trắng
    $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
    
    // Thay thế khoảng trắng và dấu gạch ngang liên tục thành một dấu gạch ngang
    $string = preg_replace('/[\s-]+/', '-', trim($string));
    
    return $string;
}

function maskPhoneNumber($phoneNumber) {
    return substr($phoneNumber, 0, 4) . str_repeat('*', 4) . substr($phoneNumber, -3);
}