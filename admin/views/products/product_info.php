<?php
require_once '../views/template/header.php';
?>
    <div id="loading" style="display:none"><img src="<?php echo URL_ADMIN_PART?>/views/template/images/ajax-loader.gif" /></div>
    <script>
        $(function () {
            var loading = $("#loading");
            $(document).ajaxStart(function () {
                loading.show();
            });

            $(document).ajaxStop(function () {
                loading.hide();
            });

            $("#producttype").click(function () {
                $.ajax({
                    url: "http://www.google.com",
                    // ...
                });
            });
        });
    </script>

    <section class="content-header">
        <h1>
            List Product
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>
    <!--Messages-->
<?php if(isset($_SESSION['messages'])){?>
    <div class="callout callout-danger">
        <a href="producttype_controller.php?action=exitmessage" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></a>
        <h3><?php echo $_SESSION['messages'];?></h3>
    </div>
<?php }?>
    <!--Main Content-->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Hover Data Table</h3>

                        <!--Cate-->
                        <div class="btn-group" style="float: right; margin-right: 50px">
                            <button type="button" class="btn btn-success" style="width: 130px"><?php foreach ($_SESSION['cate'] as $temp => $caten){
                                    if($caten['id'] == $data['cateid']){
                                        echo $caten['cate_name'];
                                    }
                                }
                                if($data['cateid'] == 'all'){
                                    echo 'All Categories';
                                }
                                ?></button>
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="?action=listProduct&cateid=all&ptid=<?php echo $data['ptid']?>">All Categories</a></li>
                                <li class="divider"></li>
                                <?php foreach ($_SESSION['cate'] as $item => $cate){?>
                                    <li><a href="?action=listProduct&cateid=<?php echo $cate['id']?>&ptid=<?php echo $data['ptid']?>"><?php echo $cate['cate_name']?></a></li>
                                <?php }?>

                            </ul>
                        </div>

                        <!--ProductType-->
                        <div class="btn-group" style="float: right; margin-right: 50px">
                            <button type="button" class="btn btn-success" style="width: 130px"><?php
                                $x=0;
                                foreach ($_SESSION['pt'] as $temp => $ptnname){
                                    if($ptnname['id'] == $data['ptid']){
                                        echo $ptnname['pt_name'];
                                        $x++;
                                    }
                                }
                                if($data['ptid'] == 'all'){
                                    echo 'All ProductType';
                                    $x++;
                                }
                                if($x == 0){
                                    echo 'None';
                                }

                                ?></button>
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="?action=listProduct&cateid=<?php echo $data['cateid']?>&ptid=all">All ProductType</a></li>
                                <li class="divider"></li>
                                <?php foreach ($_SESSION['pt'] as $item => $pt){?>
                                    <li><a href="?action=listProduct&cateid=<?php echo $data['cateid']?>&ptid=<?php echo $pt['id']?>">
                                            <?php echo $pt['pt_name']; if($data['cateid'] == 'all'){echo ' - '.$pt['cate_name'];}?></a></li>
                                <?php }?>

                            </ul>
                        </div>

                    </div>


                    <?php /*if(isset($_SESSION['messages'])){*/?><!--
                        <div class="callout callout-danger">
                            <a href="cate_controller.php?action=exitmessage&link=<?php /*echo $_SESSION['link'];*/?>" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></a>
                            <h3><?php /*echo $_SESSION['messages'];*/?></h3>
                        </div>
                    <?php /*}*/?>

                    --><!-- /.box-header -->
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Product Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Product link</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Abbreviate</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Description</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Image</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Price</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">ProductType</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Category</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Created_at</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Updated_at</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($_SESSION['product_info'] as $key => $value){
                                            ?>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1"><?php echo $value['p_name'];?></td>
                                                <td><?php echo $value['p_tenkhongdau'];?></td>
                                                <td><?php echo $value['tomtat'];?></td>
                                                <td><?php echo $value['description'];?></td>
                                                <td><img style="width: 50px" src="<?php echo URL_PRODUCT_IMAGE_PART?>/products/<?php echo $value['image'];?>"/></td>
                                                <td><?php echo number_format($value['price']).'đ';?></td>
                                                <td><?php echo $value['pt_name'];?></td>
                                                <td><?php echo $value['cate_name'];?></td>
                                                <td><?php echo $value['created_at'];?></td>
                                                <td><?php echo $value['updated_at'];?></td>

                                            </tr>
                                        <?php }?>

                                        </tbody>
                                    </table>
                                    <div class="timeline-item">

                                        <h3 class="timeline-header">Galleries</h3>

                                        <div class="timeline-body">
                                            <?php
                                                foreach ($_SESSION['product_image'] as $item => $value){
                                            ?>
                                            <img src="<?php echo URL_PRODUCT_IMAGE_PART?>/product_images/<?php echo $value['pi_name'];?>" height="100" style="border: 1px solid #e9ebee" alt="..." class="margin">

                                                <?php } ?>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-5">

                                </div>
                                <a href="product_controller.php?action=editPage&id=<?php echo $_SESSION['product_info'][0]['id']?>" class="btn btn-info">Edit</a>
                                <a href="product_controller.php?action=delete&id=<?php echo $_SESSION['product_info'][0]['id'] ?>" onclick="return confirmDelete()" class="btn btn-danger">Delete</a>
                            </div>

                        </div>

                    </div>
                    <!-- /.box-body -->

                </div>
                <!-- /.box -->


                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>


    <script>
        function confirmDelete() {
            return confirm("Are you want delete ?");
        }
    </script>

<?php
require_once '../views/template/footer.php';
?>