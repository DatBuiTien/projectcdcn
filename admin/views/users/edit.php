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
        Edit Information

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
            <h4 class="modal-title">Form Edit</h4>
        </div>
        <div class="modal-body">
            <form id="register" action="<?php echo URL_ADMIN_PART?>/controllers/user_controller.php" method="post" novalidate enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit">
                <div class="form-group has-feedback">
                    <input type="text" name="username-edit" class="form-control" value="<?php echo $_SESSION['data']['username']?>">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="email-edit" value="<?php echo $_SESSION['data']['email']?>">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password-edit" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="cfpassword-edit" placeholder="Retype password">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="file" class="form-control" name="avatar-reg" value="<?php echo $_SESSION['data']['image'];?>">
                </div>

                <div class="form-group has-feedback">
                    <img src="<?php echo URL_ADMIN_IMAGE_PART.'/users/'.$_SESSION['data']['image']?>" alt="your image" width="50">
                </div>

                <div class="form-group has-feedback">
                    <input type="radio" name="gender-edit" value="<?php echo MALE;?>" style="margin-left: 10%"> <span style="margin-right: 60%; ">Male</span>
                    <input type="radio" name="gender-edit" value="<?php echo FEMALE;?>"> Female
                </div>

                <div class="form-group has-feedback">
                    <input type="text" name="capquyen-edit" class="form-control" value="<?php echo $_SESSION['data']['capquyen']?>">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" name="phone-edit" class="form-control" value="<?php echo '0'.$_SESSION['data']['phone']?>">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" name="address-edit" class="form-control" value="<?php echo $_SESSION['data']['Address']?>">
                    <span class="glyphicon glyphicon-home form-control-feedback"></span>
                </div>

                <div class="modal-footer">
                    <a href="user_controller.php?action=list" onclick="return confirmExit()" type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</a>
                    <button type="reset" class="btn btn-primary" name="reset-edit">Reset</button>
                    <button type="submit" class="btn btn-primary" name="submit-edit">Save changes</button>
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
