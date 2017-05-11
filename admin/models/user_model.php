<?php
require_once '../../models/db.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class UserModel extends DB{

    //check username and password for login action
    public function checkUserInfo($user_name, $password){
        $query = 'Select * From users where email = "'.$user_name. '" and password ="'. sha1($password) .'"';
        $result = $this->executeQuery($query);
        return $result;
    }

    public function checkExistAccount($email){
        $query = 'SELECT username from users WHERE email LIKE "'.$email.'"';
        $result = $this->executeQuery($query);
        return $result;
    }

    //
    public function getUserInfo(){

    }

    //search user
    public function searchUser($user){
        $query = 'select id, username, email, gender, phone, image, Address, capquyen, status from users WHERE username LIKE "%'.$user.'%" or email like "%'.$user.'%"';
        $result = $this->executeQuery($query);
        return $result;
    }

    //get all users
    public function getAllUsers(){
        $query = 'Select id, username, email, gender, phone, image, Address, capquyen, status From users';
        $result = $this->executeQuery($query);
        return $result;
    }

    //Insert New User
    public function insertNewUser($data){
        //Check is  daplicate
        $sql = 'select username from users WHERE email like "'.$data["email-reg"].'"' ;
        if($this->countRow($sql) > 0 or $data["username-reg"] == "" or $data["email-reg"] == ""){
            return false;
        }else{
            $query = 'INSERT INTO `users`(`username`, `email`, `password`, `gender`, `phone`, `image`, `capquyen`, `address`, `status`)
                       VALUE ("'.$data["username-reg"].'", "'.$data["email-reg"].'", "'.sha1($data["password-reg"]).'", "'.$data["gender-reg"].'", "'.$data["phone-reg"].'", "'.$data["image-reg"].'", "'.DEFAULT_CAPQUYEN.'", "'.$data["address-reg"].'", "'.USER_STATUS_ACTIVE.'")';
            $result = $this->insertNew($query);
            return $result;
        }
    }

    public function deleteUser($id){
        $query = 'delete from users WHERE id = '.$id;
        $result = $this->delete($query);
        return $result;
    }

    //get user by id
    public function getUserInfoById($id){
        $query = 'select * from users WHERE id = '.$id;
        $result = $this->executeQuery($query);
        if(count($result)>0){
            return $result[0];
        }else{
            return false;
        }

    }


    //check user update
    public function checkUserInfoUpdate($data){
        $query = 'select * from users where email LIKE "'.$data['email-edit'].'" and id <> "'.$data['id'].'"';
        $result = $this->executeQuery($query);
        if(count($result) > 0){
            return false;
        }else{
            return true;
        }
    }

    //update user info by id
    public function updateUserById($data){
        $query = 'Update users Set username="'.$data['username-edit'].'", email ="'.$data['email-edit'].'", password ="'.sha1($data['password-edit']).'", gender ="'.$data['gender-edit'].'",phone ="'.$data['phone-edit'].'", image ="'.$data['image'].'", address ="'.$data['address-edit'].'", capquyen ="'.$data['capquyen-edit'].'" where id="'.$data['id'].'"' ;
        $result=$this->updateQuery($query);
        return $result;
    }

    //update user status by id
    public function updateUserStatus($data){
        $query = 'update users set status = "'.$data['user_status'].'" where id = "'.$data['userId'].'"';
        $result = $this->updateQuery($query);
        return $result;
    }


}

