<?php

namespace Models\UserModels;

use Core\Model;

class HomeModel extends Model
{
    public function getProductByCatName($catName, $limit)
    {
        $query = "SELECT p.proId, p.proName, p.proSlug, b.brandName,
            v.varId, v.colorCode, v.colorName, v.quantity, v.image, v.price, v.discount
        FROM product as p
        INNER JOIN brand as b ON p.brandId = b.brandId 
        INNER JOIN variant as v ON p.proId = v.proId
        INNER JOIN mapping_pro_cat as mp ON p.proId = mp.proId
        INNER JOIN product_category as pc ON pc.catId = mp.catId
        WHERE TRIM(LOWER(pc.catName)) = TRIM(LOWER(?)) AND v.status != 0 AND p.active != 0
        LIMIT $limit";

        return $this->SelectRow($query, [$catName]);
    }

    public function getBasicKeyInfoNews($limitNews)
    {
        $query = "SELECT n.title, n.newsSlug, n.excerpt, n.thumbnail, n.createAt
        FROM news as n
        WHERE n.status != 0 AND n.active != 0
        ORDER BY n.createAt DESC LIMIT $limitNews";
        return $this->SelectRow($query);
    }

    public function getBrandImages()
    {
        $query = "SELECT brandName, brandSlug, image
            FROM brand";
        return $this->SelectRow($query);
    }
}