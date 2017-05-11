<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 14-Apr-17
 * Time: 7:16 AM
 */
require_once '../views/header.php';
require_once '../views/menu_slide.php';
?>

<div class="main">

    <div class="content">
        <?php if(!empty($_SESSION['product'])){ ?>
            <div class="content_top">
                <div class="heading">
                    <h3><?php echo $_SESSION['product'][0]['pt_name']; ?></h3>
                </div>
                <div class="clear"></div>
            </div>

            <div class="section group">
                <?php foreach ($_SESSION['product'] as $item => $product) {

                        ?>
                        <div class="grid_1_of_4 images_1_of_4" style="margin-left: 0px; width: 22%">
                            <a href="product_controller.php?action=index&product=<?php echo $product['id']?>"><img
                                    src="<?php echo URL_FRONT_END ?>/uploads/products/<?php echo $product['image'] ?>"
                                    alt=""/></a>
                            <h2><?php echo $product['p_name']?></h2>
                            <div class="price-details">
                                <div class="price-number">
                                    <p><span class="rupees"><?php echo number_format($product['price']).'đ'; ?></span></p>
                                </div>
                                <div class="add-cart">
                                    <h4><a href="product_controller.php?action=index&product=<?php echo $product['id']?>">Add to Cart</a></h4>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <?php
                }
                ?>
            </div>

        <?php } ?>

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
            <div class="grid_1_of_4 images_1_of_4">
                <a href="preview.html"><img src="<?php echo URL_FRONT_END?>/views/images/new-pic1.jpg" alt="" /></a>
                <h2>Lorem Ipsum is simply </h2>
                <div class="price-details">
                    <div class="price-number">
                        <p><span class="rupees">$849.99</span></p>
                    </div>
                    <div class="add-cart">
                        <h4><a href="preview.html">Add to Cart</a></h4>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="preview.html"><img src="<?php echo URL_FRONT_END?>/views/images/new-pic2.jpg" alt="" /></a>
                <h2>Lorem Ipsum is simply </h2>
                <div class="price-details">
                    <div class="price-number">
                        <p><span class="rupees">$599.99</span></p>
                    </div>
                    <div class="add-cart">
                        <h4><a href="preview.html">Add to Cart</a></h4>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="preview.html"><img src="<?php echo URL_FRONT_END?>/views/images/new-pic4.jpg" alt="" /></a>
                <h2>Lorem Ipsum is simply </h2>
                <div class="price-details">
                    <div class="price-number">
                        <p><span class="rupees">$799.99</span></p>
                    </div>
                    <div class="add-cart">
                        <h4><a href="preview.html">Add to Cart</a></h4>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="preview.html"><img src="<?php echo URL_FRONT_END?>/views/images/new-pic3.jpg" alt="" /></a>
                <h2>Lorem Ipsum is simply </h2>
                <div class="price-details">
                    <div class="price-number">
                        <p><span class="rupees">$899.99</span></p>
                    </div>
                    <div class="add-cart">
                        <h4><a href="preview.html">Add to Cart</a></h4>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<?php
require_once '../views/footer.php';
?>
