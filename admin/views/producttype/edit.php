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
        Add new Categories
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
    </ol>
</section>
<section class="content">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <a href="producttype_controller.php?action=listProductType&cateid=all" type="button" class="close" data-dismiss="modal" onclick="return confirmExit()" aria-label="Close">
                <span aria-hidden="true">×</span></a>
            <h4 class="modal-title">Form Edit ProductType</h4>
        </div>
        <?php if(isset($_SESSION['messages'])){ ?>
            <div class="callout callout-info">
                <a href="producttype_controller.php?action=exitMessageEdit&cateid=<?php echo $_SESSION['pt_info']['id_categories']?>&id=<?php echo $_SESSION['pt_info']['id']?>" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></a>
                <h4><?php echo $_SESSION['messages']?></h4>

            </div>
        <?php } ?>
        <div class="modal-body">
            <form role="form" name="form-addcate" onsubmit="return cateForm()" action="<?php echo URL_ADMIN_PART?>/controllers/producttype_controller.php" method="post" novalidate enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" value="<?php echo $_SESSION['pt_info']['id']?>">
                <input type="hidden" name="cateid" value="<?php echo $_SESSION['pt_info']['id_categories']?>">
                <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">ProductType Name</label>
                        <input type="text" name="ptname" class="form-control" id="catename" value="<?php echo $_SESSION['pt_info']['pt_name']?>">
                    </div>
                    <div id="err-catename" class="callout callout-danger" style="display:none">
                        <h4>Please input ProductType name!</h4>
                    </div>

                    <div class="btn-group-vertical">
                        <button type="button" onclick="getLink()" class="btn btn-success">Get link</button>
                    </div>
                    <div style="margin-top: 8px"></div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">ProductType Name link</label>
                        <input type="text" name="ptlink" class="form-control" id="catelink" value="<?php echo $_SESSION['pt_info']['pt_tenkhongdau']?>">
                    </div>
                    <div id="err-catelink" class="callout callout-danger" style="display:none">
                        <h4>Please input ProductType link!</h4>
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION['pt_info']['cate_name']?>" disabled="">
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
</section>
<script>
    function confirmExit() {
        return confirm("Are you want Exit ?");
    }
</script>

<?php
require_once '../views/template/footer.php';
?>
