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
        Edit Product
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
            <a href="product_controller.php?action=listProduct&cateid=all&ptid=all" type="button" class="close" data-dismiss="modal" onclick="return confirmExit()" aria-label="Close">
                <span aria-hidden="true">×</span></a>
            <h4 class="modal-title">Form Edit Product</h4>
        </div>
        <?php if(isset($_SESSION['messages'])){ ?>
            <div class="callout callout-info">
                <a href="producttype_controller.php?action=exitMessageEdit&cateid=<?php echo $_SESSION['pt_info']['id_categories']?>&id=<?php echo $_SESSION['pt_info']['id']?>" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></a>
                <h4><?php echo $_SESSION['messages']?></h4>

            </div>
        <?php } ?>
        <div class="modal-body">
            <form role="form" name="form-addcate" onsubmit="return cateForm()" action="<?php echo URL_ADMIN_PART?>/controllers/product_controller.php" method="post" novalidate enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" value="<?php echo $_SESSION['p_info'][0]['id']?>">
                <input type="hidden" name="cateid" value="<?php echo $_SESSION['p_info'][0]['id_categories']?>">
                <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Name</label>
                        <input type="text" name="pname" class="form-control" id="catename" value="<?php echo $_SESSION['p_info'][0]['p_name']?>">
                    </div>

                    <div id="err-catename" class="callout callout-danger" style="display:none">
                        <h4>Please input Product name!</h4>
                    </div>

                    <div class="btn-group-vertical">
                        <button type="button" onclick="getLinkProduct()" class="btn btn-success">Get link</button>
                    </div>

                    <div style="margin-top: 8px"></div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Product link</label>
                        <input type="text" name="plink" class="form-control" id="catelink" value="<?php echo $_SESSION['p_info'][0]['p_tenkhongdau']?>">
                    </div>
                    <div id="err-catelink" class="callout callout-danger" style="display:none">
                        <h4>Please input ProductType link!</h4>
                    </div>

                    <div class="form-group">
                        <label>Tóm tắt</label>
                        <textarea name="tt-edit" id="tt-edit" class="form-control" rows="3"><?php echo $_SESSION['p_info'][0]['tomtat']?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="desc-edit" id="desc-edit" style="height: 250px" class="form-control" rows="3" ><?php echo $_SESSION['p_info'][0]['description']?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Avatar</label>
                        <input type="file" name="p-avatar" class="form-control" id="p-avatar" value="<?php echo $_SESSION['p_info'][0]['image']?>">
                        <img src="<?php echo URL_UPLOAD_IMAGE_PART?>/products/<?php echo $_SESSION['p_info'][0]['image']?>" style="width: 100px">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Gallery</label>
                        <div class="timeline-body">
                            <?php foreach ($_SESSION['p_image'] as $key => $value) { ?>
                                <img src="<?php echo URL_UPLOAD_IMAGE_PART?>/product_images/<?php echo $value['pi_name']?>" style="height: 100px" alt="..." class="margin">
                            <?php } ?>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputPassword1">Price</label>
                        <input type="text" name="p-price" class="form-control" id="p-price" value="<?php echo $_SESSION['p_info'][0]['price']?>">
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION['p_info'][0]['cate_name']?>" disabled="">
                    </div>
                    <div class="form-group">
                        <label>ProductType</label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION['p_info'][0]['pt_name']?>" disabled="">
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
