<?php
require_once '../views/template/header.php';
?>
    <section class="content-header">
        <h1>
            List Users

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
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Email</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Gender</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Phone</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Address</th>
                                    <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Quyền</th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $x=1;
                            foreach ($_SESSION['data'] as $key => $value){
                            ?>
                                        <tr role="row" class="odd">
                                            <td class="sorting_1"><?php echo $x++;?></td>
                                            <td><?php echo $value['username'];?></td>
                                            <td><?php echo $value['email'];?></td>
                                            <td><?php echo ($value['gender']==1?'Male':'female'); ?></td>
                                            <td><?php echo $value['phone'];?></td>
                                            <td><?php echo $value['Address'];?></td>
                                            <td><?php echo ($value['capquyen'] == '1')?'Admin':'User';?></td>

                                        </tr>
                                <?php }?>

                                </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4"><div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing <?php echo count($_SESSION['data'])?> of <?php echo count($_SESSION['all_user_data']) ?> entries</div></div>
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