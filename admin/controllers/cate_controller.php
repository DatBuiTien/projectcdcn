<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require '../../configs/config.php';
require_once '../models/cate_model.php';
require_once '../libs/functions.php';

class CateController {
    public $cate_model;
    public $ctr_name = 'cate';
    public function __construct()
    {
        $this->cate_model = new CateModel();
        if(!isset($_SESSION['user_info'])){
            $_SESSION['messages'] = 'You must login';
            header('Location:user_controller.php?action=login');
        }
        date_default_timezone_set("Asia/Bangkok");
        /*if(!isset($_SESSION['cate_info'])){
            $this->loginAction();
        }*/
    }

    function indexAction(){
        $this->listAction();
    }

    function listAction($data){
        if(isset($_SESSION['user_info'])){
            if(isset($data['search_data'])){
                $datasearch = $this->cate_model->searchCate($data['search_data']);
                $_SESSION['link'] = $data['action'];
                $_SESSION['cate'] = $datasearch;
            }else{
                $catedata = $this->cate_model->getAllCate();
                $_SESSION['link'] = $data['action'];
                $_SESSION['cate'] = $catedata;
            }
            require_once '../views/categories/list.php';
        }
        else{

            $_SESSION['messages'] = 'You must login';
            header('Location:user_controller.php?action=showLoginPageAction');
        }

    }

    function showEditPage($data){
        if(isset($_SESSION['user_info'])) {
            $cate_info = $this->cate_model->getInfoCateById($data);
            $_SESSION['cate_info'] = $cate_info;
            require_once '../views/categories/edit.php';
        }else{
            $_SESSION['messages'] = 'You must login';
            header('Location:user_controller.php?action=showLoginPageAction');
        }
    }

    function editAction($data){
        $result = $this->cate_model->checkCateInfoUpdate($data);
        if(count($result) > 0){
            $_SESSION['messages'] = 'Category have been already exist';
            $_SESSION['id'] = $data['id'];
            header('Location:cate_controller.php?action=editPage&id='.$data['id']);
        }
        else{
            $update_at = date('Y-m-d');
            $this->cate_model->updateCateById($data,$update_at);
            $_SESSION['messages'] = 'Update Categories success';
            header('Location:cate_controller.php?action=listCate');
        }
    }

    function addNewCatePageAction(){
        require_once '../views/categories/addnewcate.php';
    }

    function addNewCateAction($data){
        $result = $this->cate_model->checkCateInfo($data);
        if(count($result) > 0){
            $_SESSION['link'] = $data['action'].'Page';
            $_SESSION['messages'] = 'Category have been already exist';
            header('Location:cate_controller.php?action=addNewCatePage');
        }else{
            $created_at = date('Y-m-d');
            $this->cate_model->addNewCate($data, $created_at);
            $_SESSION['messages'] = 'Add new Category success';
            header('Location:cate_controller.php?action=listCate');
        }

    }

    function deleteAction($data){
        $result = $this->cate_model->deleteCate($data);
        if($result){
            $_SESSION['messages'] = 'Delete is success';
        }else{
            $_SESSION['messages'] = 'Can not delete this cate, please check user info again!';
        }
        header('Location:cate_controller.php?action=listCate');
    }

    function exitMessageAction($data){
        unset($_SESSION['messages']);
        header('Location:cate_controller.php?action='.$data);
    }

    public function exitMessageEditAction($data){
        unset($_SESSION['messages']);
        header('Location:cate_controller.php?action=editPage&id='.$data);
    }

}

//Created new object cateControllers
$cate = new CateController();


if(isset($_REQUEST['action'])){
    $_SESSION['ctr_name'] = $cate->ctr_name;
    $_SESSION['sub_menu'] = $action = $_REQUEST['action'];

}else{
    $action = 'index';
}

//Process controllers
switch ($action){
    case 'index':
        $cate->indexAction();
        break;
    case 'listCate':
        $cate->listAction($_REQUEST);
        break;
    case 'editPage':
        $cate->showEditPage($_REQUEST);
        break;
    case 'edit';
        $cate->editAction($_REQUEST);
        break;
    case 'addNewCatePage';
        $cate->addNewCatePageAction();
        break;
    case 'addNewCate':
        $cate->addNewCateAction($_REQUEST);
        break;
    case 'delete';
        $cate->deleteAction($_REQUEST['id']);
        break;
    case 'exitmessage':
        $cate->exitMessageAction($_REQUEST['link']);
        break;
    case 'exitMessageEdit':
        $cate->exitMessageEditAction($_REQUEST['id']);
        break;

}