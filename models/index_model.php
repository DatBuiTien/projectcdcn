<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 12-Apr-17
 * Time: 3:29 PM
 */
require_once '../configs/config.php';
require_once '../models/db.php';
class IndexModel extends DB {
    public function getAllcategories(){
        $query = 'select id, cate_name, cate_tenkhongdau, created_at, update_at from categories';
        $result = $this->executeQuery($query);
        return $result;
    }

    public function getAllProductType(){
        $query='select * from producttype';
        $result = $this->executeQuery($query);
        return $result;
    }

    public function getAllProducts(){
        $query = 'SELECT id, p_name, price, image from product';
        $result=$this->executeQuery($query);
        return $result;
    }

    public function getNewProduct(){
        $query = 'SELECT id, p_name, price, image from product
                  ORDER BY id DESC 
                  LIMIT 4';
        $result = $this->executeQuery($query);
        return $result;
    }

    public function getFeatureProduct(){
        $query = 'select p.id, p.p_name, p.price, p.image, p.id_producttype, pt.id_categories, c.cate_name from product p 
                  INNER JOIN producttype pt ON p.id_producttype = pt.id
                  INNER JOIN categories c ON pt.id_categories = c.id
                  GROUP BY c.id
                  ORDER BY p.id DESC 
                  LIMIT 4';
        $result = $this->executeQuery($query);
        return $result;
    }

    public function searchProduct($data){
        $query = 'SELECT p.id, p.p_name, p.price, p.image, pt.id_categories from product p 
                  INNER JOIN producttype pt ON p.id_producttype = pt.id
                  WHERE p.p_name LIKE "%'.$data['search_data'].'%"';
        $result = $this->executeQuery($query);
        return $result;
    }

    public function getProductInCard($data){
        $query = 'select id, p_name, price, image from product WHERE id IN ('.implode(',',$data).') ';
        $result = $this->executeQuery($query);
        return $result;
    }

    public function insertNewCustomer($data){
        $query = 'INSERT INTO customer (`name`, email, phone, address, orderdate, requiredate, total, status) VALUES 
                ("'.$data['username'].'", "'.$data['useremail'].'", '.$data['userphone'].', "'.$data['useraddress'].'", "'
                .$data['datetime'].'", "'.$data['date_required'].'", '.$data['total'].', '.ORDER_STATUS_UN_ACTIVE.')';

        $result = $this->insertNew($query);
        return $result;
    }

    public function getIdLastCustomer(){
        $query = 'SELECT id FROM customer ORDER BY id DESC LIMIT 1';
        $result = $this->executeQuery($query);
        return $result[0];
    }

    public function insertNewOrder($data, $id_customer){
        $query = 'INSERT INTO `order` ( id_customer, id_product, quantity, priceeach, status) 
                  VALUES ('.$id_customer.', '.$data['id'].', '.$data['quantity'].', '.$data['total'].', '.ORDER_STATUS_UN_ACTIVE.')' ;

        $result = $this->insertNew($query);
        return $result;
    }
}