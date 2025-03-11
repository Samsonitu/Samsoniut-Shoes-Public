<?php

namespace Controllers\AdminControllers;

use \Core\BaseController;

class ProductController extends BaseController {
    protected $Model = "AdminModels\ProductModel";
    private $TARGET_DIR_PRODUCT= "./uploads/img/product/";
    private $TARGET_DIR_PRODUCT_BRAND = './uploads/img/productBrand/';

    /* BEGIN PRODUCT CATEGORY */
        public function showProductCategoryView()
        {
            $categoryList = $this->Database->getAllProductCategory();
            $countProCatInTrash = $this->Database->countProCatInTrash();
            view('Admin/AdminPages/Product/ProductCategoryView', compact('categoryList', 'countProCatInTrash'));
        }

        public function storeProductCategory() 
        {   
            if(isset($_POST['SubmitCreateProductCategory']) && ($_POST['SubmitCreateProductCategory'])) {
                $userId = $_SESSION['adminInfo'][0]['userId'];
                $categoryName = $_POST['categoryName'];
                $description = $_POST['description'];

                $isExists = $this->Database->checkExistsProductCategory($categoryName);
                if($isExists) {
                    toastMessage('warning', 'Thất bại', 'Tên danh mục sản phẩm đã tồn tại');
                }else {
                    $resultStore = $this->Database->createProductCategory($userId, $categoryName, $description);
                    if($resultStore) {
                        toastMessage('success', 'Thành công', 'Thêm danh mục sản phẩm thành công!');
                    }else {
                        toastMessage('error', 'Thất bại', 'Thêm danh mục sản phẩm thất bại!');
                    }
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminProductCategoryRoute');
        }

        public function updateProductCategory()
        {
            if(isset($_POST['SubmitUpdateProductCategory']) && ($_POST['SubmitUpdateProductCategory'])) {
                $userId = $_SESSION['adminInfo'][0]['userId'];
                $categoryId = $_POST['categoryIdUpdate'];
                $categoryName = $_POST['categoryNameUpdate'];
                $description = $_POST['descriptionUpdate'];

                $isExists = $this->Database->checkExistsProductCategory($categoryName);
                if($isExists) {
                    toastMessage('warning', 'Thất bại', 'Tên danh mục sản phẩm đã tồn tại');
                }else {
                    $resultUpdate = $this->Database->updateProductCategory($userId, $categoryId, $categoryName, $description);
                    if($resultUpdate) {
                        toastMessage('success', 'Thành công', 'Sửa danh mục sản phẩm thành công!');
                    }else {
                        toastMessage('error', 'Thất bại', 'Sửa danh mục sản phẩm thất bại!');
                    }
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminProductCategoryRoute');
        }

        public function changeStatusProductCategory()
        {
            if(isset($_POST['SubmitChangeStatusProductCategory']) && ($_POST['SubmitChangeStatusProductCategory'])) {
                $categoryId = $_POST['categoryIdChangingStatus'];
                $categoryStatus = $_POST['categoryStatus'];
                $resultChangeStatus = $this->Database->changeStatusProductCategory($categoryId, $categoryStatus);
                if($resultChangeStatus) {
                    toastMessage('success', 'Thành công', 'Chuyển trạng thái danh mục sản phẩm thành công!');
                }else {
                    toastMessage('error', 'Thất bại', 'Chuyển trạng thái danh mục sản phẩm thất bại!');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminProductCategoryRoute');
        }

        public function showProCatInTrashView()
        {
            $proCatInTrashList = $this->Database->getAllProCatInTrash();
            view('Admin/AdminPages/Product/ProCatInTrashView', compact('proCatInTrashList'));
        }

        public function tempDeleteProCat() 
        {
            if(isset($_POST['SubmitTempDeleteProCat']) && ($_POST['SubmitTempDeleteProCat'])) {
                $catId = $_POST['proCatIdTempDelete'] ?? '';
                if($catId == '') {
                    toastMessage('error', 'Thất bại', 'Không tìm thấy mã danh mục sản phẩm');
                    redirect('AdminProductCategoryRoute');
                }

                $resultTempDeleteProCat = $this->Database->tempDeleteProCat($catId);
                if($resultTempDeleteProCat) {
                    toastMessage('success', 'Thành công', 'Xóa tạm danh mục sản phẩm thành công');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }     
            redirect('AdminProductCategoryRoute');
        }

        public function restoreProCatInTrash()
        {
            if(isset($_POST['SubmitRestoreProCatInTrash']) && ($_POST['SubmitRestoreProCatInTrash'])) {
                $proCatId = $_POST['proCatIdRestore'];
                $resultRestore = $this->Database->restoreProCatInTrash($proCatId);
                if(!$resultRestore) {
                    toastMessage('error', 'Thất bại', 'Khôi phục danh mục sản phẩm thất bại');
                }else {
                    toastMessage('success', 'Thành công', 'Khôi phục danh mục sản phẩm thành công');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminProCatInTrashRoute');
        }

        public function removeProductCategory() 
        {
            if(isset($_POST['SubmitDeleteProductCategory']) && ($_POST['SubmitDeleteProductCategory'])) {
                $categoryId = $_POST['categoryIdDelete'];
                $resultDelete = $this->Database->deleteProductCategory($categoryId);
                if($resultDelete) {
                    toastMessage('success', 'Thành công', 'Xóa danh mục sản phẩm thành công!');
                }else {
                    toastMessage('error', 'Thất bại', 'Xóa danh mục sản phẩm thất bại!');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminProductCategoryRoute');
        }
    /* END PRODUCT CATEGORY */
    
    /* BEGIN PRODUCT */
        public function showProductView() 
        {
            $productList = $this->mapProductList($this->Database->getAllProduct());
            $brandList = $this->Database->getAllBrand();
            $countProVarInTrash = $this->Database->countProVarInTrash();
            $categoryList = $this->Database->getAllProductCategory();
            $supplierList = $this->Database->getAllProductSupplier();
            view('Admin/AdminPages/Product/ProductView', 
            compact('productList', 'brandList', 'categoryList', 'countProVarInTrash', 'supplierList'));
        }
        
        private function mapProductList($response) 
        {   
            $productList = [];
            foreach($response as $row) {
                if(!isset($productList[$row['proId']])) {
                    $productList[$row['proId']] = [
                        'brandId' => $row['brandId'],
                        'supId' => $row['supId'],
                        'proName' => $row['proName'],
                        'productDescription' => $row['productDescription'],
                        'productActive' => $row['productActive'],
                        'colors' => [],
                        'mainCategoryId' => null,
                        'categoryIds' => []
                    ];
                }

                // Thêm danh mục vào danh sách nếu chưa có
                if (!in_array($row['catId'], $productList[$row['proId']]['categoryIds'])) {
                    $productList[$row['proId']]['categoryIds'][] = $row['catId'];
                }

                // Xác định danh mục chính
                if ($row['mainMapping'] == 1) {
                    $productList[$row['proId']]['mainCategoryId'] = $row['catId'];
                }
            
                $colorCode = $row['colorCode'];
                
                // Nếu màu này chưa tồn tại trong sản phẩm, thêm màu mới
                if(!isset($productList[$row['proId']]['colors'][$colorCode])) {
                    $productList[$row['proId']]['colors'][$colorCode] = [
                        'colorCode' => $colorCode,
                        'colorName' => $row['colorName'],
                        'image' => $row['image'], // Giả sử ảnh giống nhau cho tất cả size của cùng một màu
                        'gender' => $row['gender'],
                        'sizes' => []
                    ];
                }
            
                // Thêm size vào màu sắc đó
                if(!isset($productList[$row['proId']]['colors'][$colorCode]['sizes'][$row['size']])) {
                    $productList[$row['proId']]['colors'][$colorCode]['sizes'][$row['size']] = [
                        'varId' => $row['varId'],
                        'size' => $row['size'],
                        'quantity' => $row['quantity'],
                        'price' => $row['price'],
                        'discount' => $row['discount'],
                        'gender' => $row['gender'],
                        'createAt' => $row['createAt'],
                        'lastUpdated' => $row['lastUpdated'],
                        'variantDescription' => $row['variantDescription'],
                        'variantActive' => $row['variantActive'],
                        'variantStatus' => $row['variantStatus'],
                    ];
                }
            }
            return $productList;
        }

        public function getSizesByProductAndColor($proId)
        {
            header('Content-Type: application/json');
        
            $colorCode = isset($_GET['colorCode']) ? urldecode($_GET['colorCode']) : '';
        
            if (empty($colorCode)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Invalid color code'
                ]);
                exit;
            }
        
            $sizes = $this->Database->getSizesByProductAndColor($proId, $colorCode);
        
            echo json_encode([
                'success' => true,
                'sizes' => $sizes
            ]);
            exit;
        }

        public function checkExistsProductByProName($proName)
        {
            header('Content-type: application/json');

            $isExists = $this->Database->checkExistsProductByProName(urldecode($proName));
            if(!empty($isExists)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Tên sản phẩm đã tồn tại',
                ]);
            } else {
                echo json_encode([
                    'success' => true,
                    'message' => 'Tên sản phẩm hợp lệ',
                    'exists' => $isExists,
                    'proName' => $proName
                ]);
            }
            exit;
        }

        public function showProductCreationForm()
        {
            $proCatIdAndProCatNameList = $this->Database->getProCatIdAndProCatName();
            $brandList = $this->Database->getAllBrand();
            $productSupplierList = $this->Database->getAllProductSupplier();
            view('Admin/AdminPages/Product/CreateProductView', compact('proCatIdAndProCatNameList', 'brandList', 'productSupplierList'));
        }
        
        public function storeProduct() 
        {
            if(isset($_POST['SubmitCreateProduct']) && ($_POST['SubmitCreateProduct'])) {
                $dataValidate = $this->validateDataFormCreateProduct($_POST);
                if(!$dataValidate) redirect('AdminCreateProductRoute');

                $imagePath = $this->uploadProductImageForCreate($_FILES["proImage"], $this->TARGET_DIR_PRODUCT);
                if (!$imagePath) {
                    redirect('AdminCreateProductRoute');
                }
        
                $resultCreateProduct = $this->Database->createProduct($dataValidate , $imagePath);
                if ($resultCreateProduct) {
                    toastMessage('success', 'Thành công', 'Sản phẩm đã được thêm!');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminCreateProductRoute');
        }

        private function validateDataFormCreateProduct($data)
        {
            $requiredFields = [
                'Tên sản phẩm' => 'proName', 
                'Mã thương hiệu' => 'brandId', 
                'Mã danh mục chính của sản phẩm' => 'mainCategoryId',
                'Giới tính' => 'gender',
                'Mã màu sắc' => 'colorCode',
                'Số lượng' => 'quantity',
                'Tên màu sắc' => 'colorName',
                'Giá' => 'price', 
                'Kích thước' => 'size',
                'Nhà cung cấp' => 'supId'
            ];

            if($data['supId'] == '') {
                toastMessage('error', 'Lỗi', 'Nhà cung cấp không được để trống');
                return false;
            }   

            foreach ($requiredFields as $fieldLabel => $field) {
                if (empty($data[$field] ?? '')) {
                    toastMessage('error', 'Lỗi', "$fieldLabel không được để trống");
                    return false;
                }
            }
        
            $intFields = ['brandId', 'mainCategoryId', 'quantity', 'size', 'discount'];
            foreach ($intFields as $field) {
                if (!ctype_digit(strval($data[$field] ?? '0'))) {
                    toastMessage('error', 'Lỗi', "$field phải là số nguyên hợp lệ");
                    return false;
                }
            }
        
            $data['price'] = str_replace(',', '', $data['price'] ?? '');
            if (!is_numeric($data['price'])) {
                toastMessage('error', 'Lỗi', "Giá sản phẩm không hợp lệ");
                return false;
            }

            if (!is_numeric($data['discount'])) {
                toastMessage('error', 'Lỗi', "Giá sản phẩm không hợp lệ");
                return false;
            }
        
            if (!preg_match('/^#([a-fA-F0-9]{6})$/', $data['colorCode'] ?? '')) {
                toastMessage('danger', 'Lỗi', "Mã màu không hợp lệ");
                return false;
            }
        
            if (strlen($data['proName'] ?? '') > 50) {
                toastMessage('danger', 'Lỗi', "Tên sản phẩm không được quá 50 ký tự");
                return false;
            }
        
            if (isset($data['subCategoryIds']) && is_array($data['subCategoryIds'])) {
                foreach ($data['subCategoryIds'] as $subCategory) {
                    if (!ctype_digit(strval($subCategory))) {
                        toastMessage('danger', 'Lỗi', "Mã danh mục phụ không hợp lệ");
                        return false;
                    }
                }
            }
        
            $data['proDesc'] = htmlspecialchars($data['proDesc'] ?? '');
            $data['varDesc'] = htmlspecialchars($data['varDesc'] ?? '');
            
            return $data;
        }

        private function uploadProductImageForCreate($file, $target_dir) 
        {   
            // Kiểm tra xem có file nào được tải lên không
            if (!isset($file) || $file["error"] != 0) {
                toastMessage('error', 'Thất bại', 'Không có ảnh nào được tải lên!');
                return false;
            }

            // Kiểm tra và tạo thư mục nếu chưa tồn tại
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Đường dẫn lưu ảnh
            $target_file = $target_dir . basename($file["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Kiểm tra định dạng ảnh hợp lệ
            $allowed_types = ["jpg", "png", "jpeg", "gif", "webp"];
            if (!in_array($imageFileType, $allowed_types)) {
                toastMessage('error', 'Thất bại', 'Định dạng ảnh không hợp lệ!');
                return false;
            }

            // Kiểm tra dung lượng ảnh (giới hạn 5MB)
            if ($file["size"] > 5 * 1024 * 1024) {
                toastMessage('error', 'Thất bại', 'Dung lượng ảnh quá lớn! (tối đa 5MB)');
                return false;
            }

            // Di chuyển file vào thư mục đích
            if (!file_exists($target_file)) {
                if (!move_uploaded_file($file["tmp_name"], $target_file)) {
                    toastMessage('error', 'Thất bại', 'Không thể lưu ảnh sản phẩm!');
                    return false;
                }
            }

            return $target_file; // Trả về đường dẫn file nếu thành công
        }

        public function showVariantProductCreationForm($proId) 
        {
            $response = $this->Database->getProductExtraInfo($proId);
            $productExtraInfo = [
                'proId' => $response[0]['proId'],
                'proName' => $response[0]['proName'],
                'colors' => []
            ];
            foreach($response as $row) {
                $colorCode = $row['colorCode'];
                if(!isset($productExtraInfo['colors'][$colorCode])) {
                    $productExtraInfo['colors'][$colorCode] = [
                        'colorName' => $row['colorName'],
                        'image' => $row['image'], // Giả sử ảnh giống nhau cho tất cả size của cùng một màu
                        'sizes' => []
                    ];
                }
                $productExtraInfo['colors'][$colorCode]['sizes'][] = ['size' => $row['size']];
            } 
            view('Admin/AdminPages/Product/CreateVariantProductView', compact('productExtraInfo'));
        }

        public function storeVariantProduct()
        {
            if(isset($_POST['SubmitCreateVariantProduct']) && ($_POST['SubmitCreateVariantProduct'])) {
                $dataValidate = $this->validateDataFormCreateVariantProduct($_POST);
                if(!$dataValidate) redirect('AdminCreateVariantProductRoute', $_POST['proId']);

                $isExists = $this->Database->checkExistsVariantProductForCreate($dataValidate);
                if(!empty($isExists)) {
                    toastMessage('error', 'Thất bại', 'Biến thể này đã tồn tại');
                    redirect("AdminCreateVariantProductRoute", ['proId' => $_POST['proId']]);
                } 

                $imagePath = $this->uploadProductImageForCreate($_FILES["proImage"], $this->TARGET_DIR_PRODUCT);
                if (!$imagePath) {
                    redirect("AdminCreateVariantProductRoute", ['proId' => $_POST['proId']]);
                }
        
                $resultCreateProduct = $this->Database->createVariantProduct($dataValidate , $imagePath);
                if ($resultCreateProduct) {
                    toastMessage('success', 'Thành công', 'Sản phẩm đã được thêm!');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect("AdminCreateVariantProductRoute", ['proId' => $_POST['proId']]);
        }

        private function validateDataFormCreateVariantProduct($data)
        {
            if(!array_key_exists('proId', $data)) {
                toastMessage('error', "Lỗi", "Không tìm thấy mã sản phẩm của biến thể");
                return false;
            }

            $requiredFields = [
                'Giới tính' => 'gender',
                'Kích thước' => 'size',
                'Tên màu sắc' => 'colorName',
                'Số lượng' => 'quantity',
                'Mã màu sắc' => 'colorCode',
                'Giá' => 'price', 
            ];
        
            foreach ($requiredFields as $fieldLabel => $field) {
                if (empty($data[$field] ?? '')) {
                    toastMessage('error', 'Lỗi', "$fieldLabel không được để trống");
                    return false;
                }
            }   

            $intFields = ['quantity', 'size', 'discount'];
            foreach ($intFields as $field) {
                if (!ctype_digit(strval($data[$field] ?? '0'))) {
                    toastMessage('error', 'Lỗi', "$field phải là số nguyên hợp lệ");
                    return false;
                }
            }
        
            $data['price'] = str_replace(',', '', $data['price'] ?? '');
            if (!is_numeric($data['price'])) {
                toastMessage('error', 'Lỗi', "Giá sản phẩm không hợp lệ");
                return false;
            }
        
            if (!preg_match('/^#([a-fA-F0-9]{6})$/', $data['colorCode'] ?? '')) {
                toastMessage('danger', 'Lỗi', "Mã màu không hợp lệ");
                return false;
            }

            $data['varDesc'] = htmlspecialchars($data['varDesc'] ?? '');

            return $data;
        }

        public function updateProduct()
        {
            if(isset($_POST['SubmitUpdateProduct']) && ($_POST['SubmitUpdateProduct'])) {
                $productId = $_POST['proIdUpdate'];
                $productName = $_POST['proNameUpdate'];
                $proBrandId = $_POST['proBrandIdUpdate'];
                $proSupId = $_POST['proSupIdUpdate'];
                $description = $_POST['proDescUpdate'];
                $proMainCatId = $_POST['proMainCatIdUpdate'];
                $proCatIdsUpdate = $_POST['proCatIdsUpdate'];
                
                $oldProduct = $this->Database->getProNameByProId($productId);
                if (!$oldProduct) {
                    toastMessage('error', 'Lỗi', 'Không tìm thấy sản phẩm!');
                    redirect('AdminProductRoute');
                    return;
                }

                if ($productName != $oldProduct[0]['proName']) {
                    $isExists = $this->Database->checkExistsProductByProName($productName);
                    if ($isExists) {
                        toastMessage('warning', 'Cảnh báo', 'Tên sản phẩm đã tồn tại');
                        redirect('AdminProductRoute');
                        return;
                    }
                }

                $resultUpdate = $this->Database->updateProduct($proBrandId, $proSupId, $proMainCatId, $proCatIdsUpdate, $productId, $productName, $description);
                if ($resultUpdate) {
                    toastMessage('success', 'Thành công', 'Sửa sản phẩm thành công!');
                } else {
                    toastMessage('error', 'Thất bại', 'Sửa sản phẩm thất bại!');
                }
            }
            redirect('AdminProductRoute');
        }

        public function updateProductVariant()
        {
            if(isset($_POST['SubmitUpdateProductVariant']) && ($_POST['SubmitUpdateProductVariant'])) {
                $dataValidate = $this->validateDataFormUpdateVariantProduct($_POST);
                if(!$dataValidate) redirect('AdminProductRoute');

                $imagePath = $this->uploadProductImageForUpdate($_FILES["proVarImageUpdate"], $this->TARGET_DIR_PRODUCT);
                $isExists = $this->Database->checkExistsVariantProductForUpdate($dataValidate, $imagePath);
                if(!empty($isExists)) {
                    toastMessage('error', 'Thất bại', 'Biến thể này đã tồn tại');
                    redirect("AdminProductRoute");
                }

                $resultUpdateProductVariant = $this->Database->updateProductVariant($dataValidate , $imagePath);
                if ($resultUpdateProductVariant) {
                    toastMessage('success', 'Thành công', 'Cập nhật biến thể sản phẩm thành công!');
                }else {
                    toastMessage('error', 'Thất bại', 'Cập nhật biến thể sản phẩm thất bại!');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminProductRoute');
        }

        private function validateDataFormUpdateVariantProduct($data)
        {
            if(!array_key_exists('proIdUpdate', $data)) {
                toastMessage('error', "Lỗi", "Không tìm thấy mã sản phẩm của biến thể");
                return false;
            }

            if(!array_key_exists('proVarIdUpdate', $data)) {
                toastMessage('error', "Lỗi", "Không tìm thấy mã biến thể của sản phẩm");
                return false;
            }

            $requiredFields = [
                'Giới tính' => 'proVarGenderUpdate',
                'Kích thước' => 'sizeUpdate',
                'Tên màu sắc' => 'colorNameUpdate',
                'Số lượng' => 'quantityUpdate',
                'Mã màu sắc' => 'colorCodeUpdate',
                'Giá' => 'priceUpdate', 
            ];
        
            foreach ($requiredFields as $fieldLabel => $field) {
                if (empty($data[$field] ?? '')) {
                    toastMessage('error', 'Lỗi', "$fieldLabel không được để trống");
                    return false;
                }
            }   

            $intFields = ['quantityUpdate', 'sizeUpdate', 'discountUpdate'];
            foreach ($intFields as $field) {
                if (isset($data[$field]) && $data[$field] && !ctype_digit(strval($data[$field] ?? '0'))) {
                    toastMessage('error', 'Lỗi', "$field phải là số nguyên hợp lệ");
                    return false;
                }
            }
        
            $data['priceUpdate'] = str_replace(',', '', $data['priceUpdate'] ?? '');
            if (!is_numeric($data['priceUpdate'])) {
                toastMessage('error', 'Lỗi', "Giá sản phẩm không hợp lệ");
                return false;
            }
        
            if (!preg_match('/^#([a-fA-F0-9]{6})$/', $data['colorCodeUpdate'] ?? '')) {
                toastMessage('danger', 'Lỗi', "Mã màu không hợp lệ");
                return false;
            }

            $data['proVarDescUpdate'] = htmlspecialchars($data['proVarDescUpdate'] ?? '');

            return $data;
        }

        private function uploadProductImageForUpdate($file, $target_dir) 
        {   
            // Kiểm tra xem có file nào được tải lên không
            if (!isset($file) || $file["error"] != 0) {
                return '';
            }

            // Kiểm tra và tạo thư mục nếu chưa tồn tại
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Đường dẫn lưu ảnh
            $target_file = $target_dir . basename($file["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Kiểm tra định dạng ảnh hợp lệ
            $allowed_types = ["jpg", "png", "jpeg", "gif", "webp"];
            if (!in_array($imageFileType, $allowed_types)) {
                toastMessage('error', 'Thất bại', 'Định dạng ảnh không hợp lệ!');
                redirect('AdminProductRoute');
            }

            // Kiểm tra dung lượng ảnh (giới hạn 5MB)
            if ($file["size"] > 5 * 1024 * 1024) {
                toastMessage('error', 'Thất bại', 'Dung lượng ảnh quá lớn! (tối đa 5MB)');
                redirect('AdminProductRoute');
            }

            // Di chuyển file vào thư mục đích
            if (!file_exists($target_file)) {
                if (!move_uploaded_file($file["tmp_name"], $target_file)) {
                    toastMessage('error', 'Thất bại', 'Không thể lưu ảnh sản phẩm!');
                    redirect('AdminProductRoute');
                }
            }

            return $target_file; // Trả về đường dẫn file nếu thành công
        }

        public function changeStatusProductVariant()
        {
            if(isset($_POST['SubmitTurnOffStatusAllProductVariant']) && ($_POST['SubmitTurnOffStatusAllProductVariant'])) {
                $resultUpdate = $this->Database->changeStatusProductVariant($_POST['proId'], null, 0);
                if($resultUpdate) {
                    toastMessage('success', 'Thành công', 'Tắt trạng thái hiển thị tất cả biến thể của sản phẩm thành công!');
                    redirect('AdminProductRoute');
                }
            }
            if(isset($_POST['SubmitTurnOnStatusAllProductVariant']) && ($_POST['SubmitTurnOnStatusAllProductVariant'])) {
                $resultUpdate = $this->Database->changeStatusProductVariant($_POST['proId'], null, 1);
                if($resultUpdate) {
                    toastMessage('success', 'Thành công', 'Hiện trạng thái hiển thị tất cả biến thể của sản phẩm thành công!');
                    redirect('AdminProductRoute');
                }
            }
            if(isset($_POST['SubmitChangeStatusVariantProduct']) && ($_POST['SubmitChangeStatusVariantProduct'])) {
                $resultUpdate = $this->Database->changeStatusProductVariant($_POST['proId'], $_POST['varId'], $_POST['varStatus']);
                if($resultUpdate) {
                    toastMessage('success', 'Thành công', 'Thay đổi trạng thái hiển thị biến thể của sản phẩm thành công!');
                    redirect('AdminProductRoute');
                }
            }
            toastMessage('error', 'Thất bại', 'Thay đổi trạng thái hiển thị biến thế của sản phẩm thất bại!');
            redirect('AdminProductRoute');
        }

        public function tempDeleteProduct() 
        {
            if(isset($_POST['SubmitTempDeleteProduct']) && ($_POST['SubmitTempDeleteProduct'])) {
                $proId = $_POST['proId'] ?? '';
                if($proId == '') {
                    toastMessage('error', 'Thất bại', 'Không tìm thấy mã sản phẩm');
                    redirect('AdminProductRoute');
                }

                $resultTempDeleteProduct = $this->Database->tempDeleteProduct($proId, null);
                if($resultTempDeleteProduct) {
                    toastMessage('success', 'Thành công', 'Xóa tạm sản phẩm thành công');
                }else {
                    toastMessage('error', 'Thất bại', 'Xóa tạm sản phẩm thất bại');
                }
            }

            if(isset($_POST['SubmitTempDeleteProductVariant']) && ($_POST['SubmitTempDeleteProductVariant'])) {
                $proId = $_POST['proId'] ?? '';
                $varId = $_POST['varId'] ?? '';
                if($proId == '') {
                    toastMessage('error', 'Thất bại', 'Không tìm thấy mã sản phẩm');
                    redirect('AdminProductRoute');
                }

                if($varId == '') {
                    toastMessage('error', 'Thất bại', 'Không tìm thấy mã biến thể sản phẩm');
                    redirect('AdminProductRoute');
                }
                

                $resultTempDeleteProduct = $this->Database->tempDeleteProduct($proId, $varId);
                if($resultTempDeleteProduct) {
                    toastMessage('success', 'Thành công', 'Xóa tạm biến thể sản phẩm thành công');
                }else {
                    toastMessage('error', 'Thất bại', 'Xóa tạm biến thể sản phẩm thất bại');
                }
            }

            redirect('AdminProductRoute');
        }

        public function restoreProVarInTrash()
        {
            if(isset($_POST['SubmitRestoreProVarInTrash']) && ($_POST['SubmitRestoreProVarInTrash'])) {
                $proId = $_POST['proId'] ?? '';
                $varId = $_POST['varId'] ?? '';
                $resultRestore = $this->Database->restoreProVarInTrash($proId, $varId);
                if(!$resultRestore) {
                    toastMessage('error', 'Thất bại', 'Khôi phục biến thể sản phẩm thất bại');
                }else {
                    toastMessage('success', 'Thành công', 'Khôi phục biến thể sản phẩm thành công');
                }
                redirect('AdminProVarInTrashRoute');
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
        }

        public function showProVarInTrashView()
        {
            $proVarInTrashList = $this->Database->getAllProVarInTrash();
            view('Admin/AdminPages/Product/ProVarInTrashView', compact('proVarInTrashList'));
        }

        public function deleteProVarPermanently() 
        {
            if(isset($_POST['SubmitDeleteProductVariantPermanently']) && ($_POST['SubmitDeleteProductVariantPermanently'])) {
                $proId = $_POST['proId'] ?? '';
                $varId = $_POST['varId'] ?? '';
                $resultDelete = $this->Database->deleteProductVariantPermanently($proId, $varId);
                if($resultDelete) {
                    toastMessage('success', 'Thành công', 'Xóa vĩnh viễn biến thể sản phẩm thành công');
                }
                redirect('AdminProVarInTrashRoute');
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
        }

        public function showProductDetailsView($proId)
        {
            $productDetailsInfo = $this->mapProductDetailsInfo($this->Database->getProductDetailsByProId($proId));
            view('Admin/AdminPages/product/ProductDetailsView', compact('productDetailsInfo'));
        }

        private function mapProductDetailsInfo($response) 
        {
            $productDetailsInfo = [
                'proId' => $response[0]['proId'],
                'brandName' => $response[0]['brandName'], 
                'supName' => $response[0]['supName'], 
                'proName' => $response[0]['proName'],
                'productDescription' => $response[0]['proDesc'],
                'mainCategory' => null, // Chứa danh mục chính
                'categories' => [], // Chứa danh sách tất cả danh mục
                'colors' => [] // Chứa danh sách màu và kích thước
            ];
            
            foreach ($response as $row) {
                // 🔹 Kiểm tra danh mục có tồn tại chưa
                $existingCategories = array_column($productDetailsInfo['categories'], 'catName');
            
                if (!in_array($row['catName'], $existingCategories)) {
                    $productDetailsInfo['categories'][] = [
                        'catName' => $row['catName'],
                        'mainMapping' => $row['mainMapping'],
                        'catActive' => $row['catActive']
                    ];
                }
            
                // Xác định danh mục chính
                if ($row['mainMapping'] == 1) {
                    $productDetailsInfo['mainCategory'] = $row['catName'];
                }
            
                $colorCode = $row['colorCode'];
            
                // 🔹 Kiểm tra xem màu sắc đã tồn tại chưa
                if (!isset($productDetailsInfo['colors'][$colorCode])) {
                    $productDetailsInfo['colors'][$colorCode] = [
                        'colorCode' => $row['colorCode'],
                        'colorName' => $row['colorName'],
                        'image' => $row['image'],
                        'sizes' => [] // Chứa danh sách size của màu này
                    ];
                }
            
                // 🔹 Kiểm tra xem biến thể (size) đã tồn tại chưa
                $existingSizes = array_column($productDetailsInfo['colors'][$colorCode]['sizes'], 'varId');
            
                if (!in_array($row['varId'], $existingSizes)) {
                    $productDetailsInfo['colors'][$colorCode]['sizes'][] = [
                        'varId' => $row['varId'],
                        'size' => $row['size'],
                        'quantity' => $row['quantity'],
                        'price' => $row['price'],
                        'discount' => $row['discount'],
                        'status' => $row['status'],
                        'createAt' => $row['varCreateAt'],
                        'lastUpdated' => $row['lastUpdated'],
                        'variantDescription' => $row['varDesc'],
                    ];
                }
            }
            
            return $productDetailsInfo;
        }
    /* END PRODUCT */

    /* BEGIN PRODUCT SUPPLIER */
        public function showProductSupplierView()
        {
            $productSupplierList = $this->Database->getAllProductSupplier();
            view('Admin/AdminPages/Product/ProductSupplierView', compact('productSupplierList'));
        }

        public function createProductSupplier()
        {
            if(isset($_POST['SubmitCreateProductSupplier']) && ($_POST['SubmitCreateProductSupplier'])) {
                $productSuplierInfo = $this->validateDataFormCreateProSupplier($_POST); 
                $isExists = $this->Database->checkExistsProSupplierByName($productSuplierInfo['supName']);
                if($isExists) {
                    toastMessage('error', 'Thất bại', 'Tên nhà cung cấp đã tồn tại');
                    redirect('AdminProductSupplierRoute');
                }

                $resultCreate = $this->Database->createProductSupplier($productSuplierInfo);
                if(!$resultCreate) {
                    toastMessage('error', 'Thất bại', 'Tạo mới thông tin nhà cung cấp thất bại');
                }else {
                    toastMessage('success', 'Thành công', 'Tạo mới thông tin nhà cung cấp thành công');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminProductSupplierRoute');
        }

        private function validateDataFormCreateProSupplier($data)
        {
            $errors = [];
            // Validate Tên nhà cung cấp
            if (empty($data['supName'])) {
                $errors['supName'] = "Tên nhà cung cấp không được để trống.";
            } elseif (strlen($data['supName']) > 50) {
                $errors['supName'] = "Tên nhà cung cấp không được vượt quá 50 ký tự.";
            }

            // Validate Email
            if (empty($data['email'])) {
                $errors['email'] = "Email không được để trống.";
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Email không hợp lệ.";
            } elseif (strlen($data['email']) > 200) {
                $errors['email'] = "Email không được vượt quá 200 ký tự.";
            }

            // Validate Số điện thoại
            if (empty($data['phoneNumber'])) {
                $errors['phoneNumber'] = "Số điện thoại không được để trống.";
            } elseif (!preg_match('/^[0-9\s]{8,20}$/', $data['phoneNumber'])) {
                $errors['phoneNumber'] = "Số điện thoại không hợp lệ. Chỉ nhập số và dấu cách, độ dài từ 8 đến 20 ký tự.";
            }

            // Validate Mô tả (cho phép rỗng nhưng không quá 200 ký tự)
            if (!empty($data['description']) && strlen($data['description']) > 200) {
                $errors['description'] = "Mô tả không được vượt quá 200 ký tự.";
            }

            // Nếu có lỗi, trả về lỗi
            if (!empty($errors)) {
                toastMessage('error', 'Lỗi nhập liệu', implode("<br>", $errors));
                redirect('AdminProductSupplierRoute');
                exit();
            }

            return $data;
        }

        public function updateProductSupplier()
        {
            if(isset($_POST['SubmitUpdateProductSupplier']) && ($_POST['SubmitUpdateProductSupplier'])) {
                $productSuplierInfo = $this->validateDataFormUpdateProSupplier($_POST);
                if(!trim(strtolower($productSuplierInfo['supName'])) === trim(strtolower($productSuplierInfo['supNameOld']))) {
                    $isExists = $this->Database->checkExistsProSupplierByName($productSuplierInfo['supName']);
                    if($isExists) {
                        toastMessage('error', 'Thất bại', 'Tên nhà cung cấp đã tồn tại');
                        redirect('AdminProductSupplierRoute');
                    }
                }

                $resultUpdate = $this->Database->updateProductSupplier($productSuplierInfo);
                if(!$resultUpdate) {
                    toastMessage('error', 'Thất bại', 'Cập nhật thông tin nhà cung cấp thất bại');
                }else {
                    toastMessage('success', 'Thành công', 'Cập nhật thông tin nhà cung cấp thành công');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminProductSupplierRoute');
        }

        private function validateDataFormUpdateProSupplier($data)
        {
            $errors = [];
            // Validate Mã nhà cung cấp
            if (empty($data['supId'])) {
                $errors['supId'] = "Mã nhà cung cấp không được để trống.";
            }

            // Validate Tên nhà cung cấp
            if (empty($data['supName'])) {
                $errors['supName'] = "Tên nhà cung cấp không được để trống.";
            } elseif (strlen($data['supName']) > 50) {
                $errors['supName'] = "Tên nhà cung cấp không được vượt quá 50 ký tự.";
            }

            // Validate Tên cũ của nhà cung cấp
            if (empty($data['supNameOld'])) {
                $errors['supNameOld'] = "Không tìm thấy tên cũ của nhà cung cấp.";
            } elseif (strlen($data['supNameOld']) > 50) {
                $errors['supNameOld'] = "Lỗi tên cũ của nhà cung cấp không được vượt quá 50 ký tự.";
            }

            // Validate Email
            if (empty($data['email'])) {
                $errors['email'] = "Email không được để trống.";
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Email không hợp lệ.";
            } elseif (strlen($data['email']) > 200) {
                $errors['email'] = "Email không được vượt quá 200 ký tự.";
            }

            // Validate Số điện thoại
            if (empty($data['phoneNumber'])) {
                $errors['phoneNumber'] = "Số điện thoại không được để trống.";
            } elseif (!preg_match('/^[0-9\s]{8,20}$/', $data['phoneNumber'])) {
                $errors['phoneNumber'] = "Số điện thoại không hợp lệ. Chỉ nhập số và dấu cách, độ dài từ 8 đến 20 ký tự.";
            }

            // Validate Mô tả (cho phép rỗng nhưng không quá 200 ký tự)
            if (!empty($data['description']) && strlen($data['description']) > 200) {
                $errors['description'] = "Mô tả không được vượt quá 200 ký tự.";
            }

            // Nếu có lỗi, trả về lỗi
            if (!empty($errors)) {
                toastMessage('error', 'Lỗi nhập liệu', implode("<br>", $errors));
                redirect('AdminProductSupplierRoute');
                exit();
            }

            return $data;
        }

        public function deleteProductSupplier()
        {
            if(isset($_POST['SubmitDeleteProductSupplier']) && ($_POST['SubmitDeleteProductSupplier'])) {
                $supId = $_POST['supId'] ?? '';
                $resultDelete = $this->Database->deleteProductSupplier($supId);
                if($resultDelete) {
                    toastMessage('success', 'Thành công', 'Xóa thông tin nhà cung cấp thành công');
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminProductSupplierRoute');
        }
    /* END PRODUCT SUPPLIER */

    /* BEGIN PRODUCT BRAND */
        public function showProductBrandView()
        {
            $brandList = $this->Database->getAllProductBrand();
            view('Admin/AdminPages/Product/ProductBrandView', compact('brandList'));
        }

        public function storeProductBrand() 
        {   
            if(isset($_POST['SubmitCreateProductBrand']) && ($_POST['SubmitCreateProductBrand'])) {
                $brandName = $_POST['brandName'];
                $description = $_POST['description'];

                $imagePath = $this->uploadBrandImage($_FILES["brandImage"], $this->TARGET_DIR_PRODUCT_BRAND);
                if (!$imagePath) {
                    redirect('AdminProductBrandRoute');
                }

                $isExists = $this->Database->checkExistsProductBrand($brandName, $imagePath);
                if($isExists) {
                    toastMessage('warning', 'Thất bại', 'Tên thương hiệu sản phẩm đã tồn tại');
                }else {
                    $resultStore = $this->Database->createProductBrand($brandName, $imagePath, $description);
                    if($resultStore) {
                        toastMessage('success', 'Thành công', 'Thêm thương hiệu sản phẩm thành công!');
                    }else {
                        toastMessage('error', 'Thất bại', 'Thêm thương hiệu sản phẩm thất bại!');
                    }
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminProductBrandRoute');
        }

        private function uploadBrandImage($file, $target_dir) 
        {   
            // Kiểm tra xem có file nào được tải lên không
            if (!isset($file) || $file["error"] != 0) {
                toastMessage('error', 'Thất bại', 'Không có ảnh nào được tải lên!');
                return false;
            }

            // Kiểm tra và tạo thư mục nếu chưa tồn tại
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Đường dẫn lưu ảnh
            $target_file = $target_dir . basename($file["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Kiểm tra định dạng ảnh hợp lệ
            $allowed_types = ["jpg", "png", "jpeg", "gif", "webp"];
            if (!in_array($imageFileType, $allowed_types)) {
                toastMessage('error', 'Thất bại', 'Định dạng ảnh không hợp lệ!');
                return false;
            }

            // Kiểm tra dung lượng ảnh (giới hạn 5MB)
            if ($file["size"] > 5 * 1024 * 1024) {
                toastMessage('error', 'Thất bại', 'Dung lượng ảnh quá lớn! (tối đa 5MB)');
                return false;
            }

            // Di chuyển file vào thư mục đích
            if (!file_exists($target_file)) {
                if (!move_uploaded_file($file["tmp_name"], $target_file)) {
                    toastMessage('error', 'Thất bại', 'Không thể lưu ảnh sản phẩm!');
                    return false;
                }
            }

            return $target_file; // Trả về đường dẫn file nếu thành công
        }

        public function updateProductBrand()
        {
            if(isset($_POST['SubmitUpdateProductBrand']) && ($_POST['SubmitUpdateProductBrand'])) {
                $brandId = $_POST['brandIdUpdate'];
                $brandName = $_POST['brandNameUpdate'];
                $description = $_POST['descriptionUpdate'];

                if(isset($_FILES['brandImageUpdate']) && ($_FILES['brandImageUpdate'])) {
                    $imagePath = $this->uploadBrandImage($_FILES["brandImageUpdate"], $this->TARGET_DIR_PRODUCT_BRAND);
                    if (!$imagePath) {
                        redirect('AdminProductBrandRoute');
                    }
                }else {
                    $imagePath = null;
                }

                $isExists = $this->Database->checkExistsProductBrand($brandName, $imagePath, $description);
                if($isExists) {
                    toastMessage('warning', 'Thất bại', 'Tên thương hiệu sản phẩm đã tồn tại');
                }else {
                    $resultUpdate = $this->Database->updateProductBrand($brandId, $brandName, $imagePath, $description);
                    if($resultUpdate) {
                        toastMessage('success', 'Thành công', 'Sửa thương hiệu sản phẩm thành công!');
                    }else {
                        toastMessage('error', 'Thất bại', 'Sửa thương hiệu sản phẩm thất bại!');
                    }
                }
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminProductBrandRoute');
        }

        public function removeProductBrand() 
        {
            if(isset($_POST['SubmitDeleteProductBrand']) && ($_POST['SubmitDeleteProductBrand'])) {
                $brandId = $_POST['proBrandIdDelete'];
                $resultDelete = $this->Database->deleteProductBrand($brandId);
                if($resultDelete) toastMessage('success', 'Thành công', 'Xóa thông tin thương hiệu thành công!');
            }else {
                toastMessage('error', 'Lỗi rồi', 'Kiểm tra biểu mẫu được gửi đi');
            }
            redirect('AdminProductBrandRoute');
        }
    /* END PRODUCT BRAND */
}