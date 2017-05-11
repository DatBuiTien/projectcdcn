<?php
require_once '../views/template/header.php';
?>
    <section class="content-header">
        <h1>
            List Customer
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
                            <a href="customer_controller.php?action=exitmessage" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></a>
                            <h3><?php echo $_SESSION['messages'];?></h3>
                        </div>
                    <?php }?>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"></div><div class="col-sm-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">STT</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Email</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Phone</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Address</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">orderDate</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Require Order Date</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Total</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Status</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">View Order</th>
                                            <!--<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Repair</th>
                                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">Delete</th>-->
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $x=1;
                                        foreach ($_SESSION['customer'] as $key => $value){
                                            ?>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1"><?php echo $x++;?></td>
                                                <td><?php echo $value['name'];?></td>
                                                <td><?php echo $value['email'];?></td>
                                                <td><?php echo '0'.$value['phone'];?></td>
                                                <td><?php echo $value['address'];?></td>
                                                <td><?php echo $value['orderdate'];?></td>
                                                <td><?php echo $value['requiredate'];?></td>
                                                <td><?php echo number_format($value['total']);?></td>
                                                <td>
                                                    <div class="btn-group" style="width: 140px">
                                                        <button type="button" class="btn btn-success btn-flat" style="width: 100px">
                                                            <?php echo ($status = ($value['status'] == 1)?'Shipped':'Not shipped') ;?>
                                                        </button>
                                                        <button type="button" class="btn btn-success btn-flat dropdown-toggle" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="customer_controller.php?action=editStatusOrder&id=<?php echo $value['id']?>&status=<?php echo ORDER_STATUS_ACTIVE?>">Shipped</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="customer_controller.php?action=editStatusOrder&id=<?php echo $value['id']?>&status=<?php echo ORDER_STATUS_UN_ACTIVE?>">Not Shipped</a></li>
                                                        </ul>
                                                    </div>

                                                </td>
                                                <td><a href="customer_controller.php?action=viewOrder&id=<?php echo $value['id']?>" class="btn btn-warning">View</a></td>
                                                <!--<td><a href="customer_controller.php?action=editPage&id=<?php /*echo $value['id']*/?>" class="btn btn-info">Edit</a></td>
                                                <td><a href="customer_controller.php?action=delete&id=<?php /*echo $value['id'] */?>" onclick="return confirmDelete()" class="btn btn-danger">Delete</a></td>-->
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