<?php
/**
 * Created by PhpStorm.
 * User: Kesha
 * Date: 05.09.2015
 * Time: 22:43
 */

class ModelModuleRandComm extends Model {

    public function getRandComment($rating,$limit,$category_id)
    {
        $query = $this->db->query("SELECT DISTINCT
pr.product_id,
pr.author,
pr.rating,
pr.text,
pr.date_added,
pm.image
FROM " . DB_PREFIX ."review pr
LEFT JOIN " . DB_PREFIX ."product_to_category ptc
ON(ptc.product_id = pr.product_id)
LEFT JOIN " . DB_PREFIX ."product pm
ON(pm.product_id = pr.product_id)
WHERE pr.rating >= $rating AND ptc.category_id = $category_id
LIMIT $limit");

        return $query->rows;
    }

}