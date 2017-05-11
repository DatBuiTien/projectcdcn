<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 12-Apr-17
 * Time: 7:42 PM
 */
require_once '../configs/config.php';
require_once '../models/db.php';
class ProductModel extends DB {
    public function getAllCate(){
        $query = 'select id, cate_name, cate_tenkhongdau from categories';
        $result = $this->executeQuery($query);
        return $result;
    }

    public function getAllProductType(){
        $query = 'select pt.id, pt.pt_name, pt.id_categories, pt.pt_tenkhongdau, pt.created_at, pt.updated_at, c.cate_name from producttype pt 
                  INNER JOIN categories c ON c.id = pt.id_categories';
        $result = $this->executeQuery($query);
        return $result;
    }
    public function getInfoProduct($data){
        $query = 'SELECT * FROM product WHERE id = '.$data['product'];
        $result  = $this->executeQuery($query);
        return $result[0];
    }
    public function getImageProduct($data){
        $query = 'SELECT id, pi_name FROM product_image WHERE product_id = '.$data['product'];
        $result  = $this->executeQuery($query);
        return $result;
    }

    public function getProductRelated($data){
        $query = 'SELECT p.id, p.image, p.p_name FROM product p 
                  INNER JOIN producttype pt ON p.id_producttype = pt.id
                  WHERE pt.id = '.$data['id_producttype'].' AND p.id <> '.$data['id'];
        $result  = $this->executeQuery($query);
        return $result;
    }

}
