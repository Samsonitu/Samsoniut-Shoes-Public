<?php

namespace Models\UserModels;

use Core\Model;
class AccountModel extends Model
{
    
    public function checkExistsEmailCreateByNormal($email) 
    {
        $query = "SELECT email, provider 
        FROM users 
        WHERE email = ? 
        LIMIT 1";
        $resultQuery = $this->SelectRow($query, [$email]);
        if(!$resultQuery) {
            toastMessage('error', 'Thất bại', 'Email chưa được đăng ký');
            return false;
        }elseif($resultQuery[0]['provider'] != null) {
            toastMessage('error', 'Thất bại', 'Email được đăng ký đăng nhấp thông qua tài khoản google');
            return false;
        }
        return true;
    }

    public function updateUserInfo($email, $fullName, $gender, $birthDate, $phoneNumber, $address)
    {
        $query = "UPDATE users 
            SET `fullName` = ?, `gender` = ?, `birthDate` = ?, `phoneNumber` = ?, `address` = ? 
            WHERE `email` = ?";
        return $this->UpdateRow($query, [$fullName, $gender, $birthDate, $phoneNumber, $address, $email]);
    }

    public function findUserById($userId)
    {
        $query = "SELECT userId, password FROM users WHERE userId = ?";
        return $this->SelectRow($query, [$userId]);
    }

    public function updateNewPassword($email, $newPassword)
    {
        $hashPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = "UPDATE `users` 
            SET password = ? 
            WHERE email = ?";
        return $this->UpdateRow($query, [$hashPassword, $email]);
    }
}