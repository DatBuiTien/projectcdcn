<?php
/**
 * Created by PhpStorm.
 * User: Bui Tien Dat
 * Date: 12-Apr-17
 * Time: 3:35 PM
 */
require_once '../configs/config.php';
?>
<!DOCTYPE HTML>
<head>
    <title>Free Home Shoppe Website Template | Home :: w3layouts</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="<?php echo URL_FRONT_END;?>/views/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="<?php echo URL_FRONT_END?>/views/css/slider.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="<?php echo URL_FRONT_END?>/views/css/global.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="<?php echo URL_FRONT_END?>/views/css/easy-responsive-tabs.css" rel="stylesheet" type="text/css" media="all"/>

    <style type="text/css">
        .categories .sub-menu{
            display: none;
            left: 260px;
            position: absolute;

        }
        .categories ul li:hover .sub-menu{
            display: block;
        }

        .grid_1_of_4:first-child {
        }

        .images_1_of_4 {
            width: 20.4%;
            padding: 1.5%;
            text-align: center;
            position: relative;
        }

        .images_1_of_4 h2{
            height: 40px;
        }

        #products .next{
            left:290px;
        }

        table .order, .order th, .order td{
            border: 1px solid #EBE8E8;
            border-collapse: collapse;
            padding: 5px;
        }

        .order th{
           font-size: 20px;
            text-transform: capitalize;
        }

        .order td{
            color: #2A5C86;
        }



    </style>

    <script type="text/javascript" src="<?php echo URL_FRONT_END?>/views/js/function.js"></script>
    <script type="text/javascript" src="<?php echo URL_FRONT_END?>/views/js/jquery.accordion.js"></script>
    <script type="text/javascript" src="<?php echo URL_FRONT_END?>/views/js/jquery.easing.js"></script>
    <script type="text/javascript" src="<?php echo URL_FRONT_END?>/views/js/script.js"></script>
    <script type="text/javascript" src="<?php echo URL_FRONT_END?>/views/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo URL_FRONT_END?>/views/js/move-top.js"></script>
    <script type="text/javascript" src="<?php echo URL_FRONT_END?>/views/js/easing.js"></script>
    <script type="text/javascript" src="<?php echo URL_FRONT_END?>/views/js/startstop-slider.js"></script>
    <script src="<?php echo URL_FRONT_END?>/views/js/easyResponsiveTabs.js" type="text/javascript"></script>
    <script src="<?php echo URL_FRONT_END?>/views/js/slides.min.jquery.js"></script>

    <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->

    <script>
        /*$( function() {
            $( "#daterequired" ).datepicker({
                dateFormat: "yy-mm-dd"
            });
        } );
*/

    </script>

    <script>
        $(function(){
            $('#products').slides({
                preload: true,
                preloadImage: 'img/loading.gif',
                effect: 'slide, fade',
                crossfade: true,
                slideSpeed: 350,
                fadeSpeed: 500,
                generateNextPrev: true,
                generatePagination: false
            });
        });
    </script>


</head>
<body>
<div class="wrap">
    <div class="header">
        <div class="headertop_desc">
            <div class="call">
                <p><span>Need help?</span> call us <span class="number">1-22-3456789</span></span></p>
            </div>
            <div class="account_desc">
                <ul>
                    <li><a href="#">Register</a></li>
                    <li><a href="#">Login</a></li>
                    <li><a href="index_controller.php?action=showCard">Show cart</a></li>
                    <li><a href="#">My Account</a></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div class="header_top">
            <div class="logo">
                <a href="index_controller.php?action=index"><img src="<?php echo URL_FRONT_END?>/views/images/logo.png" alt="" /></a>
            </div>
            <div class="cart">
                <p>Welcome to our Online Store! <span>Cart:</span><div id="dd" class="wrapper-dropdown-2"> <?php
                    if(isset($_SESSION['card']['card_count'])){echo $_SESSION['card']['card_count'];}
                    else{ echo '0';
                    } ?> item(s) - <?php if(isset($_SESSION['total'])){echo number_format($_SESSION['total']);}else{
                        echo '0 VND';
                    }?>
                    <ul class="dropdown">
                        <li><a href="index_controller.php?action=showCard"> <?php if(!isset($_SESSION['card']['card_count']) or $_SESSION['card']['card_count']==0 ) {
                            echo 'You have no items in your Shopping cart';
                        }else{
                            echo 'You have '.$_SESSION['card']['card_count'].' items in your Shopping cart';
                            } ?></a></li>
                    </ul></div></p>
            </div>
            <script type="text/javascript">
                /*var d = document.getElementById("dd");
                d.className+=' active' ;
*/
                $(document).ready(function(){
                    $("#dd").click(function(){
                        $("#dd").toggleClass("active");
                    });
                });
                function DropDown(el) {
                    this.dd = el;
                    this.initEvents();
                }
                DropDown.prototype = {
                    initEvents : function() {
                        var obj = this;

                        obj.dd.on('click', function(event){
                            $(this).toggleClass('active');
                            event.stopPropagation();
                        });
                    }
                }

                $(function() {

                    var dd = new DropDown( $('#dd') );

                    $(document).click(function() {
                        // all dropdowns
                        $('.wrapper-dropdown-2').removeClass('active');
                    });

                });

            </script>
            <div class="clear"></div>
        </div>
        <div class="header_bottom">
            <div class="menu">
                <ul>
                    <li class="active"><a href="index_controller.php?action=index">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="delivery.html">Delivery</a></li>
                    <li><a href="news.html">News</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <div class="clear"></div>
                </ul>
            </div>
            <div class="search_box">
                <form action="index_controller.php">
                    <input type="hidden" name="action" value="search">
                    <input name="search_data" type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
                    <input type="submit" value="">
                </form>
            </div>
            <div class="clear"></div>
        </div>
