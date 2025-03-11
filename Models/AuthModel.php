<?php

namespace Models;

use Core\Model;

class AuthModel extends Model
{
    public function getUserByProvider($email, $provider, $providerId) 
    {
        $query = "SELECT u.*, COUNT(DISTINCT o.orderCode) AS totalProInCart, COUNT(DISTINCT w.proId) AS totalProWishList
            FROM users AS u
            LEFT JOIN `order` AS o ON o.userId = u.userId AND o.status = 0
            LEFT JOIN wish_list AS w ON w.userId = u.userId
            WHERE u.email = ? 
            AND u.provider =  ?
            AND u.providerId = ?
            GROUP BY u.userId;
        ";
        return $this->SelectRow($query, [$email, $provider, $providerId]);
    }

    public function getUserByEmail($email) 
    {
        $query = "SELECT u.*, COUNT(DISTINCT o.orderCode) AS totalProInCart, COUNT(DISTINCT w.proId) AS totalProWishList
                FROM users as u
                LEFT JOIN `order` as o ON o.userId = u.userId AND o.status = 0
                LEFT JOIN wish_list w ON w.userId = u.userId
                WHERE u.email = ?
                GROUP BY u.userId;
        ";
        $resultQuery = $this->SelectRow($query, [$email]);
        return $resultQuery;
    }

    public function insertVerificationCode($email, $verificationCode, $type)
    {
        $query = "INSERT INTO email_verifications (email, verificationCode, type, expiresAt) 
            VALUES (?, ?, ?, NOW() + INTERVAL 10 MINUTE)";
        return $this->InsertRow($query, [$email, $verificationCode, $type]); 
    }

    public function verifyCode($email, $code, $type)
    {
        $query = "SELECT verificationCode 
                FROM email_verifications 
                WHERE email = ? 
                    AND Type = ? 
                    AND expiresAt > NOW() 
                ORDER BY createdAt DESC 
                LIMIT 1";

        $latestCode = $this->SelectRow($query, [$email, $type]);

        return $latestCode && $latestCode[0]['verificationCode'] === $code;
    }

    public function createNewUserByNormal($newUSerInfo) 
    {
        $passwordHash = password_hash($newUSerInfo['password'], PASSWORD_DEFAULT);
        $query = "INSERT INTO `users`(`fullName`, `gender`, `birthDate`, `email`, `password`, `address`, `phoneNumber`) 
        VALUES (?, ?, ?, ?, ?, ?, ?) ";    
        $resultQuery = $this->InsertRow($query, [
            $newUSerInfo['fullName'], $newUSerInfo['gender'], $newUSerInfo['birthDate'], $newUSerInfo['email'], 
            $passwordHash, $newUSerInfo['address'], $newUSerInfo['phoneNumber']
        ], true);
        if(!$resultQuery) return false;
        return $this->getUserInfoById($resultQuery);
    }
    
    public function getUserInfoById($id)
    {
        $query = "SELECT * FROM users WHERE userId = ?";
        return $this->SelectRow($query, [$id]);
    }

    public function getUserByEmailAndProvider($email, $provider)
    {
        $query = "SELECT u.*, COUNT(DISTINCT o.orderCode) AS totalProInCart, COUNT(DISTINCT w.proId) AS totalProWishList 
            FROM users as u
            LEFT JOIN `order` AS o ON o.userId = u.userId AND o.status = 0
            LEFT JOIN wish_list AS w ON w.userId = u.userId
            WHERE u.email = ? AND u.provider = ? 
            GROUP BY u.userId LIMIT 1";
        return $this->SelectRow($query, [$email, $provider]);
    }

    public function createNewUserBySocialAccount($email, $provider, $providerId) {
        $query = "INSERT INTO `users`(`fullName`, `gender`, `birthDate` , `address`, `phoneNumber`, `email`, `provider`, 
            `providerId`, `active`) 
        VALUES ('', '', CURRENT_DATE, '', '', ?, ?, ?, 0)";
        $resultQuery = $this->InsertRow($query, [$email, $provider, $providerId], true);
        if(!$resultQuery) return false;
        return $this->getUserInfoById($resultQuery);
    }

    public function additionalInfo($validatedAdditionalInfo, $userId, $email, $provider) 
    {
        $query = "UPDATE `users` 
            SET `fullName` = ?,`gender` = ?,`birthDate` = ?, `address` = ?,`phoneNumber` = ?, `active` = 1 
            WHERE userId = ? AND email = ? AND provider = ?";
        $this->UpdateRow($query, 
        [
            $validatedAdditionalInfo['fullName'], $validatedAdditionalInfo['gender'], $validatedAdditionalInfo['birthDate'], $validatedAdditionalInfo['address'], $validatedAdditionalInfo['phoneNumber'], $userId, $email, $provider
        ]);

        return $this->getUserInfoById($userId);
    }

    public function getLatestUserInfo($userId) 
    {
        $query = "SELECT u.*, COUNT(DISTINCT o.orderCode) AS totalProInCart, COUNT(DISTINCT w.proId) AS totalProWishList
                FROM users as u
                LEFT JOIN `order` as o ON o.userId = u.userId AND o.status = 0
                LEFT JOIN wish_list w ON w.userId = u.userId
                WHERE u.userId = ?
                GROUP BY u.userId;
        ";
        return $this->SelectRow($query, [$userId]);
    }
}