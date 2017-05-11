<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require '../../configs/config.php';
require_once '../models/product_model.php';
require_once '../libs/functions.php';

class ProductController {
    public $p_model;
    public $ctr_name = 'product';
    public function __construct()
    {
        $this->p_model = new ProductModel();
        if(!isset($_SESSION['user_info'])){
            $_SESSION['messages'] = 'You must login';
            header('Location:user_controller.php?action=login');
        }
        date_default_timezone_set("Asia/Bangkok");

    }

    function indexAction($data){
        $this->listAction($data);
    }

    function listAction($data){
        $page=1;
        $data_search='';
        $datacate = $this->p_model->getAllCate();
        $_SESSION['cate'] = $datacate;

        if(isset($data['search_data'])){
            $data_search = $this->p_model->searchProduct($data['search_data']);
            $_SESSION['product'] = $data_search;
            $data['cateid'] = 'all';
            $data['ptid'] = 'all';
            $datapt = $this->p_model->getAllProductType();
            $_SESSION['pt'] = $datapt;

        }
        else{
            if($data['cateid'] == 'all' && $data['ptid'] == 'all'){
                $datapt = $this->p_model->getAllProductType();
                $_SESSION['pt'] = $datapt;
                $datap = $this->p_model->getAllProduct();
                $_SESSION['all_product'] = $datap;

                if(isset($_REQUEST['page'])){
                    $page = $_REQUEST['page'];
                }
                if(count($datap) > NUMBER_RECORD_PRODUCTTYPE_IN_PAGE){
                    $join = '';
                    $result = pagination($page, $datap, NUMBER_RECORD_PRODUCTTYPE_IN_PAGE, 'product', '../controllers/product_controller.php?action=listProduct&cateid=all&ptid=all&page=', $this->p_model, $data_search, $join);
                    $_SESSION['paging'] = $result['paging'];
                    $_SESSION['product'] = $result['data'];

                }else{
                    $_SESSION['product'] = $datap;
                }

            }

            if($data['cateid'] != 'all' && $data['ptid'] == 'all'){
                $datapt = $this->p_model->getAllProductTypeByCate($data);
                $_SESSION['pt'] = $datapt;
                $datap = $this->p_model->getAllProductByCate($data);
                $_SESSION['product'] = $datap;
            }
            if($data['cateid'] == 'all' && $data['ptid'] != 'all'){
                $datapt = $this->p_model->getAllProductType();
                $_SESSION['pt'] = $datapt;
                $datap = $this->p_model->getAllProductByProductType($data);
                $_SESSION['product'] = $datap;
            }
            if($data['cateid'] != 'all' && $data['ptid'] != 'all'){
                $datapt = $this->p_model->getAllProductTypeByCate($data);
                $_SESSION['pt'] = $datapt;
                $datap = $this->p_model->getAllProductByProductTypeAndCate($data);
                $_SESSION['product'] = $datap;
            }

        }

        require_once '../views/products/list.php';
    }

    public function viewProduct($data){

        $datacate = $this->p_model->getAllCate();
        $_SESSION['cate'] = $datacate;
        if($data['cateid'] == 'all' && $data['ptid'] == 'all'){
            $datapt = $this->p_model->getAllProductType();
            $_SESSION['pt'] = $datapt;

        }
        if($data['cateid'] != 'all' && $data['ptid'] == 'all'){
            $datapt = $this->p_model->getAllProductTypeByCate($data);
            $_SESSION['pt'] = $datapt;
        }
        if($data['cateid'] == 'all' && $data['ptid'] != 'all'){
            $datapt = $this->p_model->getAllProductType();
            $_SESSION['pt'] = $datapt;

        }
        if($data['cateid'] != 'all' && $data['ptid'] != 'all'){
            $datapt = $this->p_model->getAllProductTypeByCate($data);
            $_SESSION['pt'] = $datapt;

        }
        $product_info = $this->p_model->getProductById($data);
        $p_image = $this->p_model->getImageProduct($data);
        $_SESSION['product_info'] = $product_info;
        $_SESSION['product_image'] = $p_image;
        require_once '../views/products/product_info.php';
    }

    public function showEditPageAction($data){
        $data_info = $this->p_model->getProductById($data);
        $data_image = $this->p_model->getImageProduct($data);
        $_SESSION['p_info'] = $data_info;
        $_SESSION['p_image'] = $data_image;
        require_once '../views/products/edit.php';
    }

    public function editAction($data, $obj_file){
        $datetime = date('Y-m-d H:i:s');
        $data['datetime'] = $datetime;

        if($obj_file['p-image']['name'][0] != ''){
            $result_manyimage = uploadManyImage(URL_IMAGE_UPLOAD_PART.'/product_images/', $obj_file, 1, 10*1048576, array('jpg', 'gif', 'png', 'jpeg', 'JPG'));
            /*var_dump($result['newNameImage'][0]);*/
            for($i = 0; $i < count($result_manyimage['newNameImage']); $i++){
                $this->p_model->insertProductImage($result_manyimage['newNameImage'][$i],$data['id']);
            }

        }

        if($obj_file['avatar-reg']['name'] != ''){
            $result_avatar = uploadImage(URL_IMAGE_UPLOAD_PART.'/products/', $obj_file, 1, 10*1048576, array('jpg', 'gif', 'png', 'jpeg', 'JPG'));
            $data['avatar'] = $result_avatar['newNameImage'];
            unlink(URL_IMAGE_UPLOAD_PART.'/products/'.$_SESSION['p_info'][0]['image']);
        }else{
            $data['avatar'] = $_SESSION['p_info'][0]['image'];
        }
        $result = $this->p_model->updateProductById($data);
        if($result){
            $_SESSION['messages'] = 'Edit Product success';
            header('Location:product_controller.php?action=listProduct&cateid=all&ptid=all');
        }else{
            $_SESSION['messages'] = 'Edit fail';
            header('Location:product_controller.php?action=editPage&id='.$data['id']);
        }
    }

    public function addNewProductPageAction(){
        $catedata = $this->p_model->getAllCate();
        $_SESSION['cate']= $catedata;
        $pt_data = $this->p_model->getAllProductType();
        $_SESSION['pt'] = $pt_data;
        require_once '../views/products/addnew.php';
    }

    public function addNewProductAction($data, $obj_file){

        $datetime = date('Y-m-d H:i:s');
        $data['datetime'] = $datetime;

        $result_avatar = uploadImage(URL_IMAGE_UPLOAD_PART.'/products/', $obj_file, 1, 10*1048576, array('jpg', 'gif', 'png', 'jpeg', 'JPG'));
        if($result_avatar['uploadOk'] == 1){
            $data['p-avatar'] = $result_avatar['newNameImage'];
            $result = $this->p_model->insertNewProduct($data);
            $_SESSION['data'] = $result;
            if($result){
                $data_id = $this->p_model->getIdLastProduct();

                if($obj_file['p-image']['name'][0] != ''){
                    $result_manyimage = uploadManyImage(URL_IMAGE_UPLOAD_PART.'/product_images/', $obj_file, 1, 10*1048576, array('jpg', 'gif', 'png', 'jpeg', 'JPG'));
                    /*var_dump($result['newNameImage'][0]);*/
                    for($i = 0; $i < count($result_manyimage['newNameImage']); $i++){
                        $this->p_model->insertProductImage($result_manyimage['newNameImage'][$i],$data_id['id']);
                    }

                }
                $_SESSION['messages'] = 'Add new Product success';
                header('Location:product_controller.php?action=listProduct&cateid=all&ptid=all');
            }else{
                $_SESSION['messages'] = 'Add new fail';
                header('Location:product_controller.php?action=addNewProductPage');
            }


        }else{
            $_SESSION['messages'] = 'Avatar fail';
            header('Location:product_controller.php?action=addNewProductPage');
        }


    }

    public function exitMessageAction(){
        unset($_SESSION['messages']);
        header('Location:product_controller.php?action=listProduct&cateid=all&ptid=all');
    }

    public function exitMessageErrorAddNewAction(){
        unset($_SESSION['messages']);
        header('Location:product_controller.php?action=addNewProductPage');
    }

    public function deleteAction($data){

        $p_image = $this->p_model->getImageProduct($data);

        $data_p = $this->p_model->getProductById($data);

        if(count($p_image) > 0){
            foreach ($p_image as $key => $value) {
                unlink(URL_IMAGE_UPLOAD_PART.'/product_images/'.$value['pi_name']);
            }

            $this->p_model->deleteImageProduct($data);

        }



        if($data_p[0]['image'] != ''){
            unlink(URL_IMAGE_UPLOAD_PART.'/products/'.$data_p[0]['image']);
        }

        $result = $this->p_model->deleteProduct($data);

        if($result){
            $_SESSION['messages'] = 'Delete is success';
        }else{
            $_SESSION['messages'] = 'Can not delete this product, please check product again!';
        }
        header('Location:product_controller.php?action=listProduct&cateid=all&ptid=all');

    }

}

//Created new object cateControllers
$product = new ProductController();


if(isset($_REQUEST['action'])){
    $_SESSION['ctr_name'] = $product->ctr_name;
    $_SESSION['sub_menu'] = $action = $_REQUEST['action'];

}else{
    $action = 'index';
}

//Process controllers
switch ($action){
    case 'index':
        $product->indexAction($_REQUEST);
        break;
    case 'listProduct':
        $product->listAction($_REQUEST);
        break;
    case 'view';
        $product->viewProduct($_REQUEST);
        break;
    case 'editPage':
        $product->showEditPageAction($_REQUEST);
        break;
    case 'edit':
        $product->editAction($_REQUEST, $_FILES);
        break;
    case 'addNewProductPage':
        $product->addNewProductPageAction();
        break;
    case 'addNewProduct':
        $product->addNewProductAction($_REQUEST, $_FILES);
        break;
    case 'exitmessage':
        $product->exitMessageAction();
        break;
    case 'exitMessageErrorAddNew':
        $product->exitMessageErrorAddNewAction();
        break;

    case 'delete':
        $product->deleteAction($_REQUEST);
        break;

}