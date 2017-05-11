<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 07-Apr-17
 * Time: 3:43 PM
 */
require_once '../views/template/header.php';
?>
<section class="content-header">
    <h1>
        Profile

    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
    </ol>
</section>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Information</h4>
        </div>
        <div class="modal-body">
            <form id="register" action="<?php echo URL_ADMIN_PART?>/controllers/user_controller.php" method="post" novalidate enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit">
                <div class="form-group has-feedback">
                    <label>Name</label>
                    <input type="text" name="username-edit" class="form-control" disabled value="<?php echo $_SESSION['user_info'][0]['username']?>">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email-edit" disabled value="<?php echo $_SESSION['user_info'][0]['email']?>">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <label>Avatar</label><br>
                    <img src="<?php echo URL_ADMIN_IMAGE_PART.'/users/'.$_SESSION['user_info'][0]['image']?>" alt="your image" width="50">
                </div>

                <div class="form-group has-feedback">
                    <label>Gender</label>
                    <input type="email" class="form-control" name="email-edit" disabled value="<?php echo $gender = ($_SESSION['user_info'][0]['gender'] == 1)?'Male':'Female' ?>">
                    <span class="glyphicon glyphicon-transgender form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <label>Authorization</label>
                    <input type="text" name="capquyen-edit" class="form-control" disabled value="<?php echo $quyen = ($_SESSION['user_info'][0]['gender'] == 1)?'Admin':'Employee'?>">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Phone number</label>
                    <input type="text" name="phone-edit" class="form-control" disabled value="<?php echo '0'.$_SESSION['user_info'][0]['phone']?>">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label>Address</label>
                    <input type="text" name="address-edit" class="form-control" disabled value="<?php echo $_SESSION['user_info'][0]['Address']?>">
                    <span class="glyphicon glyphicon-home form-control-feedback"></span>
                </div>

                <div class="modal-footer">
                    <a href="user_controller.php?action=list" onclick="return confirmExit()" type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</a>
                    <a href="?action=editPage&id=<?php echo $_SESSION['user_info'][0]['id']?>" class="btn btn-primary" name="reset-edit">Edit</a>
                </div>
            </form>

        </div>

    </div>
    <!-- /.modal-content -->
</div>

<script>
    function confirmExit() {
        return confirm("Are you want Exit ?");
    }
</script>

<?php
require_once '../views/template/footer.php';
?>
