<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 16-Apr-17
 * Time: 11:07 PM
 */
require_once '../views/header.php';
?>
<div class="main" xmlns="http://www.w3.org/1999/html">
    <div class="content">
        <div class="content_top">
            <div class="back-links">
                <p><a href="index.html">Home</a> >>>> <a href="#">Electronics</a></p>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <div class="cont-desc span_1_of_2">
                <div class="product-details">
                    <div class="grid images_3_of_2">
                        <div id="container">
                            <div id="products_example">
                                <div id="products">
                                    <div class="slides_container">
                                        <?php foreach ($_SESSION['product_image'] as $key => $value){?>
                                            <a href="#" target="_blank"><img style="height: 270px" src="<?php echo URL_FRONT_END?>/uploads/product_images/<?php echo $value['pi_name']?>" alt=" " /></a>
                                        <?php }?>
                                    </div>
                                    <ul class="pagination">
                                        <?php foreach ($_SESSION['product_image'] as $key => $value){?>
                                        <li><a href="#"><img src="<?php echo URL_FRONT_END?>/uploads/product_images/<?php echo $value['pi_name']?>" alt=" " /></a></li>
                                        <?php }?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="desc span_3_of_2">
                        <h2><?php
                            echo $_SESSION['product']['p_name'];
                            ?></h2>
                        <p><?php echo $_SESSION['product']['tomtat']?></p>
                        <div class="price">
                            <p>Price: <span><?php echo number_format($_SESSION['product']['price']).'đ'?></span></p>
                        </div>

                        <div class="share-desc">
                            <form action="product_controller.php">
                                <input name="action" value="addtocard" type="hidden">
                                <input name="id" value="<?php echo $_SESSION['product']['id']?>" type="hidden">
                                <div class="available">
                                    <p>Available Options :</p>
                                    <ul>
                                        <li>Quatity:<select name="quantity">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select></li>
                                    </ul>
                                </div>
                                <div class="add-cart" style="float:right;">
                                    <h4><button style="font-size:0.9em;display: block;padding:10px 15px;font-family: 'ambleregular';background:#CD1F25;color: #FFF;outline: 0;
                                        -webkit-transition: all 0.5s ease-in-out;
                                        -moz-transition: all 0.5s ease-in-out;
                                        -o-transition: all 0.5s ease-in-out;
                                        transition: all 0.5s ease-in-out;" type="submit" class="">Add to Cart</button></h4>
                                </div>
                                <div class="clear"></div>
                            </form>

                        </div>
                        <div class="wish-list">
                            <ul>
                                <li class="wish"><a href="#">Add to Wishlist</a></li>
                                <li class="compare"><a href="#">Add to Compare</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="product_desc">
                    <div id="horizontalTab">
                        <ul class="resp-tabs-list">
                            <li>Product Details</li>
                            <div class="clear"></div>
                        </ul>
                        <div class="resp-tabs-container">
                            <div class="product-desc">
                                <p><?php echo $_SESSION['product']['description']?></p>

                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#horizontalTab').easyResponsiveTabs({
                            type: 'default', //Types: default, vertical, accordion
                            width: 'auto', //auto or any width like 600px
                            fit: true   // 100% fit in a container
                        });
                    });
                </script>
                <div class="content_bottom">
                    <div class="heading">
                        <h3>Related Products</h3>
                    </div>
                    <div class="see">
                        <p><a href="#">See all Products</a></p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="section group">
                    <?php
                    foreach ($_SESSION['product_related'] as $item => $value){
                    ?>
                    <div class="grid_1_of_4 images_1_of_4">
                        <a href="product_controller.php?action=index&product=<?php echo $value['id']?>"><img src="<?php echo URL_FRONT_END?>/uploads/products/<?php echo $value['image']?>" alt=""></a>

                        <div class="price" style="border:none">
                            <p><?php echo $value['p_name']?></p>
                            <div class="add-cart" style="float:none">
                                <h4><a href="product_controller.php?action=index&product=<?php echo $value['id']?>">Add to Cart</a></h4>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

        </div>
            <div class="rightsidebar span_3_of_1 categories" style="width: 25%">
                <h2>CATEGORIES</h2>
                <ul >
                    <?php
                    foreach ($_SESSION['menu'] as $key => $value){
                        ?>
                        <li style="position: relative; width: 69%"><a  href="cate_controller.php?cate=index&cate_name=<?php echo $value['cate_tenkhongdau']?>"><?php
                                echo $value['cate_name'];
                                ?></a>
                            <ul class="sub-menu" style="position: absolute; left: 90%; top: 0;">
                                <?php
                                foreach ($_SESSION['sub-menu'] as $item => $smenu){
                                    if($smenu['id_categories'] == $value['id']){
                                        ?>
                                        <li><a style=" border: none" href="producttype_controller.php?producttype=index&cate_name=<?php echo $value['cate_tenkhongdau']?>&id=<?php echo $smenu['id']?>"><?php echo $smenu['pt_name'];}?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
                <div class="subscribe">
                    <h2>Newsletters Signup</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.......</p>
                    <div class="signup">
                        <form>
                            <input type="text" value="E-mail address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-mail address';"><input type="submit" value="Sign up">
                        </form>
                    </div>
                </div>
                <div class="community-poll">
                    <h2>Community POll</h2>
                    <p>What is the main reason for you to purchase products online?</p>
                    <div class="poll">
                        <form>
                            <ul>
                                <li>
                                    <input type="radio" name="vote" class="radio" value="1">
                                    <span class="label"><label>More convenient shipping and delivery </label></span>
                                </li>
                                <li>
                                    <input type="radio" name="vote" class="radio" value="2">
                                    <span class="label"><label for="vote_2">Lower price</label></span>
                                </li>
                                <li>
                                    <input type="radio" name="vote" class="radio" value="3">
                                    <span class="label"><label for="vote_3">Bigger choice</label></span>
                                </li>
                                <li>
                                    <input type="radio" name="vote" class="radio" value="5">
                                    <span class="label"><label for="vote_5">Payments security </label></span>
                                </li>
                                <li>
                                    <input type="radio" name="vote" class="radio" value="6">
                                    <span class="label"><label for="vote_6">30-day Money Back Guarantee </label></span>
                                </li>
                                <li>
                                    <input type="radio" name="vote" class="radio" value="7">
                                    <span class="label"><label for="vote_7">Other.</label></span>
                                </li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>
</div>


<?php
require_once '../views/footer.php';
?>
