<?php 

namespace Controllers\UserControllers;
use Core\BaseController;

class SearchController extends BaseController {
    protected $Model = "UserModels\SearchModel";

    public function search($proName) { 
        header('Content-Type: application/json');

        if (empty($proName)) {
            echo json_encode([
                'success' => false,
                'message' => 'Không tìm thấy tên sản phẩm'
            ]);
            exit;
        }
    
        $productList = $this->Database->getProductByProName($proName);
    
        echo json_encode([
            'success' => true,
            'productList' => $productList
        ]);
        exit;
    }
}
