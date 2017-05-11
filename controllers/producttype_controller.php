<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 12-Apr-17
 * Time: 7:41 PM
 */
session_start();
require_once '../configs/config.php';
require_once '../models/producttype_model.php';
require_once '../admin/libs/functions.php';

class ProductTypeController{
    public $producttype_model;
    public $ctr_name = 'index';
    public function __construct()
    {
        $this->producttype_model = new ProductTypeModel();
    }

    function indexAction($data){

        $products  = $this->producttype_model->getAllProductsByProductType($data);
        $_SESSION['product'] = $products;
        /*$producttype = $this->product_model->getAllProductTypeByCateName($data);
        $_SESSION['producttype'] = $producttype;*/
        require_once '../views/producttype/list.php';

    }
}

$producttype_ctrl = new ProductTypeController();
if(isset($_REQUEST['action'])){
    $_SESSION['ctr_name'] = $producttype_ctrl->ctr_name;
    $_SESSION['sub_menu'] = $action = $_REQUEST['action'];
    $action = $_REQUEST['action'];
}else{
    $action = 'index';
}
switch ($action){
    case 'index':
        $producttype_ctrl->indexAction($_REQUEST);
        break;
    default:
        $producttype_ctrl->indexAction($_REQUEST);
        break;
}
