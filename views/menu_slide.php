<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 12-Apr-17
 * Time: 3:39 PM
 */
?>
<div class="header_slide">
    <div class="header_bottom_left">
        <div class="categories">
            <ul>
                <h3>Categories</h3>
                <?php
                    foreach ($_SESSION['menu'] as $key => $value){
                ?>
                <li style="position: relative; width: 65%"><a href="cate_controller.php?cate=index&cate_name=<?php echo $value['cate_tenkhongdau']?>"><?php
                        echo $value['cate_name'];
                        ?></a>
                    <ul class="sub-menu" style="position: absolute; top:0; width: 100%; left: 155px">
                        <?php
                            foreach ($_SESSION['sub-menu'] as $item => $smenu){
                                if($smenu['id_categories'] == $value['id']){
                        ?>
                            <li><a style="border: none; margin: 0 0" href="producttype_controller.php?producttype=index&cate_name=<?php echo $value['cate_tenkhongdau']?>&id=<?php echo $smenu['id']?>"><?php echo $smenu['pt_name'];}?></a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
                <!--<li><a href="#">Desktop</a>
                    <ul class="sub-menu">
                        <li><a href="#">Dell</a></li>
                        <li><a href="#">Asus</a></li>
                        <li><a href="#">Vaio</a></li>
                    </ul>
                </li>
                -->
            </ul>
        </div>
    </div>
    <div class="header_bottom_right">
        <div class="slider">
            <div id="slider">
                <div id="mover">
                    <div id="slide-1" class="slide">
                        <div class="slider-img">
                            <a href="preview.html"><img src="<?php echo URL_FRONT_END?>/views/images/slide-1-image.png" alt="learn more" /></a>
                        </div>
                        <div class="slider-text">
                            <h1>Clearance<br><span>SALE</span></h1>
                            <h2>UPTo 20% OFF</h2>
                            <div class="features_list">
                                <h4>Get to Know More About Our Memorable Services Lorem Ipsum is simply dummy text</h4>
                            </div>
                            <a href="preview.html" class="button">Shop Now</a>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="slide">
                        <div class="slider-text">
                            <h1>Clearance<br><span>SALE</span></h1>
                            <h2>UPTo 40% OFF</h2>
                            <div class="features_list">
                                <h4>Get to Know More About Our Memorable Services</h4>
                            </div>
                            <a href="preview.html" class="button">Shop Now</a>
                        </div>
                        <div class="slider-img">
                            <a href="preview.html"><img src="<?php echo URL_FRONT_END?>/views/images/slide-3-image.jpg" alt="learn more" /></a>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="slide">
                        <div class="slider-img">
                            <a href="preview.html"><img src="<?php echo URL_FRONT_END?>/views/images/slide-2-image.jpg" alt="learn more" /></a>
                        </div>
                        <div class="slider-text">
                            <h1>Clearance<br><span>SALE</span></h1>
                            <h2>UPTo 10% OFF</h2>
                            <div class="features_list">
                                <h4>Get to Know More About Our Memorable Services Lorem Ipsum is simply dummy text</h4>
                            </div>
                            <a href="preview.html" class="button">Shop Now</a>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
</div>
</div>
