<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 17-Apr-17
 * Time: 10:13 AM
 */
require_once '../../models/db.php';
class ProductTypeModel extends DB {

    //check username and password for login action
    //get All Categories
    public function getAllCate(){
        $query = 'select * from categories';
        $result = $this->executeQuery($query);
        return $result;
    }

    public function getAllProductType(){
        $query = 'select pt.id, pt.pt_name, pt.id_categories, pt.pt_tenkhongdau, pt.created_at, pt.updated_at, c.cate_name from producttype pt 
                  INNER JOIN categories c ON c.id = pt.id_categories';
        $result = $this->executeQuery($query);
        return $result;
    }

    //get All ProductType By Cate id
    public function getAllProductTypeByCate($data){
        $query = 'SELECT pt.id, pt.pt_name, pt.id_categories, pt.pt_tenkhongdau, pt.created_at, pt.updated_at, c.cate_name from producttype pt 
                  INNER JOIN categories c ON c.id = pt.id_categories
                  WHERE pt.id_categories = '.$data['cateid'];
        $result= $this->executeQuery($query);
        return $result;
    }
    public function getInfoProductTypeById($data){
        $query = 'SELECT pt.id, pt.id_categories, pt.pt_name, pt.pt_tenkhongdau, pt.created_at, pt.updated_at, c.cate_name 
                  FROM producttype pt            
                  INNER JOIN categories c ON c.id = pt.id_categories
                  WHERE pt.id = '.$data['id'];
        $result= $this->executeQuery($query);
        return $result[0];
    }

    public function searchProductType($data){
        $query = 'SELECT pt.id, pt.pt_name, pt.id_categories, pt.pt_tenkhongdau, pt.created_at, pt.updated_at, c.cate_name from producttype pt 
                  INNER JOIN categories c ON c.id = pt.id_categories
                  WHERE pt.pt_name LIKE "%'.$data.'%" or pt.pt_tenkhongdau like "%'.$data.'%"';
        $result= $this->executeQuery($query);
        return $result;
    }

    public function getAllProductTypeByCateAndSearch($data){
        $query = 'SELECT pt.id, pt.pt_name, pt.id_categories, pt.pt_tenkhongdau, pt.created_at, pt.updated_at, c.cate_name from producttype pt 
                  INNER JOIN categories c ON c.id = pt.id_categories
                  WHERE (pt.pt_name LIKE "%'.$data['search_data'].'%" or pt.pt_tenkhongdau like "%'.$data['search_data'].'%") and pt.id_categories = '.$data['cateid'];
        $result= $this->executeQuery($query);
        return $result;
    }

    public function getAllCateDistinct($data){
        $query = 'SELECT DISTINCT c.cate_name, c.id from producttype pt 
                  INNER JOIN categories c ON c.id = pt.id_categories
                  WHERE (pt.pt_name LIKE "%'.$data['search_data'].'%" or pt.pt_tenkhongdau like "%'.$data['search_data'].'%")';
        $result = $this->executeQuery($query);
        return $result;
    }

    public function checkProductTypeById($data){
        $query = 'select id from producttype WHERE id_categories = '.$data['cateid'].' and pt_name like "'.$data['ptname'].'"';
        $result = $this->executeQuery($query);
        return $result;
    }

    public function updateProductTypeById($data, $date){
        $query = 'update producttype set pt_name = "'.$data['ptname'].'", pt_tenkhongdau = "'.$data['ptlink'].'", updated_at = "'.$date.'" where id = '.$data['id'];
        $result = $this->updateQuery($query);
        return $result;
    }

    public function deleteProductType($data){
        $query = 'delete from producttype WHERE id = '.$data;
        $result = $this->delete($query);
        return $result;
    }

    public function addNewProductType($data, $created_at){
        $query = 'INSERT INTO producttype (id_categories, pt_name, pt_tenkhongdau, created_at, updated_at) VALUES ("'.$data['cateid'].'", "'.$data['ptname'].'", "'.$data['ptlink'].'", "'.$created_at.'", "'.$created_at.'")';
        $result = $this->insertNew($query);
        return $result;
    }
}