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
            <a href="cate_controller.php?action=listCate" type="button" class="close" data-dismiss="modal" onclick="return confirmExit()" aria-label="Close">
                <span aria-hidden="true">×</span></a>
            <h4 class="modal-title">Form Edit</h4>
        </div>
        <?php if(isset($_SESSION['messages'])){ ?>
            <div class="callout callout-info">
                <a href="cate_controller.php?action=exitMessageEdit&id=<?php echo $_SESSION['id']?>" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></a>
                <h4><?php echo $_SESSION['messages']?></h4>

            </div>
        <?php } ?>
        <div class="modal-body">
            <form role="form" name="form-addcate" onsubmit="return cateForm()" action="<?php echo URL_ADMIN_PART?>/controllers/cate_controller.php" method="post" novalidate enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" value="<?php echo $_SESSION['cate_info']['id']?>">
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Category Name</label>
                        <input type="text" name="catename" class="form-control" id="catename" placeholder="<?php echo $_SESSION['cate_info']['cate_name']?>">
                    </div>

                    <div id="err-catename" class="callout callout-danger" style="display:none">
                        <h4>Please input Category name!</h4>
                    </div>

                    <div class="btn-group-vertical">
                        <button type="button" onclick="getLink()" class="btn btn-success">Get link</button>
                    </div>
                    <div style="margin-top: 8px"></div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Category Name link</label>
                        <input type="text" name="catelink" class="form-control" id="catelink" placeholder="<?php echo $_SESSION['cate_info']['cate_tenkhongdau']?>">
                    </div>
                    <div id="err-catename" class="callout callout-danger" style="display:none">
                        <h4>Please input Category link!</h4>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="reset" class="btn btn-primary">Reset</button>
                    <button type="submit" class="btn btn-primary">Update</button>
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
