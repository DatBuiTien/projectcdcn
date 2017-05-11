<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 12-Apr-17
 * Time: 7:42 PM
 */
require_once '../configs/config.php';
require_once '../models/db.php';
class CateModel extends DB {
    public function getAllcategories(){
        $query = 'select id, p_id, name, `order` from categories WHERE status = '.STATUS_ACTIVE.' and p_id = 0 order by p_id, `order`';
        $result = $this->executeQuery($query);
        $arr_menu = [];
        foreach ($result as $key => $value){
            $arr_menu[] = $value;
            $query = 'Select `id`, `p_id`, `name`, `order` From categories where `status` = '.STATUS_ACTIVE .' and `p_id` = '.$value['id'].' ORDER BY `order`';
            $result = $this->executeQuery($query);
            $arr_menu[] = $result;
        }
        return $arr_menu;
    }

    public function getAllProductsByCateName($data){
        $query = 'Select p.id, p.p_name, p.p_tenkhongdau, p.tomtat, p.description, p.image, p.price, p.id_producttype from product p 
                  INNER JOIN producttype pt ON p.id_producttype = pt.id
                  INNER JOIN categories c ON pt.id_categories = c.id
                  WHERE c.cate_tenkhongdau LIKE "'.$data['cate_name'].'"';
        $result  = $this->executeQuery($query);
        return $result;
    }

    public function getAllProductTypeByCateName($data){
        $query='select pt.id, pt.id_categories, pt.pt_name, pt.pt_tenkhongdau, c.cate_name, c.cate_tenkhongdau from producttype pt
                INNER JOIN categories c ON pt.id_categories = c.id 
                WHERE  c.cate_tenkhongdau LIKE "'.$data['cate_name'].'"';
        $result  = $this->executeQuery($query);
        return $result;
    }
}
