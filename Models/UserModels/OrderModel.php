<?php

namespace Models\UserModels;

use Core\Model;

class OrderModel extends Model
{
    /* BEGIN CART */
        public function getAllOrderPendingForPay($userId)
        {
            $query = "SELECT o.orderCode, p.proId, p.proName, v.varId, v.colorCode, v.colorName, v.size, v.price, v.discount, v.image, 
            v.quantity as quantityInStock, o.quantity as orderQuantity
            FROM `order` as o 
            JOIN product as p ON p.proId = o.proId AND p.active != 0
            JOIN variant as v ON v.varId = o.varId AND v.status != 0
            JOIN brand as b ON b.brandId = p.brandId
            WHERE o.userId = ? AND o.status = 0";
            return $this->SelectRow($query, [$userId]);
        }

        public function updateOrderQuantity($userId, $orderCode, $orderQuantity) {
            $query = "UPDATE `order` SET `quantity` = ? WHERE `orderCode` = ? AND `userId` = ? AND status = 0";
            return $this->UpdateRow($query, [$orderQuantity, $orderCode, $userId]);
        }

        public function deleteORder($userId, $orderCode) {
            $query = "DELETE FROM `order` WHERE `userId` = ? AND `orderCode` = ?";
            return $this->DeleteRow($query, [$userId, $orderCode]);
        }
    /* END CART */

    /* BEGIN ORDER */
        public function getProductInfoByMainKeyValues($mainKeyValues) 
        {  
            $query = "SELECT b.brandName, p.proId, p.proName, 
                v.varId, v.colorCode, v.colorName, v.size, v.image, v.quantity, v.price, v.discount
                FROM product as p
                JOIN brand as b ON b.brandId = p.brandId
                JOIN variant as v ON v.proId = p.proId AND v.status != 0
                WHERE v.proId = ? AND v.colorCode = ? AND v.size = ?";
            return $this->SelectRow($query, 
            [
                $mainKeyValues['orderProId'], $mainKeyValues['orderColorCode'], $mainKeyValues['orderSize']
            ]);
        }

        public function checkOrderHasInStock($orderInfo)
        {
            $query = "SELECT v.quantity, p.proSlug, v.varId
                FROM product as p 
                JOIN variant as v ON v.proId = p.proId AND v.active != 0
                WHERE v.colorCode = ? AND v.size = ? AND p.proId = ? AND p.active != 0";
            return $this->SelectRow($query, 
            [
                $orderInfo['orderColorCode'], $orderInfo['orderSize'], $orderInfo['orderProId']
            ]);
        }

        public function addProVarToCart($userId, $proId, $varId, $quantity)  
        {
            $query1 = "SELECT orderCode FROM `order` WHERE proId = ? AND varId = ? AND userId = ? AND status = 0";
            $resultQuery1 = $this->SelectRow($query1, [$proId, $varId, $userId]);

            if(!empty($resultQuery1[0]['orderCode'])) {
                $query2 = "UPDATE `order` SET `quantity` = quantity + ? WHERE orderCode = ?";
                return $this->UpdateRow($query2, [$quantity, $resultQuery1[0]['orderCode']]);
            }else {
                $orderCode = $this->generateOrderCode();
                $query2 = "INSERT INTO `order`(`orderCode`, `userId`, `proId`, `varId`, `quantity`) 
                VALUES (?, ?, ?, ?, ?)";
                return $this->InsertRow($query2, [$orderCode, $userId, $proId, $varId, $quantity]);
            }
        }

        public function orderFast($userId, $proId, $varId, $orderQuantity, $paymentForm, $unitPrice, $totalOrder)
        {
            $query1 = "SELECT v.quantity 
                FROM product as p
                JOIN variant as v ON v.proId = p.proId
                WHERE v.quantity >= ? AND p.proId = ? AND v.varId = ?";
            $resultQuery1 = $this->SelectRow($query1, [$orderQuantity, $proId, $varId]);
            if(empty($resultQuery1[0]['quantity'])) return false;

            $orderCode = $this->generateOrderCode();
            $query2 = "INSERT INTO `order`(`orderCode`, `userId`, `proId`, `varId`, `quantity`, `status`, `orderAt`, `paymentForm`, `unitPrice`, `totalOrder`) 
            VALUES (?, ?, ?, ?, ?, 1, CURRENT_TIMESTAMP(), ?, ?, ?)";
            return $this->InsertRow($query2, [$orderCode, $userId, $proId, $varId, $orderQuantity, $paymentForm, $unitPrice, $totalOrder]);
        }

        public function getAllOrdered($userId)
        {
            $query = "SELECT b.brandName, p.proId, p.proName, o.status, o.unitPrice, o.quantity, o.paymentForm, o.totalOrder,
                v.varId, v.colorCode, v.colorName, v.size, v.image, v.price, v.discount
                FROM `order` as o
                JOIN product as p ON p.proId = o.proId
                JOIN brand as b ON b.brandId = p.brandId
                JOIN variant as v ON v.proId = p.proId
                WHERE o.userId = ? AND o.status != 0 AND o.varId = v.varId
                ORDER BY orderAt DESC";
            return $this->SelectRow($query, [$userId]);
        }

        public function getProductInfoByOrderCodes($userId, $orderCodes) 
        {
            if (empty($orderCodes) || !is_array($orderCodes)) return false;

            $placeholders = implode(',', array_fill(0, count($orderCodes), '?'));

            // Truy vấn lấy thông tin sản phẩm kèm số lượng tồn kho
            $query1 = "SELECT p.proName, v.colorName, o.quantity as orderQuantity, v.quantity as quantityInStock
                    FROM `order` as o 
                    JOIN variant as v ON v.varId = o.varId 
                    JOIN product as p ON p.proId = o.proId
                    WHERE o.orderCode IN ($placeholders) AND o.userId = ?";
            
            $orderInfo = $this->SelectRow($query1, array_merge($orderCodes, [$userId]));

            if (!$orderInfo) return false;

            // Kiểm tra số lượng đặt hàng có hợp lệ không
            foreach ($orderInfo as $order) {
                if ($order['orderQuantity'] > $order['quantityInStock']) {
                    toastMessage('error', 'Thất bại', 
                        'Sản phẩm "' . $order['proName'] . '" màu "' . $order['colorName'] . 
                        '" số lượng "' . $order['orderQuantity'] . '" không đủ hàng trong kho (' . 
                        $order['quantityInStock'] . ').'
                    );
                    return false;
                }
            }

            // Truy vấn lấy thông tin chi tiết sản phẩm
            $query2 = "SELECT b.brandName, p.proId, p.proName, o.orderCode, o.quantity as orderQuantity,
                            v.varId, v.colorCode, v.colorName, v.size, v.image, 
                            v.quantity as quantityInStock, v.price, v.discount
                    FROM `order` as o
                    JOIN product as p ON p.proId = o.proId
                    JOIN brand as b ON b.brandId = p.brandId
                    JOIN variant as v ON v.proId = p.proId 
                    AND o.varId = v.varId AND v.status != 0
                    WHERE o.orderCode IN ($placeholders)";

            return $this->SelectRow($query2, $orderCodes);
        }


        public function orderNormal($userId, $orderCodes) 
        {
            if (empty($orderCodes) || !is_array($orderCodes)) return false;

            $placeholders = implode(',', array_fill(0, count($orderCodes), '?'));

            // Lấy thông tin đơn hàng
            $query1 = "SELECT o.orderCode, o.proId, o.varId, o.quantity, v.price, v.discount
                    FROM `order` o
                    JOIN variant v ON v.varId = o.varId
                    WHERE o.orderCode IN ($placeholders)";

            $resultQuery1 = $this->SelectRow($query1, $orderCodes);
            if (!$resultQuery1) return false;

            foreach ($resultQuery1 as $order) {
                $query2 = "SELECT v.quantity 
                        FROM product p
                        JOIN variant v ON v.proId = p.proId
                        WHERE v.quantity >= ? AND p.proId = ? AND v.varId = ?";

                $resultQuery2 = $this->SelectRow($query2, [$order['quantity'], $order['proId'], $order['varId']]);
                if (!$resultQuery2) return false;
            }

            foreach ($resultQuery1 as $order) {
                $unitPrice = $order['price'] * (100 - $order['discount']) / 100;
                $totalOrder = $unitPrice * $order['quantity'] + 40000;

                $query3 = "UPDATE `order` 
                        SET `status` = 1, 
                            orderAt = CURRENT_TIMESTAMP(), 
                            unitPrice = ?, 
                            totalOrder = ? 
                        WHERE orderCode = ? AND userId = ?";
                
                $resultQuery3 = $this->UpdateRow($query3, [$unitPrice, $totalOrder, $order['orderCode'], $userId]);
                if (!$resultQuery3) return false;
            }

            return true;
        }

        private function generateOrderCode($length = 10) {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            
            do {
                $orderCode = '';
                for ($i = 0; $i < $length; $i++) {
                    $orderCode .= $characters[rand(0, strlen($characters) - 1)];
                }
        
                // Kiểm tra xem orderCode đã tồn tại trong database chưa
                $query = "SELECT orderCode FROM `order` WHERE orderCode = ?";
                $resultQuery = $this->SelectRow($query, [$orderCode]);
                
            } while (!empty($resultQuery)); // Nếu tồn tại, tạo lại mã mới
            
            return $orderCode;
        }
    /* END ORDER */
}