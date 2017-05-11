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
            List Producttype
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
                        <div class="btn-group" style="float: right; margin-right: 50px">
                            <?php
                            if(isset($data['search_data'])){
                                foreach ($_SESSION['cate_search'] as $catetemp => $catesearch) {?>
                                 <a href="producttype_controller.php?action=listProductType&search_data=<?php echo $data['search_data']?>&cateid=<?php echo $catesearch['id']?>" type="button" class="btn btn-success" style="width: 130px">
                                        <?php echo $catesearch['cate_name'];?>
                                    </a>
                                <?php }
                                }else{
                                ?>

                            <button type="button" class="btn btn-success" style="width: 130px"><?php
                                    foreach ($_SESSION['cate'] as $temp => $caten){
                                        if($caten['id'] == $data['cateid']){
                                            echo $caten['cate_name'];
                                        }
                                    }
                                    if($data['cateid'] == 'all'){
                                        echo 'All Categories';
                                    }
                                }

                                ?></button>
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="?action=listProductType&cateid=all">All Categories</a></li>
                                <li class="divider"></li>
                                <?php foreach ($_SESSION['cate'] as $item => $cate){?>
                                    <li><a href="?action=listProductType&cateid=<?php echo $cate['id']?>"><?php echo $cate['cate_name']?></a></li>
                                <?php }?>


                                <!--<li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>-->
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
                                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">STT</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">PruductType Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Tên không dấu</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Category Name</th>

                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Created_at</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Updated_at</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Repair</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $x = 1;
                                        foreach ($_SESSION['pt_data'] as $key => $value){
                                            ?>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1"><?php echo $x++;?></td>
                                                <td><?php echo $value['pt_name'];?></td>
                                                <td><?php echo $value['pt_tenkhongdau'];?></td>
                                                <td><?php echo $value['cate_name'];?></td>
                                                <td><?php echo $value['created_at'];?></td>
                                                <td><?php echo $value['updated_at'];?></td>
                                                <td><a href="producttype_controller.php?action=editPage&cateid=<?php echo $value['id_categories']?>&id=<?php echo $value['id']?>" class="btn btn-info">Edit</a></td>
                                                <td><a href="producttype_controller.php?action=delete&id=<?php echo $value['id'] ?>" onclick="return confirmDelete()" class="btn btn-danger">Delete</a></td>
                                            </tr>
                                        <?php }?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4"><div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to <?php echo count($_SESSION['pt_data'])?> of <?php echo count($_SESSION['all_pt_data']) ?> entries</div></div>

                                    <?php
                                        echo $_SESSION['paging'];
                                    ?>

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