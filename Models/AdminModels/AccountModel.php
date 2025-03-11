<?php

namespace Models\AdminModels;

use Core\Model;

class AccountModel extends Model
{
    public function getAllAccount()  
    {
        $query = "SELECT * FROM users";
        return $this->SelectRow($query);
    }

    public function checkExistsEmail($email = '')
    {
        $query = "SELECT email FROM users WHERE email = ?";
        return $this->SelectRow($query, [$email]);
    }

    public function createAccount($accountInfo) 
    {
        $query = "INSERT INTO `users`(`fullName`, `gender`, `birthDate`, `email`, `password`, `address`, `phoneNumber`, `role`, `description`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        return $this->InsertRow($query, 
        [
            $accountInfo['fullNameCreate'], $accountInfo['genderCreate'], $accountInfo['dobCreate'], $accountInfo['emailCreate'], 
            $accountInfo['passwordCreate'], $accountInfo['addressCreate'], $accountInfo['phoneNumberCreate'], $accountInfo['roleCreate'], 
            $accountInfo['descriptionCreate'],
        ]);
    }

    public function updateAccount($accountInfo)
    {
        $query = "UPDATE `users` SET `fullName` = ?, `gender` = ?, `birthDate` = ?, `address` = ?, `phoneNumber` = ?, `role` = ?, `description` = ?";
        $params = [
            $accountInfo['fullNameUpdate'],
            $accountInfo['genderUpdate'],
            $accountInfo['dobUpdate'],
            $accountInfo['addressUpdate'],
            $accountInfo['phoneNumberUpdate'],
            $accountInfo['roleUpdate'],
            $accountInfo['descriptionUpdate']
        ];

        // Chỉ cập nhật mật khẩu nếu có nhập mật khẩu mới
        if (!empty($accountInfo['passwordUpdate'])) {
            $query .= ", `password` = ?";
            $params[] = $accountInfo['passwordUpdate']; // Không băm lại vì đã xử lý trước
        }

        $query .= " WHERE userId = ?";
        $params[] = $accountInfo['userIdUpdate'];

        return $this->UpdateRow($query, $params);
    }

    public function changeActiveAccount($userId, $email, $active)
    {
        $active = $active == 1 ? 0 : 1;
        $query = "UPDATE users SET active = $active WHERE TRIM(email) = TRIM(?) AND userId = ?";
        return $this->UpdateRow($query, [$email, (int)$userId]);
    }

    public function deleteAccount($userId, $email)
    {
        $query1 = "SELECT COUNT(*) AS totalOrders FROM `order` WHERE userId = ? AND status NOT IN (?, ?)";

        // Các trạng thái đơn hàng chưa hoàn tất (chưa giao, đang giao)
        $pendingStatus = [1, 2]; // 1: Đã xác nhận, 2: Đang giao

        $resultQuery1 = $this->SelectRow($query1, [$userId, ...$pendingStatus]);

        // Nếu tài khoản có đơn hàng chưa giao, không cho phép xóa
        if ($resultQuery1 && $resultQuery1['totalOrders'] > 0) {
            toastMessage('error', 'Thất bại', 'Không thể xóa tài khoản này vì còn đơn hàng chưa hoàn tất.');
            return false;
        }

        // Xóa tài khoản nếu không có đơn hàng chưa hoàn tất
        $query2 = "DELETE FROM `users` WHERE userId = ? AND email = ?";
        $resultQuery2 = $this->DeleteRow($query2, [$userId, $email]);

        if (!$resultQuery2) {
            toastMessage('error', 'Thất bại', 'Xóa tài khoản thất bại.');
            return false;
        }
        return true;
    }

}