<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 26-Apr-17
 * Time: 1:33 AM
 */
require_once '../views/header.php';
require_once '../views/menu_slide.php';
?>
<!--Main-->
<div class="main">
    <div class="content">

        <div class="content_top">
            <div class="heading">
                <h3>All Products </h3>
            </div>
            <div class="clear"></div>
        </div>

        <div class="section group">
            <?php
            if(count($_SESSION['product']) > 0){
                foreach ($_SESSION['product']as $key => $value){ ?>
                    <div class="grid_1_of_4 images_1_of_4" style="margin-left: 0px; width: 22%">
                        <a href="product_controller.php?action=index&product=<?php echo $value['id']?>"><img src="<?php echo URL_FRONT_END?>/uploads/products/<?php echo $value['image']?>" alt="" /></a>
                        <h2><?php echo $value['p_name']?></h2>
                        <div class="price-details">
                            <div class="price-number">
                                <p><span class="rupees"><?php echo number_format($value['price'])?><span style="font-size: 17px">đ</span></span></p>
                            </div>
                            <div class="add-cart">
                                <h4><a href="product_controller.php?action=index&product=<?php echo $value['id']?>">Add to Cart</a></h4>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                <?php }
            }else{
                echo '<h1>Not found</h1>';
            } ?>
        </div>

        <!--Feature Products-->

    </div>
</div>
</div>


<?php
require_once '../views/footer.php';
?>
