<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this templustomer file, choose Tools | Templustomers
 * and open the templustomer in the editor.
 */
session_start();
require '../../configs/config.php';
require_once '../models/customer_model.php';
require_once '../libs/functions.php';

class CustomerController {
    public $customer_model;
    public $ctr_name = 'customer';
    public function __construct()
    {
        $this->customer_model= new CustomerModel();
        if(!isset($_SESSION['user_info'])){
            $_SESSION['messages'] = 'You must login';
            header('Location:user_controller.php?action=login');
        }
        date_default_timezone_set("Asia/Bangkok");
    }

    function indexAction(){
        $this->listAction();
    }

    function listAction($data){
        if(isset($_SESSION['user_info'])){
            if(isset($data['search_data'])){
                $datasearch = $this->customer_model->searchCustomer($data['search_data']);
                $_SESSION['customer'] = $datasearch;
            }else{
                $customerdata = $this->customer_model->getAllCustomer();
                $_SESSION['customer'] = $customerdata;
            }



            require_once '../views/customers/list.php';
        }
        else{

            $_SESSION['messages'] = 'You must login';
            header('Location:user_controller.php?action=showLoginPageAction');
        }

    }

    public function viewOrderAction($id_customer){
        $result = $this->customer_model->getOrderByIdCustomer($id_customer);
        $_SESSION['order_info'] = $result;
        $customer_info = $this->customer_model->getCustomerById($id_customer);
        $_SESSION['customer_info'] = $customer_info;
        require_once '../views/customers/order_info.php';
    }

    function editStatusOrderAction($data){
        $result = $this->customer_model->updateStatusOrder($data);
        if($result){
            header('Location:customer_controller.php?action=listCustomer');
        }
    }

    function showEditPage($data){
        if(isset($_SESSION['user_info'])) {
            $customer_info = $this->customer_model->getInfoCustomerById($data);
            $_SESSION['customer_info'] = $customer_info;
            require_once '../views/customergories/edit.php';
        }else{
            $_SESSION['messages'] = 'You must login';
            header('Location:user_controller.php?action=showLoginPageAction');
        }
    }

    function editAction($data){
        $result = $this->customer_model->checkCustomerInfoUpdustomer($data);
        if(count($result) > 0){
            $_SESSION['messages'] = 'Customergory have been already exist';
            $_SESSION['id'] = $data['id'];
            header('Location:customer_controller.php?action=editPage&id='.$data['id']);
        }
        else{
            $updustomer_at = dustomer('Y-m-d');
            $this->customer_model->updustomerCustomerById($data,$updustomer_at);
            $_SESSION['messages'] = 'Updustomer Customergories success';
            header('Location:customer_controller.php?action=listCustomer');
        }
    }

    function addNewCustomerPageAction(){
        require_once '../views/customergories/addnewcustomer.php';
    }

    function addNewCustomerAction($data){
        $result = $this->customer_model->checkCustomerInfo($data);
        if(count($result) > 0){
            $_SESSION['link'] = $data['action'].'Page';
            $_SESSION['messages'] = 'Customergory have been already exist';
            header('Location:customer_controller.php?action=addNewCustomerPage');
        }else{
            $creustomerd_at = dustomer('Y-m-d');
            $this->customer_model->addNewCustomer($data, $creustomerd_at);
            $_SESSION['messages'] = 'Add new Customergory success';
            header('Location:customer_controller.php?action=listCustomer');
        }

    }

    function deleteAction($data){
        $result = $this->customer_model->deleteCustomer($data);
        if($result){
            $_SESSION['messages'] = 'Delete is success';
        }else{
            $_SESSION['messages'] = 'Can not delete this customer, please check user info again!';
        }
        header('Location:customer_controller.php?action=listCustomer');
    }

    function exitMessageAction($data){
        unset($_SESSION['messages']);
        header('Location:customer_controller.php?action='.$data);
    }

    public function exitMessageEditAction($data){
        unset($_SESSION['messages']);
        header('Location:customer_controller.php?action=editPage&id='.$data);
    }

}

//Creustomerd new object customerControllers
$customer = new CustomerController();


if(isset($_REQUEST['action'])){
    $_SESSION['ctr_name'] = $customer->ctr_name;
    $_SESSION['sub_menu'] = $action = $_REQUEST['action'];

}else{
    $action = 'index';
}

//Process controllers
switch ($action){
    case 'index':
        $customer->indexAction();
        break;
    case 'listCustomer':
        $customer->listAction($_REQUEST);
        break;
    case 'viewOrder':
        $customer->viewOrderAction($_REQUEST['id']);
        break;
    case 'editStatusOrder':
        $customer->editStatusOrderAction($_REQUEST);
        break;


    case 'editPage':
        $customer->showEditPage($_REQUEST);
        break;
    case 'edit';
        $customer->editAction($_REQUEST);
        break;
    case 'addNewCustomerPage';
        $customer->addNewCustomerPageAction();
        break;
    case 'addNewCustomer':
        $customer->addNewCustomerAction($_REQUEST);
        break;
    case 'delete';
        $customer->deleteAction($_REQUEST['id']);
        break;
    case 'exitmessage':
        $customer->exitMessageAction($_REQUEST['link']);
        break;
    case 'exitMessageEdit':
        $customer->exitMessageEditAction($_REQUEST['id']);
        break;

}