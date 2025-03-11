<?php

namespace Models\AdminModels;

use Core\Model;

class DashboardModel extends Model
{
    public function countTotalProduct()
    {
        $query = "SELECT COUNT(DISTINCT proId) as totalProduct FROM product";
        return $this->SelectRow($query);
    }

    public function countTotalWishListProduct()
    {
        $query = "SELECT COUNT(DISTINCT id) as totalWishListProduct FROM wish_list";
        return $this->SelectRow($query);
    }
    
    public function countTotalOrderAndCaclMoney()
    {
        $query = "SELECT SUM(quantity) AS totalOrderQuantity, SUM(totalOrder) AS totalPrice 
            FROM `order` 
            WHERE status = 4;
            ";
        return $this->SelectRow($query);
    }

    public function countTotalNews()
    {
        $query = "SELECT COUNT(DISTINCT newsId) as totalNews 
            FROM news";
        return $this->SelectRow($query);
    }

    public function countTotalCustomer()
    {
        $query = "SELECT COUNT(DISTINCT userId) as totalCustomer
            FROM users
            WHERE role = 'customer'";
        return $this->SelectRow($query);
    }
}