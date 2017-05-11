<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 12-Apr-17
 * Time: 7:41 PM
 */
session_start();
require_once '../configs/config.php';
require_once '../models/cate_model.php';
require_once '../admin/libs/functions.php';

class CateController{
    public $cate_model;
    public $ctr_name = 'index';
    public function __construct()
    {
        $this->cate_model = new CateModel();
    }

    function indexAction($data){
        $products  = $this->cate_model->getAllProductsByCateName($data);
        $_SESSION['product'] = $products;

        $producttype = $this->cate_model->getAllProductTypeByCateName($data);
        $_SESSION['producttype'] = $producttype;
        require_once '../views/categories/list.php';

    }
}

$cate = new CateController();
if(isset($_REQUEST['action'])){
    $_SESSION['ctr_name'] = $cate->ctr_name;
    $_SESSION['sub_menu'] = $action = $_REQUEST['action'];
    $action = $_REQUEST['action'];
}else{
    $action = 'index';
}
switch ($action){
    case 'index':
        $cate->indexAction($_REQUEST);
        break;
    default:
        $cate->indexAction($_REQUEST);
        break;
}
