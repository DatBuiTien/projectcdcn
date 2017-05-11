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
        Add new Producttypes
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
            <h4 class="modal-title">Form add new</h4>
        </div>
        <?php if(isset($_SESSION['messages'])){ ?>
            <div class="callout callout-info">
                <a href="producttype_controller.php?action=exitMessageAddNew" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></a>
                <h4><?php echo $_SESSION['messages']?></h4>

            </div>
        <?php } ?>

        <div class="modal-body">
            <form role="form" name="form-addcate" onsubmit="return addNewPTForm()" action="<?php echo URL_ADMIN_PART?>/controllers/producttype_controller.php" method="post" novalidate enctype="multipart/form-data">
                <input type="hidden" name="action" value="addNewProductType">
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">ProductType Name</label>
                        <input type="text" name="ptname" class="form-control" id="ptname" >
                    </div>
                    <div id="err-catename" class="callout callout-danger" style="display:none">
                        <h4>Please input ProductType name!</h4>
                    </div>

                    <div class="btn-group-vertical">
                        <button type="button" onclick="getLinkProductType()" class="btn btn-success">Get link</button>
                    </div>
                    <div style="margin-top: 8px"></div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">ProductType Link</label>
                        <input type="text" name="ptlink" class="form-control" id="ptlink">
                    </div>
                    <div id="err-catelink" class="callout callout-danger" style="display:none">
                        <h4>Please input ProductType link!</h4>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Category Name</label>
                        <select class="form-control" name="cateid" id="cateid">
                            <option value="0">None</option>
                            <?php foreach ($_SESSION['cate'] as $key => $value){?>
                            <option value="<?php echo $value['id']?>"><?php echo $value['cate_name']?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div id="err-choose-cate" class="callout callout-danger" style="display:none">
                        <h4>Please choose Category name!</h4>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="reset" class="btn btn-primary">Reset</button>
                    <button type="submit" class="btn btn-primary">Add new</button>
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
    function addNewPTForm(){
        var ptname = document.forms["form-addcate"]["ptname"].value;
        var ptlink = document.forms["form-addcate"]["ptlink"].value;
        var catename = document.forms["form-addcate"]["cateid"].value;
        if (ptname == "") {
            document.getElementById("err-catename").style.display="block";
            document.getElementById("err-catelink").style.display="none";
            return false;
        }else document.getElementById("err-catename").style.display="none";
        if (ptlink == "") {
            document.getElementById("err-catelink").style.display="block";
            return false;
        }else document.getElementById("err-catelink").style.display="none";
        if (catename == "0") {
            document.getElementById("err-choose-cate").style.display="block";
            return false;
        }else document.getElementById("err-choose-cate").style.display="none";

    }
</script>

<?php
require_once '../views/template/footer.php';
?>
