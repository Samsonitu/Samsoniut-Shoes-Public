<?php

namespace Models\UserModels;

use Core\Model;

class ProductModel extends Model
{
    public function getAllProduct() 
    {
        $query = "SELECT b.brandName, b.brandId, c.catName,  
        p.proId, p.proName, p.proSlug, v.varId, v.colorCode, v.colorName, v.quantity, v.image, 
        v.gender, v.price, v.discount, v.createAt
        FROM product AS p
        JOIN variant AS v ON v.proId = p.proId AND v.status != 0  
        JOIN brand AS b ON b.brandId = p.brandId
        JOIN mapping_pro_cat as mp ON mp.proId = p.proId
        JOIN product_category as c ON c.catId = mp.catId AND c.status != 0
        WHERE p.active != 0;";
        return $this->SelectRow($query);
    }

    public function getAllProductByCategory($category) 
    {
        if($category === 'nam' || $category === 'nu') {
            $category = $category === 'nam' ? 'male' : 'female';
            $query = "SELECT b.brandName, b.brandId, c.catName,  
            p.proId, p.proName, p.proSlug, v.varId, v.colorCode, v.colorName, v.quantity, v.image, 
            v.gender, v.price, v.discount, v.createAt
            FROM product AS p
            JOIN variant AS v ON v.proId = p.proId AND v.status != 0  
            JOIN brand AS b ON b.brandId = p.brandId
            JOIN mapping_pro_cat as mp ON mp.proId = p.proId
            JOIN product_category as c ON c.catId = mp.catId AND c.status != 0
            WHERE p.active != 0 AND v.gender = ?";

            return $this->SelectRow($query, [$category]);
        }else {
            $query = "SELECT b.brandName, b.brandId, pc.catName,  
            p.proId, p.proName, p.proSlug, v.varId, v.colorCode, v.colorName, v.quantity, v.image, 
            v.gender, v.price, v.discount, v.createAt
            FROM product AS p
            JOIN variant AS v ON v.proId = p.proId AND v.status != 0  
            JOIN brand AS b ON b.brandId = p.brandId
            JOIN mapping_pro_cat as mp ON mp.proId = p.proId
            JOIN product_category as pc ON pc.catId = mp.catId AND pc.status != 0
            WHERE p.active != 0 AND LOWER(TRIM(pc.catName)) = LOWER(TRIM(?))";
            return $this->SelectRow($query, [$category]);
        }
        
    }

    public function getAllProductByBrand($brand) 
    {
        $query = "SELECT b.brandName, b.brandId, pc.catName,  
        p.proId, p.proName, p.proSlug, v.varId, v.colorCode, v.colorName, v.quantity, v.image, 
        v.gender, v.price, v.discount, v.createAt
        FROM product AS p
        JOIN variant AS v ON v.proId = p.proId AND v.status != 0  
        JOIN brand AS b ON b.brandId = p.brandId
        JOIN mapping_pro_cat as mp ON mp.proId = p.proId
        JOIN product_category as pc ON pc.catId = mp.catId AND pc.status != 0
        WHERE p.active != 0 AND LOWER(TRIM(b.brandName)) = LOWER(TRIM(?))";
        return $this->SelectRow($query, [$brand]);
    }

    public function getProCatByCatSlug($catSlug)
    {
        $query = "SELECT catName, catSlug FROM product_category WHERE LOWER(TRIM(catSlug)) = LOWER(TRIM(?))";
        return $this->SelectRow($query, [$catSlug]);
    }

    public function getBrandNameByBrandSlug($brandSlug)
    {
        $query = "SELECT brandName, brandSlug FROM brand WHERE LOWER(TRIM(brandSlug)) = LOWER(TRIM(?))";
        return $this->SelectRow($query, [$brandSlug]);
    }

    public function getAllBrandIdAndName() 
    {
        $query = "SELECT brandId, brandName FROM brand WHERE active !=0";
        return $this->SelectRow($query);
    }

    public function getProductDetailsByProSlug($proSlug)
    {
        $query = "SELECT p.brandId, b.brandName, p.supId, p.proId, p.proName, p.proSlug, p.description as productDescription, 
        v.varId, v.colorCode, v.colorName, v.quantity, v.size, v.image, v.gender, v.price, v.discount, mp.mainMapping, pc.catId
        FROM product AS p
        JOIN variant AS v ON v.proId = p.proId AND v.status != 0  
        JOIN brand AS b ON b.brandId = p.brandId
        JOIN mapping_pro_cat as mp ON mp.proId = p.proId
        JOIN product_category as pc ON pc.catId = mp.catId AND pc.status != 0
        WHERE p.active != 0 AND p.proSlug = ?";
        return $this->SelectRow($query, [$proSlug]);
    }

    public function getProductSuggestion($brandId, $proId)
    {
        $query = "SELECT p.proId
              FROM product AS p
              WHERE p.active != 0 AND p.brandId = ? AND p.proId != ?
              GROUP BY p.proId
              LIMIT 5 OFFSET 0";

        $productIds = $this->SelectRow($query, [$brandId, $proId]);

        if (empty($productIds)) return []; // Tránh lỗi nếu không có sản phẩm nào

        // Lấy danh sách đầy đủ thông tin sản phẩm với điều kiện proId
        $proIdList = implode(',', array_column($productIds, 'proId'));

        $query = "SELECT b.brandName, b.brandId, c.catName,  
                        p.proId, p.proName, p.proSlug, v.varId, v.colorCode, v.colorName, v.quantity, v.size, 
                        v.image, v.gender, v.price, v.discount
                FROM product AS p
                JOIN variant AS v ON v.proId = p.proId AND v.status != 0  
                JOIN brand AS b ON b.brandId = p.brandId
                JOIN mapping_pro_cat AS mp ON mp.proId = p.proId
                JOIN product_category AS c ON c.catId = mp.catId AND c.status != 0
                WHERE p.proId IN ($proIdList)";

        return $this->SelectRow($query);
    }
    
    public function addProVarToWishList($userId, $proId)
    {
        $query1 = "SELECT proId FROM wish_list WHERE userId = ? AND proId = ?";
        $resultQuery1 = $this->SelectRow($query1, [$userId, $proId]);
        if($resultQuery1) return true;

        $query2 = "INSERT INTO `wish_list`(`userId`, `proId`) 
            VALUES (?, ?)";
        return $this->InsertRow($query2, [$userId, $proId]);
    }

    public function getAllWishListProduct($userId) 
    {
        $query = "SELECT b.brandId, b.brandName, p.proId, p.proName, v.varId, v.colorCode, v.colorName, v.size, v.image, v.gender, 
        v.size, p.proSlug, v.price, v.discount, pc.catName 
            FROM wish_list as wl
            JOIN product as p ON p.proId = wl.proId AND p.active != 0
            JOIN variant as v ON v.proId = p.proId AND v.status != 0
            JOIN brand as b ON b.brandId = p.brandId
            JOIN mapping_pro_cat as mp ON mp.proId = p.proId
            JOIN product_category as pc ON pc.catId = mp.catId
            WHERE wl.userId AND ?";
        return $this->SelectRow($query, [$userId]);
    }

    public function deleteProVarWishList($userId, $proId)
    {
        $query = "DELETE FROM wish_list WHERE userId = ? AND proId = ?";
        return $this->DeleteRow($query, [$userId, $proId]);
    }
}