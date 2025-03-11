<?php

namespace Controllers\AdminControllers;

use \Core\BaseController;

class DashboardController extends BaseController {
    protected $Model = "AdminModels\DashboardModel";
    public function index() 
    {
        $totalProduct = $this->Database->countTotalProduct();
        $totalWishListProduct = $this->Database->countTotalWishListProduct();
        $totalOrderAndMoney = $this->Database->countTotalOrderAndCaclMoney();
        $totalNews = $this->Database->countTotalNews();
        $totalCustomer = $this->Database->countTotalCustomer();
        view('Admin/AdminPages/DashboardView', 
        compact('totalProduct', 'totalWishListProduct', 'totalOrderAndMoney', 'totalNews', 'totalCustomer'));
    }
}