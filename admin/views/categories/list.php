<?php
require_once '../views/template/header.php';
?>
    <section class="content-header">
        <h1>
            List Categories
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
        </ol>
    </section>

    <!--Main Content-->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Hover Data Table</h3>
                    </div>
                    <?php if(isset($_SESSION['messages'])){?>
                        <div class="callout callout-danger">
                            <a href="cate_controller.php?action=exitmessage&link=<?php echo $_SESSION['link'];?>" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></a>
                            <h3><?php echo $_SESSION['messages'];?></h3>
                        </div>
                    <?php }?>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Tên không dấu</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Created_at</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Updated_at</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Repair</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($_SESSION['cate'] as $key => $value){
                                            ?>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1"><?php echo $value['id'];?></td>
                                                <td><?php echo $value['cate_name'];?></td>
                                                <td><?php echo $value['cate_tenkhongdau'];?></td>
                                                <td><?php echo $value['created_at'];?></td>
                                                <td><?php echo $value['update_at'];?></td>
                                                <td><a href="cate_controller.php?action=editPage&id=<?php echo $value['id']?>" class="btn btn-info">Edit</a></td>
                                                <td><a href="cate_controller.php?action=delete&id=<?php echo $value['id'] ?>" onclick="return confirmDelete()" class="btn btn-danger">Delete</a></td>
                                            </tr>
                                        <?php }?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-5">

                                </div>

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