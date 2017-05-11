<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 26-Apr-17
 * Time: 9:13 AM
 */
require_once 'header_showcart.php';
require_once 'menu_slide.php';
?>
    <div class="main">
        <div class="content">

            <div class="content_top">
                <div class="heading">
                    <h3>Your shopping card</h3>
                </div>
                <div class="clear"></div>
            </div>

            <div class="section group">
                <?php
                if(isset($_SESSION['data']) > 0) {
                    foreach ($_SESSION['data'] as $key => $value) { ?>
                        <div class="grid_1_of_4 images_1_of_4" style="margin-left: 0px; width: 22%">
                            <a href="product_controller.php?action=index&product=<?php echo $value['id'] ?>"><img
                                    src="<?php echo URL_FRONT_END ?>/uploads/products/<?php echo $value['image'] ?>"
                                    alt=""/></a>
                            <h2><?php echo $value['p_name'] ?></h2>
                            <div class="price-details">
                                <div class="price-number">
                                    <p><span class="rupees"><?php echo number_format($value['price']) ?><span
                                                style="font-size: 17px"> VND x </span><?php echo $value['quantity'] ?></span>
                                    </p>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    <?php }
                }else{
                    echo '<h1>No have</h1>';
                }
                ?>
            </div>


            <!--Order-->

            <div class="content_top">
                <div class="heading">
                    <h3>Order</h3>
                </div>
                <div class="clear"></div>
            </div>

            <table style="width: 100%" class="order">
                <?php $x = 1?>
                <?php
                if(isset($_SESSION['data'])) { ?>
                    <tr>
                        <th>STT</th>
                        <th>Name Product</th>
                        <th>price each</th>
                        <th>Quantity</th>
                        <th>price</th>
                    </tr>
                    <?php
                    foreach ($_SESSION['data'] as $item => $value) { ?>

                        <tr>
                            <td style="text-align: center"><?php echo $x++ ?></td>
                            <td><?php echo $value['p_name'] ?></td>
                            <td style="text-align: right"><?php echo number_format($value['price']) . ' VND/ONE' ?></td>
                            <td style="text-align: center"><?php echo $value['quantity'] ?><a href="index_controller.php?action=editQuantityPage&id=<?php echo $value['id'] ?>" style="float: right">edit</a></td>
                            <td style="text-align: right"><?php echo number_format($value['total']) . ' VND' ?></td>
                        </tr>
                    <?php }
                }else{
                    echo 'No have';
                } ?>
            </table>
            <?php if(isset($_SESSION['data'])){ ?>
            <table style="width: 100%" class="order">
                <tr>
                    <th style="text-align: left; border-right: none">Total</th>
                    <td style="width: 23.35%; border-left: none ; text-align: right"><?php echo number_format($_SESSION['total']).' VND'?></td>
                </tr>
            </table>
            <button style="background-color: #00A000" href="preview.html" onclick="showOrder()" class="button">Buy</button>
            <?php }else{
                echo '';
            } ?>
        </div>


        <!--Buy-->
    </div>
    <div class="contact-form" style="display: none" id="showorder">
        <h1>Fill information</h1>
        <form method="post" action="index_controller.php" name="form-order" onsubmit="return checkInfoOrder()">
            <input name="action" value="order" type="hidden">
            <div>
                <span><label>Name</label></span>
                <span><input name="username" type="text" class="textbox"></span>
                <span style="color: red; display: none" id="err-username"><label>Please input your name</label></span>
            </div>
            <div>
                <span><label>E-mail</label></span>
                <span><input name="useremail" type="text" class="textbox"></span>
                <span style="color: red; display: none" id="err-useremail"><label>Please input your email</label></span>
                <span style="color: red; display: none" id="err-useremail-type"><label>Please enter your email valid</label></span>
            </div>
            <div>
                <span><label>Phone</label></span>
                <span><input name="userphone" type="text" class="textbox" maxlength="11"></span>
                <span style="color: red; display: none" id="err-phone"><label>Please input your phone number</label></span>
                <span style="color: red; display: none" id="err-phone-type"><label>Please input your phone in number </label></span>
            </div>
            <div>
                <span><label>Address</label></span>
                <span><input name="useraddress" type="text" class="textbox"></span>
                <span style="color: red; display: none" id="err-address"><label>Please input your address</label></span>
            </div>
            <div>
                <span><label>Date Reqired</label></span>
                <input type="text" id="daterequired" name="date_required" class="textbox">
                <span style="color: red; display: none" id="err-date"><label>Please input your date require</label></span>
            </div>
            <div>
                <span><input type="submit" value="Submit" class="myButton"></span>
            </div>
        </form>
    </div>
    </div>

<?php
require_once 'footer.php';
?>