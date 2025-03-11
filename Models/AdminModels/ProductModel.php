<?php

namespace Models\AdminModels;

use Core\Model;
use PDO;
use PDOException;
class ProductModel extends Model
{
    /* BEGIN PRODUCT CATEGORY */
        public function getAllProductCategory() 
        {
            $query = "SELECT * FROM product_category;";
            return $this->SelectRow($query);
        }

        public function countProCatInTrash() 
        {
            $query = "SELECT count(catId) as total FROM product_category WHERE active = 0;";
            return $this->SelectRow($query);    
        }

        public function getAllProCatInTrash()
        {
            $query = "SELECT * FROM product_category WHERE active = 0";
            return $this->SelectRow($query);
        }

        public function checkExistsProductCategory($categoryName, $description = null)
        {   
            $query = "SELECT catName FROM product_category 
                WHERE LOWER(catName) = TRIM(LOWER(?)) AND LOWER(catName) = TRIM(LOWER(?))";
            return $this->SelectRow($query, [$categoryName, $description]);
        }

        public function createProductCategory($userId, $categoryName, $description) 
        {
            $query = "INSERT INTO `product_category`(`userId`, `catName`, `catSlug`, `description`) 
                VALUES (?, ?, ?, ?);";
            return $this->InsertRow($query, [$userId, $categoryName, convertToSlug($categoryName), $description]);
        }

        public function updateProductCategory($userId, $categoryId, $categoryName, $description) 
        {
            $query = "UPDATE `product_category` 
                SET `userId` = ?, `catName` = ?, `catSlug` = ?, `description` = ? 
                WHERE `catId` = ? ";    
            return $this->UpdateRow($query, [$userId, $categoryName, convertToSlug($categoryName), $description, $categoryId]);
        }

        public function tempDeleteProCat($catId)  
        {
            $query1 = "SELECT mainMapping FROM mapping_pro_cat WHERE catId = ? LIMIT 1";
            $resultQuery1 = $this->SelectRow($query1, [$catId]); 
            if($resultQuery1[0]['mainMapping'] == 1) {
                toastMessage('error', 'Thất bại', 'Danh mục này không thể xóa tạm vì đang có sản phẩm chọn làm danh mục chính');
                return false;
            } 

            $query2 = "UPDATE product_category SET lastUpdated = CURRENT_TIMESTAMP(), active = 0 WHERE catId = ? ";
            $resultQuery2 = $this->UpdateRow($query2, [$catId]);
            if(!$resultQuery2) {
                toastMessage('error', 'Thất bại', 'Thất bại khi xóa tạm danh mục sản phẩm');
                return false;
            }

            return true;
        }   

        public function deleteProductCategory($categoryId = 0) 
        {
            $query1 = "SELECT mainMapping FROM mapping_pro_cat WHERE catId = ? LIMIT 1";
            $resultQuery1 = $this->SelectRow($query1, [$categoryId]); 
            if(!$resultQuery1) {
                toastMessage('error', 'Thất bại', 'Lỗi khi kiểm tra danh mục này có đang làm danh mục chính hay không');
                return false;
            } 
            if($resultQuery1[0]['mainMapping'] == 1) {
                toastMessage('error', 'Thất bại', 'Danh mục này không thể xóa tạm vì đang có sản phẩm chọn làm danh mục chính');
                return false;
            } 

            $query2 = "DELETE FROM `mapping_pro_cat` WHERE `catId` = ?";
            $resultQuery2 = $this->DeleteRow($query2, [$categoryId]);
            if(!$resultQuery2) {
                toastMessage('error', 'Thất bại', 'Lỗi khi xóa các liên kết sản phẩm với danh mục này');
                return false;
            }

            $query3 = "DELETE FROM `product_category` WHERE `catId` = ?";    
            $resultQuery3 = $this->DeleteRow($query3, [$categoryId]);
            if(!$resultQuery3) {
                toastMessage('error', 'Thất bại', 'Thất bại khi xóa vĩnh viễn danh mục sản phẩm này');
                return false;
            }

            return true;
        }

        public function changeStatusProductCategory($categoryId, $categoryStatus)
        {
            $newStatus = $categoryStatus == 1 ? 0 : 1;
            $query = "UPDATE `product_category`
                SET `status` = $newStatus, `updateAt` = NOW()
                WHERE `catId` = ?";
            return $this->UpdateRow($query, [$categoryId]);
        }

        public function getProCatIdAndProCatName()
        {   
            $query = "SELECT catId, catName FROM product_category";
            return $this->SelectRow($query);
        }

        public function restoreProCatInTrash($proCatId)
        {
            $query = "UPDATE product_category SET active = 1 WHERE catId = ?";
            return $this->UpdateRow($query, [$proCatId]);
        }
    /* END PRODUCT CATEGORY */

    /* BEGIN PRODUCT */
        public function getAllProduct() 
        {
            $query = "SELECT p.brandId, p.supId, p.proId, p.proName, p.description as productDescription, p.active as productActive, 
                v.varId, v.colorCode, v.colorName, v.quantity, v.size, v.image, v.gender, v.price, v.discount, v.createAt, v.lastUpdated, 
                v.description as variantDescription, v.status as variantStatus, v.active as variantActive, mp.mainMapping, pc.catId
            FROM `product` as p
            INNER JOIN `variant` as v ON v.proId = p.proId AND v.active != 0
            INNER JOIN `mapping_pro_cat` as mp ON mp.proId = p.proId
            INNER JOIN `product_category` as pc ON pc.catId = mp.catId AND pc.active != 0";
            return $this->SelectRow($query);
        }

        public function countProVarInTrash() 
        {
            $query = "SELECT count(varId) as total FROM variant where active = 0;";
            return $this->SelectRow($query);    
        }

        public function getSizesByProductAndColor($productId, $colorCode) 
        {
            $query = "SELECT varId, size, image, quantity, price, discount, createAt, lastUpdated, 
                status as variantStatus, description as variantDescription, active as variantActive
            FROM `variant` 
            WHERE proId = ? AND colorCode = ? ";
            return $this->SelectRow($query, [$productId, $colorCode]);
        }
        
        public function checkExistsProductByProName($proName)
        {
            $query = "SELECT proName 
                FROM product 
                WHERE TRIM(LOWER(proName)) = TRIM(LOWER(?)) ";
            return $this->SelectRow($query, [$proName]);
        }

        public function getAllBrand() 
        {
            $query = "SELECT brandId, brandName FROM brand";
            return $this->SelectRow($query);
        }

        public function createProduct($data, $imagePath) 
        {   
            // Insert table product
            $query1 = "INSERT INTO `product`(`brandId`, `supId`, `proName`, `proSlug`, `description`) 
                VALUES (?, ?, ?, ?, ?)";
            $resultQuery1 = $this->InsertRow($query1, 
                [ $data['brandId'], $data['supId'],  $data['proName'], convertToSlug($data['proName'])  , $data['proDesc'] ],
                true
            );
            if(!$resultQuery1) {
                toastMessage('danger', 'Thất bại', 'Thêm sản phẩm mới thất bại');
                return false;
            }
            
            // Insert table mapping_pro_cat, main category
            $query2 = "INSERT INTO `mapping_pro_cat`(`proId`, `catId`, `mainMapping`)
                VALUES (?, ?, 1)";
            $resultQuery2 = $this->InsertRow($query2, 
                [$resultQuery1, $data['mainCategoryId']]
            );
            if(!$resultQuery2) {
                toastMessage('danger', 'Thất bại', 'Liên kết danh mục chính thất bại');
                return false;
            }

            // Insert table mapping_pro_cat, sub category
            if (!empty($data['subCategoryIds'])) {
                foreach ($data['subCategoryIds'] as $subCategory) {
                    $query3 = "INSERT INTO `mapping_pro_cat`(`proId`, `catId`) VALUES (?, ?)";
                    $resultQuery3 = $this->InsertRow($query3, [$resultQuery1, $subCategory]);
                    if(!$resultQuery3) {
                        toastMessage('danger', 'Thất bại', 'Liên kết danh mục phụ thất bại');
                        return false;
                    }
                }
            }          

            // Insert table variant
            $query4 = "INSERT INTO `variant`(`proId`, `colorCode`, `colorName`, `quantity`, `size`, `image`, `gender`, `discount`, `price`, `lastUpdated`, `description`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP(), ?)";
            $resultQuery4 = $this->InsertRow($query4, [
                $resultQuery1, $data['colorCode'], $data['colorName'], $data['quantity'], $data['size'], $imagePath, 
                $data['gender'], $data['discount'], $data['price'], $data['varDesc']
            ]);
            
            if (!$resultQuery4) {
                toastMessage('danger', 'Thất bại', 'Thêm biến thể sản phẩm thất bại');
                return false;
            }
            return true;
        }

        public function getProductExtraInfo($proId)
        {
            $query = "SELECT p.proId, p.proName, v.colorCode, v.colorName, v.image, v.size
                FROM product as p
                INNER JOIN variant as v ON v.proId = p.proId
                WHERE p.proId = ?";
            return $this->SelectRow($query, [(int)$proId]);
        }

        public function checkExistsVariantProductForCreate($data)
        {
            $query = "SELECT p.proId, v.varId
                FROM product as p
                INNER JOIN variant as v ON v.proId = p.proId
                WHERE p.proId = ? AND TRIM(v.colorCode) = TRIM(?) AND TRIM(LOWER(v.colorName)) = TRIM(LOWER(?)) AND v.size = ? ";
            return $this->SelectRow($query, [(int)$data['proId'], $data['colorCode'], $data['colorName'], $data['size']]);
        }

        public function createVariantProduct($data, $imagePath)
        {
            $query = "INSERT INTO `variant`(`proId`, `colorCode`, `colorName`, `quantity`, `size`, `image`, `gender`, `price`, `discount`, `description`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            return $this->InsertRow($query, [
                (int)$data['proId'], $data['colorCode'], $data['colorName'], $data['quantity'], $data['size'], $imagePath, $data['gender'], $data['price'], $data['discount'], $data['varDesc']
            ]);
        }

        public function updateProduct($proBrandId, $proSupId , $proMainCatId, $proCatIds, $productId, $productName, $description)
        {
            $query1 = "UPDATE `product` 
            SET `brandId` = ?, `supId` = ?, `proName`= ?, `proSlug` = ?, `description`= ?
            WHERE `proId` = ?";
            $resultQuery1 = $this->UpdateRow($query1, [(int)$proBrandId, (int)$proSupId, $productName, convertToSlug($productName),  $description, (int)$productId]);
            if(!$resultQuery1) return false;

            $query2 = "UPDATE `mapping_pro_cat`
            SET `catId` = ?, `mainMapping` = 1
            WHERE `proId` = ? AND `mainMapping` = 1";
            $resultQuery2 = $this->UpdateRow($query2, [$proMainCatId, $productId]);
            if(!$resultQuery2) return false;

            // Lấy tất cả mpId của danh mục cũ
            $querySelect = "SELECT `mpId` FROM `mapping_pro_cat` 
                WHERE `proId` = ? AND `mainMapping` = 0 
                ORDER BY `mpId` ASC";
            $oldMpIds = $this->SelectRow($querySelect, [(int)$productId]); // Lấy danh sách mpId cũ

            // Nếu không có danh mục phụ mới, chỉ thực hiện xóa danh mục cũ
            if (empty($proCatIds)) {
                foreach ($oldMpIds as $oldMp) {
                    $queryDelete = "DELETE FROM `mapping_pro_cat` WHERE `mpId` = ?";
                    $resultDelete = $this->DeleteRow($queryDelete, [(int)$oldMp['mpId']]);
                    if (!$resultDelete) return false;
                }
                return true;
            }

            // Nếu có danh mục phụ mới, tiếp tục cập nhật/thêm/xóa như bình thường
            $oldCount = count($oldMpIds);
            $newCount = count($proCatIds);

            for ($i = 0; $i < max($oldCount, $newCount); $i++) {
                if ($i < $oldCount && $i < $newCount) {
                    //  Nếu còn danh mục cũ & danh mục mới, cập nhật
                    $queryUpdate = "UPDATE `mapping_pro_cat` 
                            SET `catId` = ? 
                            WHERE `mpId` = ?";
                    $resultUpdate = $this->UpdateRow($queryUpdate, [(int)$proCatIds[$i], (int)$oldMpIds[$i]['mpId']]);
                    if (!$resultUpdate) return false;

                } elseif ($i >= $oldCount) {
                    //  Nếu còn danh mục mới nhưng hết danh mục cũ, thêm mới
                    $queryInsert = "INSERT INTO `mapping_pro_cat` (`proId`, `catId`, `mainMapping`) 
                            VALUES (?, ?, 0)";
                    $resultInsert = $this->InsertRow($queryInsert, [(int)$productId, (int)$proCatIds[$i]]);
                    if (!$resultInsert) return false;

                } elseif ($i >= $newCount) {
                    // Nếu còn danh mục cũ nhưng hết danh mục mới, xoá danh mục cũ dư thừa
                    $queryDelete = "DELETE FROM `mapping_pro_cat` WHERE `mpId` = ?";
                    $resultDelete = $this->DeleteRow($queryDelete, [(int)$oldMpIds[$i]['mpId']]);
                    if (!$resultDelete) return false;
                }
            }


            return true;
        }

        public function getProNameByProId($proId)
        {   
            $query = "SELECT proName FROM product WHERE proId = ?";
            return $this->SelectRow($query, [$proId]);
        }

        public function checkExistsVariantProductForUpdate($data)
        {
            $query = "SELECT p.proId, v.varId
                FROM product as p
                INNER JOIN variant as v ON v.proId = p.proId
                WHERE p.proId = ? AND v.varID = ? AND v.gender = ? AND TRIM(v.colorCode) = TRIM(?) AND TRIM(LOWER(v.colorName)) = TRIM(LOWER(?)) AND v.size = ? AND v.quantity = ? AND v.price = ? AND v.discount = ?";
            return $this->SelectRow($query, [
                (int)$data['proIdUpdate'], (int)$data['proVarIdUpdate'], $data['proVarGenderUpdate'], $data['colorCodeUpdate'], 
                $data['colorNameUpdate'], $data['sizeUpdate'], (int)$data['quantityUpdate'], (int)$data['priceUpdate'],
                $data['discountUpdate']
            ]);
        }

        public function updateProductVariant($data, $imagePath)
        {
            if(!$imagePath == '') {
                $query1 = "UPDATE `variant` SET `image` = ? WHERE `proId` = ? AND `varId` = ?";
                $resultQuery1 = $this->UpdateRow($query1, [$imagePath, $data['proIdUpdate'], $data['proVarIdUpdate']]);
                if(!$resultQuery1) return false;
            }

            $query2 = "UPDATE `variant` SET `colorCode` = ?, `colorName` = ?, `quantity` = ?, `size` = ?, `gender` = ?,
            `price` = ?, `discount` = ?, `lastUpdated` = CURRENT_TIMESTAMP(), `description` = ? 
            WHERE `proId` = ? AND `varId` = ?";
            return $this->UpdateRow($query2, [
                $data['colorCodeUpdate'], $data['colorNameUpdate'], $data['quantityUpdate'], $data['sizeUpdate'], 
                $data['proVarGenderUpdate'], $data['priceUpdate'], $data['discountUpdate'], $data['proVarDescUpdate'],
                $data['proIdUpdate'], $data['proVarIdUpdate']
            ]);
        }

        public function changeStatusProductVariant($proId, $varId, $status)
        {
            if(!$varId == null) {
                $status = $status == 1 ? 0 : 1;   
                $query = "UPDATE variant SET status = $status WHERE proId = ? AND varId = ?";
                return $this->UpdateRow($query, [(int)$proId, (int)$varId]);
            }else {
                $query = "UPDATE variant SET status = $status WHERE proId = ? ";
            
                return $this->UpdateRow($query, [(int)$proId]);
            }
            
        }
    
        public function tempDeleteProduct($proId = '', $varId = '')  
        {
            $query1 = "UPDATE variant SET lastUpdated = CURRENT_TIMESTAMP(), active = 0 WHERE proId = ? ";
            if($varId != null || $varId != '') {
                $query1 = $query1." AND varId = ?";
                return $this->UpdateRow($query1, [(int)$proId, (int)$varId]);
            }
            $resultQuery1 = $this->UpdateRow($query1, [(int)$proId]);
            if(!$resultQuery1) return false;

            $query2 = "UPDATE product SET active = 0 WHERE proId = ?";
            return $this->UpdateRow($query2, [$proId]);
        }

        public function getAllProVarInTrash()
        {
            $query = "SELECT v.*, b.brandName, p.proName
                FROM variant as v
                INNER JOIN product as p ON v.proId = p.proID 
                INNER JOIN brand as b ON b.brandId = p.brandId
                WHERE v.active = 0
            ";
            return $this->SelectRow($query);
        }

        public function deleteProductVariantPermanently($proId, $varId)
        {
            $conn = $this->Connect(); // Kết nối DB
            try {
                $conn->beginTransaction(); // Bắt đầu transaction

                // Xóa biến thể cụ thể của sản phẩm
                $query1 = "DELETE FROM variant WHERE proId = ? AND varId = ?";
                $stmt1 = $conn->prepare($query1);
                $stmt1->execute([$proId, $varId]);

                // Kiểm tra còn biến thể nào khác không
                $query2 = "SELECT varId FROM variant WHERE proId = ?";
                $stmt2 = $conn->prepare($query2);
                $stmt2->execute([$proId]);
                $variantsLeft = $stmt2->fetchAll(PDO::FETCH_ASSOC);

                // Nếu vẫn còn biến thể thì commit transaction và return
                if (!empty($variantsLeft)) {
                    $conn->commit();
                    return true;
                }

                // Không còn biến thể nào, xóa liên kết với danh mục
                $query3 = "DELETE FROM mapping_pro_cat WHERE proId = ?";
                $stmt3 = $conn->prepare($query3);
                $stmt3->execute([$proId]);

                // Xóa sản phẩm chính
                $query4 = "DELETE FROM product WHERE proId = ?";
                $stmt4 = $conn->prepare($query4);
                $stmt4->execute([$proId]);

                // Commit transaction nếu tất cả đều thành công
                $conn->commit();
                return true;

            } catch (PDOException $e) {
                $conn->rollBack(); // Hoàn tác nếu có lỗi
                toastMessage('error', 'Lỗi', 'Lỗi trong quá trình xóa sản phẩm: ' . $e->getMessage());
                return false;
            }
        }

        public function restoreProVarInTrash($proId, $varId) 
        {
            $query1 = "UPDATE variant SET lastUpdated = CURRENT_TIMESTAMP(), active = 1 WHERE proId = ? AND varID = ?";
            $resultQuery1 = $this->UpdateRow($query1, [$proId, $varId]);
            if(!$resultQuery1) return false;
            
            $query2 = "UPDATE product SET active = 1 WHERE proId = ?";
            return $this->UpdateRow($query2, [$proId]);
        }

        public function getProductDetailsByProId($proId) 
        {
            $query = "SELECT b.brandName, s.supName, p.proId, p.proName, p.description as proDesc,
            v.varId, v.colorCode, v.colorName, v.quantity, v.size, v.image, v.gender, v.price, v.discount, v.status, v.createAt as varCreateAt, v.lastUpdated, v.description as varDesc, mp.mainMapping, mp.createAt as mpCreateAt, mp.description as mpDesc, 
            pc.catName, pc.active as catActive
            FROM product as p
            INNER JOIN variant as v ON p.proId = v.proId
            INNER JOIN brand as b ON b.brandId = p.brandId
            INNER JOIN mapping_pro_cat as mp ON mp.proId = p.proId
            INNER JOIN product_category as pc ON pc.catId = mp.catId
            INNER JOIN supplier as s ON p.supId = s.supId
            WHERE p.proId = ? AND p.active != 0 AND v.active != 0";
            return $this->SelectRow($query, [$proId]);
        }
    /* END PRODUCT */

    /* BEGIN PRODUCT SUPPLIER */
        public function getAllProductSupplier()
        {
            $query = "SELECT * FROM supplier";
            return $this->SelectRow($query);
        }

        public function checkExistsProSupplierByName($productSupplierName) {
            $query = "SELECT supName FROM supplier WHERE TRIM(LOWER(supName)) = TRIM(LOWER(?))";
            return $this->SelectRow($query, [$productSupplierName]);
        }

        public function createProductSupplier($productSupplierInfo)
        {
            $query = "INSERT INTO `supplier`(`supName`, `email`, `address`, `phoneNumber`, `country`, `description`) 
            VALUES (?, ?, ?, ?, ?, ?)";
            return $this->InsertRow($query, 
            [
                $productSupplierInfo['supName'], $productSupplierInfo['email'], $productSupplierInfo['address'], 
                $productSupplierInfo['phoneNumber'], $productSupplierInfo['country'], $productSupplierInfo['description'], 
            ]);
        }

        public function updateProductSupplier($productSupplierInfo)
        {
            $query = "UPDATE `supplier` 
            SET `supName` = ?, `email` = ?, `address` = ?, `phoneNumber` = ?, `country` = ?, `description` = ?
            WHERE `supId` = ?";
            return $this->UpdateRow($query, 
            [
                $productSupplierInfo['supName'], $productSupplierInfo['email'], $productSupplierInfo['address'],
                $productSupplierInfo['phoneNumber'], $productSupplierInfo['country'], $productSupplierInfo['description'],
                $productSupplierInfo['supId']
            ]);
        }

        public function deleteProductSupplier($supId) 
        {
            $query1 = "SELECT supId FROM product WHERE supId = ?";
            $resultQuery1 = $this->SelectRow($query1, [$supId]);
            if($resultQuery1) {
                toastMessage('error', 'Thất bại', 
                'Không thể xóa thông tin nhà cung cấp này vì đang có đang có sản phẩm được gắn với thông tin nhà cung cấp này');
                return false;
            }
            
            $query2 = "DELETE FROM `supplier` WHERE supId = ?";
            $resultQuery2 = $this->DeleteRow($query2, [$supId]);
            if(!$resultQuery2) {
                toastMessage('error', 'Thất bại', 'Xóa thông tin nhà cung cấp này thất bại');
                return false;
            }
            return true;
        }
    /* End PRODUCT SUPPLIER */

    /* BEGIN PRODUCT BRAND */
        public function getAllProductBrand()
        {
            $query = "SELECT * FROM brand";
            return $this->SelectRow($query);
        }

        public function checkExistsProductBrand($productBrandName, $brandImage, $description = null) {
            $query = "SELECT brandName FROM brand 
            WHERE TRIM(LOWER(brandName)) = TRIM(LOWER(?)) AND TRIM(LOWER(image)) = TRIM(LOWER(?)) 
                AND TRIM(LOWER(description)) = TRIM(LOWER(?))";
            return $this->SelectRow($query, [$productBrandName, $brandImage, $description]);
        }

        public function createProductBrand($brandName, $brandImage , $description) 
        {
            $query = "INSERT INTO `brand`(`brandName`, `brandSlug`, `image`, `description`) 
                VALUES (?, ?, ?, ?);";
            return $this->InsertRow($query, [$brandName, convertToSlug($brandName), $brandImage, $description]);
        }

        public function updateProductBrand($brandId, $brandName, $brandImage, $description) 
        {
            $brandImage = $brandImage === null ? 'image' : $brandImage;
            $query = "UPDATE `brand` 
                SET `brandName` = ?, `brandSlug` = ? `image` = ?, `description` = ? 
                WHERE `brandId` = ? ";    
            return $this->UpdateRow($query, [$brandName, convertToSlug($brandName), $brandImage, $description, $brandId]);
        }

        public function deleteProductBrand($brandId)
        {
            $query1 = "SELECT proId FROM product WHERE brandId = ?";
            $resultQuery1 = $this->SelectRow($query1, [$brandId]);
            if($resultQuery1) {
                toastMessage('error', 'Thất bại', 'Còn sản phẩm liên kết với thương hiệu này');
                return false;
            } 

            $query2 = "DELETE FROM `brand` WHERE `brandId` = ?";
            $resultQuery2 = $this->DeleteRow($query2, [$brandId]);
            if(!$resultQuery2) {
                toastMessage('error', 'Thất bại', 'Xóa thông tin thương hiệu thất bại');
                return false;
            }
            return true;
        }

    /* End PRODUCT BRAND */
}