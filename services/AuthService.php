<?php 

namespace services;

use Google\Service\ServiceControl\Auth;
use Models\AuthModel;
class AuthService {
    public static function authenticate($email, $password = null, $provider = null, $providerId = null) 
    {
        $authModel = new AuthModel(); 

        if($provider) {
            $user = $authModel->getUserByProvider($email, $provider, $providerId);
        } else {
            $user = $authModel->getUserByEmail($email);
            if (!$user || !password_verify($password, $user[0]['password'])) {
                return false;
            }
        }
        return $user;
    }

    public static function checkExistsEmail($email) {
        $authModel = new AuthModel(); 
        return $authModel->getUserByEmail($email);
    }

    public static function saveVerificationCode($email, $verificationCode, $type)
    {
        $authModel = new AuthModel();
        return $authModel->insertVerificationCode($email, $verificationCode, $type);
    }

    public static function checkVerificationCode($email, $code, $type)
    {
        $authModel = new AuthModel();
        return $authModel->verifyCode($email, $code, $type);
    }

    public static function createNewUserByNormal($newUSerInfo) 
    {
        $authModel = new AuthModel();
        return $authModel->createNewUserByNormal($newUSerInfo);
    }

    public static function loginWithSocial($email, $provider)
    {
        $authModel = new AuthModel();
        return $authModel->getUserByEmailAndProvider($email, $provider);
    }

    public static function registerWithSocial($email, $provider, $providerId)
    {
        $authModel = new AuthModel();
        return $authModel->createNewUserBySocialAccount($email, $provider, $providerId);
    }

    public static function additionalInfo($validatedAdditionalInfo, $userId, $email, $provider) 
    {
        $authModel = new AuthModel();
        return $authModel->additionalInfo($validatedAdditionalInfo, $userId, $email, $provider);
    }

    public static function updateUserSessionInfo() 
    {
        $authModel = new AuthModel();
        $_SESSION['userInfo'] = $authModel->getLatestUserInfo($_SESSION['userInfo'][0]['userId']);
    }
}
