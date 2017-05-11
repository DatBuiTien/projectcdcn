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
        Add New Product
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
            <a href="product_controller.php?action=listProduct&cateid=all&ptid=all" type="button" class="close" data-dismiss="modal" onclick="return confirmExit()" aria-label="Close">
                <span aria-hidden="true">×</span></a>
            <h4 class="modal-title">Form Edit Product</h4>
        </div>
        <?php if(isset($_SESSION['messages'])){ ?>
            <div class="callout callout-info">
                <a href="product_controller.php?action=exitMessageErrorAddNew" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></a>
                <h4><?php echo $_SESSION['messages']?></h4>

            </div>
        <?php } ?>
        <div class="modal-body">
            <form role="form" name="form-addproduct" onsubmit="return productForm()" action="<?php echo URL_ADMIN_PART?>/controllers/product_controller.php" method="post" novalidate enctype="multipart/form-data">
                <input type="hidden" name="action" value="addNewProduct">
                <div class="box-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Product Name</label>
                        <input type="text" name="p-name" class="form-control" id="pname" >
                    </div>

                    <div id="err-pname" class="callout callout-danger" style="display:none">
                        <h4>Please input Product name!</h4>
                    </div>

                    <div class="btn-group-vertical">
                        <button type="button" onclick="getLinkProduct()" class="btn btn-success">Get link</button>
                    </div>

                    <div style="margin-top: 8px"></div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Product link</label>
                        <input type="text" name="p-link" class="form-control" id="plink">
                    </div>
                    <div id="err-plink" class="callout callout-danger" style="display:none">
                        <h4>Please input Product link!</h4>
                    </div>

                    <div class="form-group">
                        <label>Brief</label>
                        <textarea name="p-brief" id="p-brief" class="form-control" rows="3"></textarea>
                    </div>
                    <div id="err-brief" class="callout callout-danger" style="display:none">
                        <h4>Please input Brief!</h4>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="p-desc" id="p-desc" style="height: 250px" class="form-control" rows="3" ></textarea>
                    </div>
                    <div id="err-desc" class="callout callout-danger" style="display:none">
                        <h4>Please input Description !</h4>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Avatar</label>
                        <input type="file" name="avatar-reg" class="form-control" id="p-avatar" >
                    </div>
                    <div id="err-avatar" class="callout callout-danger" style="display:none">
                        <h4>Please input Avatar !</h4>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputPassword1">Gallery</label>
                        <input type="file" name="p-image[]" id="p-image" multiple>

                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword1">Price</label>
                        <input type="text" name="p-price" class="form-control" id="p-price">
                    </div>

                    <div id="err-price" class="callout callout-danger" style="display:none">
                        <h4>Please input Price !</h4>
                    </div>
                    <div id="err-price-number" class="callout callout-danger" style="display:none">
                        <h4>Please input Price in the number !</h4>
                    </div>

                    <div class="form-group">
                        <label>ProductType</label>
                        <select class="form-control" name="pt-id" id="pt-id">
                            <option value="0">None</option>
                            <?php foreach ($_SESSION['pt'] as $key => $value){?>
                                <option value="<?php echo $value['id']?>"><?php echo $value['pt_name'].' - '. $value['cate_name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div id="err-pt" class="callout callout-danger" style="display:none">
                        <h4>Please choose ProductType !</h4>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="reset" class="btn btn-primary">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
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

    function productForm() {
        var pname = document.forms["form-addproduct"]["p-name"].value;
        var plink = document.forms["form-addproduct"]["p-link"].value;
        var pbrief = document.forms["form-addproduct"]["p-brief"].value;
        var pdesc = document.forms["form-addproduct"]["p-desc"].value;
        var pavatar = document.forms["form-addproduct"]["avatar-reg"].value;
        var pprice = document.forms["form-addproduct"]["p-price"].value;
        var ptid = document.forms["form-addproduct"]["pt-id"].value;

        if(pname == ""){

            document.getElementById("err-pname").style.display="block";
            document.getElementById("pname").focus();
            return false;
        }else{
            document.getElementById("err-pname").style.display="none";
        }

        if(plink == ''){
            document.getElementById("err-plink").style.display="block";
            return false;
        }else{
            document.getElementById("err-plink").style.display="none";
        }

        if(pbrief == ''){
            document.getElementById("err-brief").style.display="block";
            return false;
        }else{
            document.getElementById("err-brief").style.display="none";
        }

        if(pdesc == ''){
            document.getElementById("err-desc").style.display="block";
            return false;
        }else{
            document.getElementById("err-desc").style.display="none";
        }

        if(pavatar == ''){
            document.getElementById("err-avatar").style.display="block";
            return false;
        }else{
            document.getElementById("err-avatar").style.display="none";
        }

        if(pprice == ''){
            document.getElementById("err-price").style.display="block";
            return false;
        }else{
            document.getElementById("err-price").style.display="none";
        }

        if(typeof pprice != 'undefined' && isNaN(pprice)){
            document.getElementById("err-price-number").style.display="block";
            return false;
        }else{
            document.getElementById("err-price-number").style.display="none";
        }

        if(ptid == 0){
            document.getElementById("err-pt").style.display="block";
            return false;
        }else{
            document.getElementById("err-pt").style.display="none";
        }

    }

</script>

<?php
require_once '../views/template/footer.php';
?>
