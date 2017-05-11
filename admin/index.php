<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 30-Mar-17
 * Time: 11:14 AM
 */
session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../configs/config.php';
require '../models/db.php';

if(isset($_SESSION['user_info'])){
    header('Location:'.URL_ADMIN_PART.'/controllers/user_controller.php?action=list');
}else{
    header('Location:'.URL_ADMIN_PART.'/controllers/user_controller.php?action=showLoginPageAction');
}
