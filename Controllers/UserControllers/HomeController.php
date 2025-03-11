<?php

namespace Controllers\UserControllers;

use Core\BaseController;

class HomeController extends BaseController
{
    protected $Model = "UserModels\HomeModel";
    public function showHomeView() 
    {
        $limitProduct = 10;
        $newProductList = $this->mapProductList($this->Database->getProductByCatName('Sản phẩm mới nhất', $limitProduct));
        $hotProductList = $this->mapProductList($this->Database->getProductByCatName('Sản phẩm nổi bật', $limitProduct));
        $bestSellerProductList = $this->mapProductList($this->Database->getProductByCatName('Sản phẩm bán chạy', $limitProduct));

        $limitNews = 6;
        $newsList = $this->Database->getBasicKeyInfoNews($limitNews);

        $brandList = $this->Database->getBrandImages();
        view('User/UserPages/HomeView', compact('newProductList', 'hotProductList', 'bestSellerProductList', 'newsList', 'brandList'));
    }
    
    private function mapProductList($data)
    {
        $productList = [];
        foreach($data as $row) {
            if(!isset($productList[$row['proId']])) {
                $productList[$row['proId']] = [
                    'brandName' => $row['brandName'],
                    'proName' => $row['proName'],
                    'proSlug' => $row['proSlug'],
                    'colors' => [],
                ];
            }

            $colorCode = $row['colorCode'];
            
            // Nếu màu này chưa tồn tại trong sản phẩm, thêm màu mới
            if(!isset($productList[$row['proId']]['colors'][$colorCode])) {
                $productList[$row['proId']]['colors'][$colorCode] = [
                    'varId' => $row['varId'],
                    'colorCode' => $colorCode,
                    'colorName' => $row['colorName'],
                    'image' => $row['image'], 
                    'price' => $row['price'],
                    'discount' => $row['discount'],
                ];
            }
        }
        return $productList;
    }
}