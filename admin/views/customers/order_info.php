<?php
require_once '../views/template/header.php';
?>
    <section class="content-header">
        <h1>
            Order information
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

                    <?php if(isset($_SESSION['messages'])){?>
                        <div class="callout callout-danger">
                            <a href="customer_controller.php?action=exitmessage" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></a>
                            <h3><?php echo $_SESSION['messages'];?></h3>
                        </div>
                    <?php }?>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody><tr>
                                <th style="width:50%">Name:</th>
                                <td><?php echo $_SESSION['customer_info']['name']?></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><?php echo $_SESSION['customer_info']['email']?></td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td><?php echo '0'.$_SESSION['customer_info']['phone']?></td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td><?php echo $_SESSION['customer_info']['address']?></td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td><?php echo number_format($_SESSION['customer_info']['total']).' VND'?></td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td><?php echo ($status = ($_SESSION['customer_info']['status'] == 1)?'Shipped':'Not shipped') ?></td>
                            </tr>
                            <tr>
                                <th>Order Date:</th>
                                <td><?php echo $_SESSION['customer_info']['orderdate'] ?></td>
                            </tr>
                            <tr>
                                <th>Require Date:</th>
                                <td><?php echo $_SESSION['customer_info']['requiredate'] ?></td>
                            </tr>
                            </tbody></table>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">STT</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Product Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Price each</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Quantity</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Price</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Repair</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $x=1;
                                        foreach ($_SESSION['order_info'] as $key => $value){
                                            ?>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1"><?php echo $x++;?></td>
                                                <td><?php echo $value['p_name'];?></td>
                                                <td><?php echo number_format($value['price']).'VND/ONE';?></td>
                                                <td><?php echo $value['quantity'];?></td>
                                                <td><?php echo number_format($value['priceeach']).'VND';?></td>
                                                <td><a href="customer_controller.php?action=editPage&id=<?php echo $value['id']?>" class="btn btn-info">Edit</a></td>
                                                <td><a href="customer_controller.php?action=delete&id=<?php echo $value['id'] ?>" onclick="return confirmDelete()" class="btn btn-danger">Delete</a></td>
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