<?php

namespace Middleware;

class AuthMiddleware {
    static function handle($auth = NULL) {
        switch($auth) {
            case 'user':
                self::checkUser();
                break;
            case 'admin':
                self::checkAdmin();
                break;
            case null:
                return; 
            default:
                abort();
        }
    }

    private static function checkUser()
    {
        if (!isset($_SESSION['userInfo'])) {
            redirect('LoginRoute');
            exit();
        }
    }

    private static function checkAdmin()
    {
        if (!isset($_SESSION['adminInfo'])) {
            redirect('AdminLoginRoute');
            exit();
        }
    }
}