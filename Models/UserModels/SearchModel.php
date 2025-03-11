<?php

namespace Models\UserModels;

use Core\Model;

class SearchModel extends Model{
    public function getProductByProName($proName)
    {
        $query = "SELECT p.proName, p.proSlug, MIN(v.image) AS image, MIN(v.colorName) AS colorName
            FROM product AS p
            JOIN variant AS v ON v.proId = p.proId
            WHERE LOWER(TRIM(p.proName)) LIKE CONCAT('%', LOWER(TRIM(?)), '%')
            GROUP BY p.proId, v.colorName";
        return $this->SelectRow($query, [$proName]);
    }
}