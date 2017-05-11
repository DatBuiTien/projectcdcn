<?php
session_start();
require_once '../configs/config.php';
require_once '../models/index_model.php';
require_once '../admin/libs/functions.php';
class IndexController{
    public $index_model;
    public $ctr_name = 'index';
    public function __construct()
    {
        $this->index_model = new IndexModel();
        $_SESSION['menu'] = $this->index_model->getAllcategories();
        $sub_menu = $this->index_model->getAllProductType();
        $_SESSION['sub-menu'] = $sub_menu;

    }
    public function indexAction(){
        //get categories menu
        $new_data = $this->index_model->getNewProduct();
        $_SESSION['newdata'] = $new_data;
        $feature_data = $this->index_model->getFeatureProduct();
        $_SESSION['feature_data'] = $feature_data;

        require_once '../views/index.php';
    }

    public function searchAction($data){
        $result = $this->index_model->searchProduct($data);
        $_SESSION['product'] = $result;
        require_once '../views/index/search.php';
    }

    public function getAllProduct(){
        $result = $this->index_model->getAllProducts();
        $_SESSION['product'] = $result;
        require_once '../views/index/list_all_product.php';
    }

    public function showCardAction(){

        if(isset($_SESSION['card']['id_products'])){
            $_SESSION['data'] = $this->index_model->getProductInCard($_SESSION['card']['id_products']);

            sort($_SESSION['card']['id_products']);
            $countdata['count'] = array_count_values($_SESSION['card']['id_products']);     //dem tat ca gia tri khac nhau cus mang
            $count=0;
            $_SESSION['total'] = 0;
            if(isset($countdata['count']['0'])){
                unset($countdata['count']['0']);
            }
/*            var_dump($countdata['count']);die();*/
            foreach ($countdata['count'] as $item => $value){
                $_SESSION['data'][$count]['quantity'] = $value;
                $_SESSION['data'][$count]['total'] = $value*$_SESSION['data'][$count]['price'];
                $_SESSION['total'] = $_SESSION['total'] + $_SESSION['data'][$count]['total'];
                $count++;
            }
        }

        require_once '../views/showcard.php';
    }

    public function editQuantityPageAction($data){
        require_once '../views/editquantity.php';
    }

    public function editQuantityAction($data){
        /*$i=0;
        while ($i< count($_SESSION['card']['id_products'])){
            if($_SESSION['card']['id_products'][$i] == $data['id']){
                unset($_SESSION['card']['id_products'][$i]);
            }
        }*/
        for($i = 0; $i < count($_SESSION['card']['id_products']); $i++){
            if($_SESSION['card']['id_products'][$i] == $data['id']){
                $_SESSION['card']['id_products'][$i] = '0';
            }
        }

        for($j = 0 ; $j < $data['editquantity']; $j++){
            array_push($_SESSION['card']['id_products'], $data['id']);
        }

        /*foreach ($_SESSION['data'] as $item => $value){
            if($value['id'] == $data['id']){
                $value['quantity'] = $data['editquantity'];
            }
        }*/
        header('Location:index_controller.php?action=showCard');
    }

    public function orDerAction($data){
        $datetime = date('Y-m-d');
        $data['datetime'] = $datetime;
        $data['total'] = $_SESSION['total'];
        echo '<pre>';
        $result_customer =  $this->index_model->insertNewCustomer($data);

        if($result_customer){
            $id_customer = $this->index_model->getIdLastCustomer();
            for($i=0; $i < count($_SESSION['data']);$i++){
                $this->index_model->insertNewOrder($_SESSION['data'][$i], $id_customer['id']);
            }

            $_SESSION['messages'] = 'You bought success !';
            header('Location:index_controller.php?action=index');
        }else{
            $_SESSION['messages'] = 'Please check information';
            header('Location:index_controller.php?action=showCard');
        }
    }

}

//Create new object index_ctr
$index_ctr  = new IndexController();
if(isset($_REQUEST['action'])){
    $_SESSION['ctr_name'] = $index_ctr->ctr_name;
    $_SESSION['sub_menu'] = $action = $_REQUEST['action'];
    $action = $_REQUEST['action'];
}else{
    $action = 'index';
}

//Process controller
switch ($action){
    case 'index':
        $index_ctr->indexAction();
        break;
    case 'allProduct':
        $index_ctr->getAllProduct();
        break;
    case 'search':
        $index_ctr->searchAction($_REQUEST);
        break;
    case 'showCard':
        $index_ctr->showCardAction();
        break;
    case 'editQuantityPage':
        $index_ctr->editQuantityPageAction($_REQUEST);
        break;
    case 'editQuantity';
        $index_ctr->editQuantityAction($_REQUEST);
        break;
    case 'order':
        $index_ctr->orDerAction($_REQUEST);
        break;
    default:
        $index_ctr->indexAction();
        break;
}