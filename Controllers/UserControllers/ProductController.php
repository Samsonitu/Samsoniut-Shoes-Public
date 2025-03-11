<?php

namespace Controllers\UserControllers;

use \Core\BaseController;
use services\AuthService;

class ProductController extends BaseController
{
    protected $Model = "UserModels\ProductModel";
    public function showProductView()
    {
        $productList = $this->mapProductList($this->Database->getAllProduct());
        $brandIdAndNameList = $this->Database->getAllBrandIdAndName();
        view('User/UserPages/Product/ProductView', compact('productList', 'brandIdAndNameList'));
    }

    public function showProductCategoryView($catSlug) 
    {
        if($catSlug != 'nam' && $catSlug != 'nu') {
            $currentCategoryPageInfo = $this->Database->getProCatByCatSlug($catSlug);
            $categoryName = $currentCategoryPageInfo[0]['catName'];
        }else {
            $categoryName = $catSlug === 'nam' ? 'nam' : 'nu';
            $currentCategoryPageInfo = [
                0 => [
                    'catName' => 'GIÀY ' . $categoryName,
                    'catSlug' => $catSlug
                ]
            ];
        }
        
        $productCategoryList = $this->mapProductList($this->Database->getAllProductByCategory($categoryName));
        if($productCategoryList) {
            $brandIdAndNameList = $this->Database->getAllBrandIdAndName();
            view('User/UserPages/Product/ProductCategoryView', compact('productCategoryList', 'brandIdAndNameList' , 'currentCategoryPageInfo'));
        }else {
            abort();
        }
    }

    public function showProductBrandView($brandSlug) 
    {
        $currentBrandPageInfo = $this->Database->getBrandNameByBrandSlug($brandSlug);
        $brandName = $currentBrandPageInfo[0]['brandName'];
        
        $productBrandList = $this->mapProductList($this->Database->getAllProductByBrand($brandName));
        view('User/UserPages/Product/ProductBrandView', compact('productBrandList', 'currentBrandPageInfo'));
    }

    private function mapProductList($data)
    {
        $productList = [];
        foreach($data as $row) {
            if(!isset($productList[$row['proId']])) {
                $productList[$row['proId']] = [
                    'brandId' => $row['brandId'],
                    'brandName' => $row['brandName'],
                    'proName' => $row['proName'],
                    'proSlug' => $row['proSlug'],
                    'colors' => [],
                    'categories' => [],
                ];
            }

            if (!in_array($row['catName'], $productList[$row['proId']]['categories'])) {
                $productList[$row['proId']]['categories'][] = $row['catName'];
            }

            $colorCode = $row['colorCode'];
            
            // Nếu màu này chưa tồn tại trong sản phẩm, thêm màu mới
            if(!isset($productList[$row['proId']]['colors'][$colorCode])) {
                $productList[$row['proId']]['colors'][$colorCode] = [
                    'colorCode' => $colorCode,
                    'colorName' => $row['colorName'],
                    'gender' => $row['gender'],
                    'image' => $row['image'], 
                    'price' => $row['price'],
                    'discount' => $row['discount'],
                ];
            }
        }
        return $productList;
    }

    public function showProductDetails($proSlug) 
    {
        $productDetailsInfo = $this->mapProductDetailsInfo($this->Database->getProductDetailsByProSlug($proSlug));
        $productSuggestionList = $this->mapProductList($this->Database->getProductSuggestion($productDetailsInfo['brandId'], $productDetailsInfo['proId']));
        if($productDetailsInfo) {
            view('User/UserPages/Product/ProductDetailsView', compact('productDetailsInfo' , 'productSuggestionList'));
        }else {
            abort(404);
        }
    }

    private function mapProductDetailsInfo($data)
    {
        $productDetailsInfo = [
            'proId' => $data[0]['proId'],
            'brandId' => $data[0]['brandId'],
            'brandName' => $data[0]['brandName'],
            'supId' => $data[0]['supId'],
            'proName' => $data[0]['proName'],
            'proSlug' => $data[0]['proSlug'],
            'productDescription' =>$data[0]['productDescription'],
            'colors' => [],
            'mainCategoryId' => null,
            'categoryIds' => []
        ];
        foreach($data as $row) {
            // Thêm danh mục vào danh sách nếu chưa có
            if (!in_array($row['catId'], $productDetailsInfo['categoryIds'])) {
                $productDetailsInfo['categoryIds'][] = $row['catId'];
            }

            // Xác định danh mục chính
            if ($row['mainMapping'] == 1) {
                $productDetailsInfo['mainCategoryId'] = $row['catId'];
            }
        
            $colorCode = $row['colorCode'];
            
            // Nếu màu này chưa tồn tại trong sản phẩm, thêm màu mới
            if(!isset($productDetailsInfo['colors'][$colorCode])) {
                $productDetailsInfo['colors'][$colorCode] = [
                    'colorName' => $row['colorName'],
                    'image' => $row['image'], // Giả sử ảnh giống nhau cho tất cả size của cùng một màu
                    'gender' => $row['gender'],
                    'sizes' => []
                ];
            }
        
            // Thêm size vào màu sắc đó
            if(!isset($productDetailsInfo['colors'][$colorCode]['sizes'][$row['size']])) {
                $productDetailsInfo['colors'][$colorCode]['sizes'][$row['size']] = [
                    'size' => $row['size'],
                    'varId' => $row['varId'],
                    'quantity' => $row['quantity'],
                    'price' => $row['price'],
                    'discount' => $row['discount'],
                    'gender' => $row['gender'],
                ];
            } 
        }
        return $productDetailsInfo;
    }

    public function addProVarToWishList($proId) 
    {
        header('Content-Type: application/json');

        if (!isset($_SESSION['userInfo'])) {
            echo json_encode([
                'success' => false,
                'redirect' => 'dang-nhap',
                'message' => 'Bạn cần đăng nhập để thêm sản phẩm vào danh sách yêu thích'
            ]);
            exit;
        }

        if (empty($proId)) {
            echo json_encode([
                'success' => false,
                'message' => 'Không thể thêm sản phẩm vào danh mục yêu thích'
            ]);
            exit;
        }

        $userId = $_SESSION['userInfo'][0]['userId'];
        $resultAdd = $this->Database->addProVarToWishList($userId, $proId);
        AuthService::updateUserSessionInfo();

        if (!$resultAdd) {
            echo json_encode([
                'success' => false,
                'message' => 'Thêm sản phẩm vào danh mục yêu thích thất bại'
            ]);
        } else {
            echo json_encode([
                'success' => true,
                'totalProWishList' => $_SESSION['userInfo'][0]['totalProWishList'],
                'message' => 'Thêm sản phẩm vào danh mục yêu thích thành công'
            ]);
        }
        exit;
    }

    public function showWishlistProductView()
    {   
        $userId = $_SESSION['userInfo'][0]['userId'];
        $wishListProList = $this->mapProductList($this->Database->getAllWishListProduct($userId));
        view('User/UserPages/Product/WishListProView', compact('wishListProList'));
    }

    public function removeProVarWishList()
    {
        if(isset($_POST['SubmitRemoveProVarWishList']) && ($_POST['SubmitRemoveProVarWishList'])) {
            $proId = $_POST['proId'];
            $userId = $_SESSION['userInfo'][0]['userId'];

            $resultDelete = $this->Database->deleteProVarWishList($userId, $proId);
            if(!$resultDelete) {
                toastMessage('error', 'Thất bại', 'Bỏ lưu sản phẩm khỏi danh mục yêu thích thất bại');
            }else {
                AuthService::updateUserSessionInfo();
                toastMessage('success', 'Thành công', 'Bỏ lưu sản phẩm khỏi danh mục yêu thích thành công');
            }
        }else {
            toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
        }
        redirect('WishListProductRoute');
    }
}
   