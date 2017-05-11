<?php
ob_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require '../../configs/config.php';
require_once '../models/user_model.php';
require_once '../libs/functions.php';

class UserControllers {
    public $user_model;
    public $ctr_name='users';
    public function __construct(){
        $this->user_model = new UserModel();
        if(!isset($_SESSION['user_info'])){
            $this->loginAction();
        }
    }


    function indexAction(){
        if(isset($_SESSION['user_info'])){
            $this->listAction();
        }else{
            $this->loginAction();
        }
    }

    function loginAction(){
        if(!isset($_SESSION['user_info'])){
            if (isset($_REQUEST['login_submit'])) {
                $user_info = $this->user_model->checkUserInfo($_REQUEST['user_name'], $_REQUEST['password']);
                if (count($user_info) > 0) {
                    $_SESSION['user_info'] = $user_info;
                    unset($_SESSION['messages']);
                    if($_SESSION['user_info'][0]['capquyen'] == "1"){
                        header('Location:user_controller.php?action=list');
                    }else{
                        header('Location:user_controller.php?action=listUser');
                    }

                } else {
                    //login fail
                    $_SESSION['messages'] = 'Please check user info again!';
                    header('Location:user_controller.php?action=showLoginPageAction');
                }
            }else{
                require_once '../views/users/login.php';
            }
        }else{
            if($_SESSION['user_info'][0]['capquyen'] == "1"){
                header('Location:user_controller.php?action=list');
            }else{
                header('Location:user_controller.php?action=listUser');
            }
        }
    }

    function showLoginPageAction(){
        require_once '../views/users/login.php';
    }
    function logoutAction(){
//        unset($_SESSION['user_info']);
        session_destroy();
        $_SESSION['messages'] = 'Logout success!';
        header('Location:user_controller.php?action=login');
    }

    function listAction(){
        $data_search = '';
        if(isset($_SESSION['user_info'])){
            $page = 1;
            if(isset($_REQUEST['page'])){
                $page = $_REQUEST['page'];
            }
            if(isset($_REQUEST['search_data'])){
                $data = $this->user_model->searchUser($_REQUEST['search_data']);
                $data_search = $_REQUEST['search_data'];
            }else{
                $data = $this->user_model->getAllUsers();
            }
            $_SESSION['all_user_data'] = $data;
            if(count($data) > NUMBER_RECORD_IN_PAGE){
                $result = pagination($page, $data, NUMBER_RECORD_IN_PAGE, 'users', '../controllers/user_controller.php?action=list&page=', $this->user_model, $data_search, '');
                $_SESSION['paging'] = $result['paging'];
                $_SESSION['data'] = $result['data'];
            }else{
                $_SESSION['data'] = $data;
            }
            require_once '../views/users/admin.php';
        }else{
            header('Location:user_controller.php?action=login');
        }
    }

    function listUserAction(){
        $data_search = '';
        if(isset($_SESSION['user_info'])){
            $page = 1;
            if(isset($_REQUEST['page'])){
                $page = $_REQUEST['page'];
            }
            if(isset($_REQUEST['search_data'])){
                $data = $this->user_model->searchUser($_REQUEST['search_data']);
                $data_search = $_REQUEST['search_data'];
            }else{
                $data = $this->user_model->getAllUsers();

            }
            $_SESSION['all_user_data'] = $data;
            if(count($data) > NUMBER_RECORD_IN_PAGE){
                $result = pagination($page, $data, NUMBER_RECORD_IN_PAGE, 'users', '../controllers/user_controller.php?action=listUser&page=', $this->user_model, $data_search);
                $_SESSION['paging'] = $result['paging'];
                $_SESSION['data'] = $result['data'];
            }else{
                $_SESSION['data'] = $data;
            }
            require_once '../views/users/users.php';
        }else{
            if($_SESSION['user_info'][0]['capquyen'] == "1"){
                header('Location:user_controller.php?action=list');
            }else{
                header('Location:user_controller.php?action=listUser');
            }
        }
    }

    //show add new page
    function addNewPageAction(){
        require_once '../views/users/add_new.php';
    }

    //Register
    function RegisterAction($data, $obj_file){

        $checkEmail = $this->user_model->checkExistAccount($data['email-reg']);

        if(count($checkEmail) > 0){
            $_SESSION['messages'] = 'Email existed';
            header('Location:user_controller.php?action=showLoginPageAction');
        }else{
            $result = uploadImage(URL_ADMIN_UPLOAD_PART.'/users/', $obj_file, 1, 10*1048576, array('jpg', 'gif', 'png', 'jpeg', 'JPG'));
            if($result['uploadOk'] == 1){
                $data['image-reg'] = $result['newNameImage'];
                $result = $this->user_model->insertNewUser($data);
                $_SESSION['messages'] = 'Register success!';
                $_SESSION['data'] = $result;
                header('Location:user_controller.php?action=showLoginPageAction');
            }else{
                $_SESSION['messages'] = 'Add new fail, please check user info again';
                header('Location:user_controller.php?action=showLoginPageAction');
            }
        }

    }
    /*function createAction($data){
        $result = $this->user_model->insertNewUser($data);
        if($result){
            $_SESSION['messages'] = 'Add new success!';
            header('Location:user_controller.php?action=list');
        }else{
            $_SESSION['messages'] = 'Add new fail , please check user info again!';
            header('Location:user_controller.php?action=addNew');
        }
    }*/

    //Delete user
    function deleteAction($data){
        $result = $this->user_model->deleteUser($data);
        if($result){
            $_SESSION['messages'] = 'Delete is success';
        }else{
            $_SESSION['messages'] = 'Can not delete this user, please check user info again!';
        }
        header('Location:user_controller.php?action=list');
    }

    function showEditPageAction($id){
        $result = $this->user_model->getUserInfoById($id);
        if($result){
            $_SESSION['data'] = $result;
            require_once '../views/users/edit.php';
        }else{
            $_SESSION['messages'] = 'This user not exist, please check user info again';
            header('Location:user_controller.php?action=list');
        }
    }


    function editAction($data, $obj_file){
        //process upload avatar
        $result = uploadImage(URL_ADMIN_UPLOAD_PART.'/users/',$obj_file, 1, 10*1048576, array('jpg', 'gif', 'png', 'jpeg', 'JPG'));
        if($result['uploadOk'] == 1){
            $data['image'] = $obj_file['avatar-reg']['name'];
            $data['id'] = $_SESSION['data']['id'];
            $result = $this->user_model->checkUserInfoUpdate($data);
            if($result){
                if(unlink(URL_ADMIN_UPLOAD_PART.'/users/'.$_SESSION['data']['image'])){
                    $this->user_model->updateUserById($data);
                    $_SESSION['messages']='Edit success';
                    header('Location:user_controller.php?action=list');
                }else{
                    $_SESSION['messages'] = 'Old avatar is not clean! Please try again ';
                    header('Location:user_controller.php?action=editPage&id='.$data['id']);
                }
            }else{
                $_SESSION['messages'] = 'This user be existed, please check user in for again!';
                header('Location:user_controller.php?action=editPage&id=' . $data['id']);
            }

        }else{
            $_SESSION["messages"]=$result['message'];
            header('Location:user_controller.php?action=editPage$id='.$data["id"]);
        }

    }

    function createAction($data, $obj_file){
        //process upload avatar

        $result = uploadImage(URL_ADMIN_UPLOAD_PART.'/users/', $obj_file, 1, 10*1048576, array('jpg', 'gif', 'png', 'jpeg'));

        if($result['uploadOk'] == 1){
            $data['image'] = $obj_file['image_upload']['name'];
            $result = $this->user_model->insertNewUser($data);
            if($result){
                $_SESSION['messages'] = 'Add new success!';
                header('Location:user_controller.php?action=list');
            }else{
                $_SESSION['messages'] = 'Add new fail, please check user info again';
                header('Location:user_controller.php?action=addNew');
            }
        }else{

            $_SESSION['messages'] = $result['messages'];
            header('Location:user_controller.php?action=list');
        }
    }

    function exitMessageAction($data){
        unset($_SESSION['messages']);
        header('Location:cate_controller.php?action='.$data['link']);
    }


    function ajaxUpdateUserStatus($data){
        $result = $this->user_model->updateUserStatus($data);
        if($result){
            echo json_encode(array('update_status' => 1, 'message' => 'Update User status is success'));
        }else{
            echo json_encode(array('update_status' => 0, 'message' => 'Update User status is fail, please try again'));
        }
        die;
    }

    function profileAction(){
        require_once '../views/users/profile.php';
    }
}

$admin = new UserControllers();

if(isset($_REQUEST['action'])){
    $_SESSION['ctr_name'] = $admin->ctr_name;
    $_SESSION['sub_menu'] = $action = $_REQUEST['action'];
}else{
    $action = 'index';
}

//create new object UserController


//Progress controller
switch ($action){
    case 'index':
        $admin->indexAction();
        break;
    case 'login':
        $admin->loginAction();
        break;
    case 'logout':
        $admin->logoutAction();
        break;
    case 'showLoginPageAction':
        $admin->showLoginPageAction();
        break;
    case 'list':
        $admin->listAction();
        break;
    case 'listUser':
        $admin->listUserAction();
        break;
    case 'register':
        $admin->RegisterAction($_REQUEST,$_FILES);
        break;
    case 'addNew':
        $admin->addNewPageAction();
        break;
    case 'create':
        $admin->createAction($_REQUEST,$_FILES);
        break;
    case 'edit':
        $admin->editAction($_REQUEST, $_FILES);
        break;
    case 'editPage':
        $admin->showEditPageAction($_REQUEST["id"]);
        break;
    case 'delete':
        $admin->deleteAction($_REQUEST["id"]);
        break;
    case 'exitmessage':
        $admin->exitMessageAction($_REQUEST);
        break;
    case 'profile':
        $admin->profileAction();
        break;
    case 'ajaxUpdateUserStatus':
        $admin->ajaxUpdateUserStatus($_REQUEST);
        break;
    default:
        $admin->indexAction();
        break;
}