<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 17-Apr-17
 * Time: 10:13 AM
 */
require_once '../../models/db.php';
class CustomerModel extends DB {

    //check username and password for login action
    public function getAllCustomer(){
        $query = 'SELECT * FROM customer';
        $result = $this->executeQuery($query);
        return $result;
    }

    public function getOrderByIdCustomer($id_customer){
        $query = 'SELECT o.quantity, o.priceeach , o.status, p.p_name, p.price FROM `order` o 
                  INNER JOIN product p ON o.id_product = p.id
                  WHERE o.id_customer LIKE '.$id_customer;
        $result = $this->executeQuery($query);
        return $result;
    }

    public function getCustomerById($id_customer){
        $query = 'SELECT `name`, email, phone, address, total, status, orderdate, requiredate FROM customer 
                  WHERE id = '.$id_customer;
        $result = $this->executeQuery($query);
        return $result[0];
    }

    public function updateStatusOrder($data){
        $query = 'UPDATE customer SET status = '.$data['status'].' WHERE id = '.$data['id'];
        $result = $this->updateQuery($query);
        return $result;
    }

    public function searchCustomer($data){
        $query = 'SELECT id, `name`, email, phone, address, total, status, orderdate, requiredate FROM customer 
                  WHERE `name` LIKE "%'.$data.'%" or email like "%'.$data.'%"';
        $reult = $this->executeQuery($query);
        return $reult;
    }
}