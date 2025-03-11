<?php

namespace Models\AdminModels;

use Core\Model;

class OrderModel extends Model
{
    public function getOrderByStatus($status) 
    {
        $query = "SELECT o.*, u.fullName, u.address, u.gender, p.proName, v.colorCode, v.colorName, v.image, v.size
            FROM `order` as o
            JOIN product as p ON p.proId = o.proId
            JOIN variant as v ON v.varId = o.varId
            JOIN users as u ON u.userId = o.userId
            WHERE o.status != 0 AND o.status = ?;
            ORDER BY c.orderAt";
        return $this->SelectRow($query, [$status]);
    }

    public function updateOrder($orderCode, $status, $note)
    {
        $query = "UPDATE `order` SET `note` = ?, `status` = ? WHERE orderCode = ?";
        return $this->UpdateRow($query, [$note, $status, $orderCode]);
    }
}