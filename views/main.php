<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 12-Apr-17
 * Time: 4:05 PM
 */
?>
<div class="main">
    <div class="content">

        <div class="content_top">
            <div class="heading">
                <h3>New Products</h3>
            </div>
            <div class="see">
                <p><a href="index_controller.php?action=allProduct">See all Products</a></p>
            </div>
            <div class="clear"></div>
        </div>

        <div class="section group">
            <?php foreach ($_SESSION['newdata']as $key => $value){ ?>
            <div class="grid_1_of_4 images_1_of_4" style="margin-left: 0px; width: 237px">
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
            <?php }?>
        </div>

        <!--Feature Products-->
        <div class="content_bottom">
            <div class="heading">
                <h3>Feature Products</h3>
            </div>
            <div class="see">
                <p><a href="#">See all Products</a></p>
            </div>
            <div class="clear"></div>
        </div>

        <div class="section group">
            <?php foreach ($_SESSION['feature_data'] as $item => $feature){?>
            <div class="grid_1_of_4 images_1_of_4" style="margin-left: 0px; width: 237px">
                <a href="product_controller.php?action=index&product=<?php echo $feature['id']?>"><img src="<?php echo URL_FRONT_END?>/uploads/products/<?php echo $feature['image']?>" alt="" /></a>
                <h2><?php echo $feature['p_name']?></h2>
                <div class="price-details">
                    <div class="price-number">
                        <p><span class="rupees"><?php echo number_format($feature['price'])?><span style="font-size: 17px">đ</span></span></p>
                    </div>
                    <div class="add-cart">
                        <h4><a href="product_controller.php?action=index&product=<?php echo $feature['id']?>">Add to Cart</a></h4>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</div>
</div>
