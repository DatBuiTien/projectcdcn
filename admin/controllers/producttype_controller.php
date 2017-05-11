<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require '../../configs/config.php';
require_once '../models/producttype_model.php';
require_once '../libs/functions.php';

class ProductTypeController {
    public $pt_model;
    public $ctr_name = 'producttype';
    public function __construct()
    {
        $this->pt_model = new ProductTypeModel();
        date_default_timezone_set("Asia/Bangkok");
        if(!isset($_SESSION['user_info'])){
            $_SESSION['messages'] = 'You must login';
            header('Location:user_controller.php?action=login');
        }

    }

    function indexAction($data){
        $this->listAction($data);
    }

    function listAction($data){
        $page = 1;
        $data_search = '';
        $catedata = $this->pt_model->getAllCate();
        $_SESSION['cate'] = $catedata;
        if(isset($data['search_data'])){
            $datasearch = $this->pt_model->searchProductType($data['search_data']);
            $_SESSION['pt_data'] = $datasearch;
            if(isset($data['cateid'])){
                $datasearch = $this->pt_model->getAllProductTypeByCateAndSearch($data);
                $_SESSION['pt_data'] = $datasearch;
                $data_search = $datasearch;
            }
            $cate_search = $this->pt_model->getAllCateDistinct($data);
            $_SESSION['cate_search'] = $cate_search;

        }else{
            if(isset($_REQUEST['page'])){
                $page = $_REQUEST['page'];
            }
            if($data['cateid'] == 'all'){
                $ptdata = $this->pt_model->getAllProductType();
                $_SESSION['all_pt_data'] = $ptdata;
                if(count($ptdata) > NUMBER_RECORD_IN_PAGE){
                    $join = 'INNER JOIN categories c ON c.id = producttype.id_categories';
                    $result = pagination($page, $ptdata, NUMBER_RECORD_PRODUCTTYPE_IN_PAGE, 'producttype', '../controllers/producttype_controller.php?action=listProductType&cateid=all&page=', $this->pt_model, $data_search, $join);

                    $_SESSION['paging'] = $result['paging'];
                    $_SESSION['pt_data'] = $result['data'];
                }else{
                    $_SESSION['pt_data'] = $ptdata;
                }

            }else{
                $ptdata = $this->pt_model->getAllProductTypeByCate($data);
                $_SESSION['pt_data'] = $ptdata;
            }


        }
        require_once '../views/producttype/list.php';
    }

    function showEditPage($data){

        $pt_info = $this->pt_model->getInfoProductTypeById($data);
        $_SESSION['pt_info'] = $pt_info;
        require_once '../views/producttype/edit.php';
    }

    function editAction($data){
        $result = $this->pt_model->checkProductTypeById($data);
        if(count($result) > 0){
            $_SESSION['messages'] = 'ProductType have been already exist';
            header('Location:producttype_controller.php?action=editPage&cateid='.$data['cateid'].'&id='.$data['id']);
        }
        else{
            $update_at = date('Y-m-d');
            $this->pt_model->updateProductTypeById($data,$update_at);
            $_SESSION['messages'] = 'Update ProductType success';
            header('Location:producttype_controller.php?action=listProductType&cateid=all');
        }
    }

    function addNewCatePageAction(){
        require_once '../views/categories/addnewcate.php';
    }

    function addNewCateAction($data){

        $result = $this->pt_model->checkCateInfo($data);
        if(count($result) > 0){
            $_SESSION['messages'] = 'Categories have been exist';
            return false;
        }else{
            $created_at = date('Y-m-d');
            $this->pt_model->addNewCate($data, $created_at);
            $_SESSION['messages'] = 'Add new Categories success';
            header('Location:producttype_controller.php?action=listCate');
        }

    }

    function deleteAction($id){
        $result = $this->pt_model->deleteProductType($id);
        if($result){
            $_SESSION['messages'] = 'Delete is success';
        }else{
            $_SESSION['messages'] = 'Can not delete this cate, please check user info again!';
        }
        header('Location:producttype_controller.php?action=listProductType&cateid=all');
    }

    function exitMessageAction(){
        unset($_SESSION['messages']);
        header('Location:producttype_controller.php?action=listProductType&cateid=all');
    }

    public function exitMessageUpdateAction($data){
        unset($_SESSION['messages']);
        header('Location:producttype_controller.php?action=editPage&cateid='.$data['cateid'].'&id='.$data[id]);
    }

    public function addNewProductTypePageAction(){
        $data = $this->pt_model->getAllCate();
        $_SESSION['cate'] = $data;
        require_once '../views/producttype/addnewproducttype.php';
    }

    public function addNewProductTypeAction($data){
        $result = $this->pt_model->checkProductTypeById($data);
        if(count($result) > 0){
            $_SESSION['messages'] = 'ProductType have been already exist';
            header('Location:producttype_controller.php?action=addNewProductTypePage');
        }
        else{
            $created_at = date('Y-m-d');
            $this->pt_model->addNewProductType($data,$created_at);
            $_SESSION['messages'] = 'Add new ProductType success';
            header('Location:producttype_controller.php?action=listProductType&cateid=all');
        }
    }

    public function exitMessageAddNewAction(){
        unset($_SESSION['messages']);
        header('Location:producttype_controller.php?action=addNewProductTypePage');
    }

}

//Created new object cateControllers
$pt = new ProductTypeController();


if(isset($_REQUEST['action'])){
    $_SESSION['ctr_name'] = $pt->ctr_name;
    $_SESSION['sub_menu'] = $action = $_REQUEST['action'];

}else{
    $action = 'index';
}

//Process controllers
switch ($action){
    case 'index':
        $pt->indexAction($_REQUEST);
        break;
    case 'listProductType':
        $pt->listAction($_REQUEST);
        break;
    case 'editPage':
        $pt->showEditPage($_REQUEST);
        break;
    case 'edit':
        $pt->editAction($_REQUEST);
        break;
    case 'exitMessageEdit':
        $pt->exitMessageUpdateAction($_REQUEST);
        break;
    case 'exitmessage':
        $pt->exitMessageAction();
        break;
    case 'delete':
        $pt->deleteAction($_REQUEST['id']);
        break;
    case 'addNewProductTypePage':
        $pt->addNewProductTypePageAction();
        break;
    case 'addNewProductType':
        $pt->addNewProductTypeAction($_REQUEST);
        break;
    case 'exitMessageAddNew';
        $pt->exitMessageAddNewAction();
        break;
}