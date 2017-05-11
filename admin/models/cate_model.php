<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 17-Apr-17
 * Time: 10:13 AM
 */
require_once '../../models/db.php';
class CateModel extends DB {

    //check username and password for login action
    public function getAllCate(){
        $query = 'select * from categories';
        $result = $this->executeQuery($query);
        return $result;
    }


    public function getInfoCateById($data){
        $query = 'SELECT * from categories WHERE id = '.$data['id'];
        $result = $this->executeQuery($query);
        if(count($result)>0){
            return $result[0];
        }else{
            return false;
        }
    }

    public function checkCateInfo($data){
        $query = 'select id from categories WHERE cate_name LIKE "'.$data['catename'].'"';
        $result=$this->executeQuery($query);
        return $result;
    }

    public function checkCateInfoUpdate($data){
        $query = 'select id from categories WHERE cate_name LIKE "'.$data['catename'].'" and id <> '.$data['id'];
        $result=$this->executeQuery($query);
        return $result;
    }

    public function searchCate($data){

        $query = 'select * from categories WHERE cate_name LIKE "%'.$data.'%" or cate_tenkhongdau like "%'.$data.'%"';
        $result=$this->executeQuery($query);
        return $result;
    }

    public function updateCateById($data, $date){
        $query = 'update categories set cate_name = "'.$data['catename'].'", cate_tenkhongdau = "'.$data['catelink'].'", update_at = "'.$date.'" where id = '.$data['id'];
        $result = $this->updateQuery($query);
        return $result;
    }

    public function addNewCate($data, $date){
        $query = 'insert into categories (cate_name, cate_tenkhongdau, created_at, update_at)
                  VALUES ("'.$data['catename'].'", "'.$data['catelink'].'", "'.$date.'", "'.$date.'")';
        $result = $this->insertNew($query);
        return $result;
    }

    public function deleteCate($id){
        $query = 'delete from categories WHERE id = '.$id;
        $result = $this->delete($query);
        return $result;
    }

}