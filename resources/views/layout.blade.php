<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nội thất Tiến Đạt</title>

    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet" type='text/css'>
    <link href="{{asset('public/frontend/fonts/font-awesome/css/font-awesome.min.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{asset('public/frontend/fonts/lovelo/stylesheet.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{asset('public/frontend/css/main.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{asset('public/frontend/css/owl.carousel.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{asset('public/frontend/css/owl.theme.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{asset('public/frontend/rs-plugin/css/settings.css')}}" rel="stylesheet" type='text/css'>
    <link href="{{asset('public/frontend/css/custom.css')}}" rel="stylesheet" type='text/css'>
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet" type='text/css'>
 

    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <?php
     $customer_id = Session::get('customer_id');
     $customer_address = Session::get('customer_address');
     $shipping_id = Session::get('shipping_id');
    // test
    //echo $customer_id;
    //echo $customer_address;
    //echo $shipping_id;

    ?>
    <!--Start class site-->
    <div class="tz-site">

        <!--Start id tz header-->
        <header id="tz-header" class="bk-white">
            <div class="container">
                <!--Start class header top-->
                <div class="header-top">
                    <ul class="pull-left">
                        <li>
                            <a href="javascript:void()">
                                Việt Nam
                                <span class="fa fa-angle-down tz-down"></span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void()">Liên hệ: 0964.618.627</a>
                        </li>
                    </ul>
                   <ul class="pull-right">
                   <?php $customer_id = Session::get('customer_id');
                        if($customer_id != NULL){
                            ?>
                        <li class="tz-header-login">
                           <a href="{{URL::to('/customer')}}">Tài Khoản</a>
                        </li>
                        <?php
                        }else { ?>
                        <li class="tz-header-login">
                             <a href="{{URL::to('/login-checkout')}}">Tài Khoản</a>
                        </li>
                        <?php }
                        ?>
                    
                        <?php
                                $customer_id = Session::get('customer_id');
                                $shipping_id = Session::get('shipping_id');
                                if($customer_id != null && $shipping_id != NULL)
                                {
                            ?>
                               <li><a href="{{URL::to('/payment')}}">Thanh Toán</a></li>
                            <?php
                                }else{
                            ?>
                            <li class="tz-header-login"><a href="{{URL::to('/login-checkout')}}">Thanh Toán</a></li>
                            <?php
                                }
                            ?>
                        <li>
                            <a href="{{URL::to('/show-cart')}}">Giỏ Hàng</a>
                        </li>
                        <?php $customer_id = Session::get('customer_id');
                        if($customer_id != NULL){
                            ?>
                        <li class="tz-header-login">
                           <a href="{{URL::to('/logout-checkout')}}">Đăng xuất</a>
                        </li>
                        <?php
                        }else { ?>
                        <li class="tz-header-login">
                             <a href="{{URL::to('/login-checkout')}}">Đăng nhập</a>
                        </li>
                        <?php }
                        ?>
                    </ul>
                </div>
                <!--End class header top-->

                <!--Start header content-->
                <div class="header-content">
                    <h3 class="tz-logo pull-left"><a href="{{URL::to('/trang-chu')}}"><img src="{{asset('public/frontend/img/logo.png')}}" alt="home" /></a></h3>
                    <div class="tz-search pull-right">

                        <!--Start form search-->
                        <form action="{{URL::to('/tim-kiem')}}" method="POST">
                           {{ csrf_field()}}
                            <input type="text" class="tz-query" id="tz-query" name="keywords_submit" value="" placeholder="Tìm kiếm sản phẩm">
                            <button type="submit"></button>
                        </form>
                        <!--End Form search-->

                        <!--live search-->
                        <div class="live-search">
                            
                        </div>
                        <!--End live search-->
                    </div>
                </div>
                <!--End class header content-->
            </div>

            <!--Start main menu -->
            <nav class="tz-menu-primary">
                <div class="container">
                <?php
                    $content = Cart::content();

                ?>
                    <!--Main Menu-->
                    <ul class="tz-main-menu pull-left nav-collapse">
                        <li>
                            <a href="{{URL::to('/trang-chu')}}">Trang chủ</a>
                           
                        </li>
                        <li>
                            <a href="javascript:void()">
                                Danh mục sản phẩm
                            </a>
                            <ul class="sub-menu">
                            @foreach($category as $key => $cate)
                                <li>
                                    <a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a>
                                </li>
                            @endforeach   
                               
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void()">
                               Thương hiệu sản phẩm
                            </a>
                            <ul class="sub-menu">
                            @foreach($brand as $key => $brand)    
                                <li>
                                    <a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_id)}}">{{$brand->brand_name}}</a>
                                </li>
                            @endforeach
                            </ul>
                        </li>
                       
                        
                        <li>
                            <a href="{{URL::to('/lien-he')}}">Liên hệ</a>
                        </li>
                    </ul>
                    <!--End Main menu-->

                    <!--Shop meta-->
                    <ul class="tz-ecommerce-meta pull-right">
                        <li class="tz-mini-cart">
                            <a href="{{URL::to('/show-cart')}}"> Giỏ hàng </a>

                            <!--Mini cart-->
                            <ul class="cart-inner">
                                 @foreach($content as $v_content)
                                <li class="mini-cart-content">
                               
                                    <div class="mini-cart-img"><img src="{{URL::to('public/upload/products/'.$v_content->options->image)}}" alt="product search one"></div>
                                    <div class="mini-cart-ds">
                                        <h6><a href="{{URL::to('chi-tiet-san-pham/'.$v_content->id)}}">{{$v_content->name}}</a></h6>
                                        <span class="mini-cart-meta">
                                            <a href="{{URL::to('chi-tiet-san-pham/'.$v_content->id)}}">{{number_format($v_content->price).' '.'VND'}} </a>
                                            <span class="mini-meta">
                                               <span class="mini-qty">{{$v_content->qty}}</span>
                                            </span>
                                        </span>
                                    </div>
                                    <span class="mini-cart-delete"><a href="{{URL::to('/delete-to-cart-home/'.$v_content->rowId)}}"><img src="public/frontend/img/delete.png" alt="delete"></a></span>
                                </li>
                                 @endforeach
                                <li class="mini-subtotal">
                                    <span class="subtotal-content">
                                        Tạm tính
                                        <strong class="pull-right"> {{(Cart::subtotal()).' '.'VND'}}</strong>
                                    </span>
                                </li>
                                <li class="mini-footer">
                                    <a href="{{URL::to('/show-cart')}}" class="view-cart">giỏ hàng</a>
                                    <?php
                                $customer_id = Session::get('customer_id');
                                $shipping_id = Session::get('shipping_id');
                                if($customer_id != NULL && $shipping_id != NULL) {
                                    ?>
                                    <a href="{{URL::to('/payment')}}" class="check-out">Thanh Toán</a>
                                   
                                </li>
                                <?php
                                }elseif($customer_id == NULL && $shipping_id == NULL){
                                ?>
                                <a href="{{URL::to('/register')}}" class="check-out">Thanh toán</a>
                                <?php
                                }
                                ?>
                            </ul>
                            <!--End mini cart-->

                        </li>
                    </ul>
                    <!--End Shop meta-->

                    <!--navigation mobi-->
                    <button data-target=".nav-collapse" class="btn-navbar tz_icon_menu" type="button">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!--End navigation mobi-->
                </div>
            </nav>
            <!--End stat main menu-->

        </header>
        <!--End id tz header-->

       @yield('content')

        <!--Start Footer-->
        <footer class="tz-footer">
            <div class="footer-widget">
                <div class="container">

                    <!--Start footer left-->
                    <div class="footer-left">
                        <div class="contact-info widget">
                            <h3 class="widget-title">Địa chỉ liên hệ</h3>
                            <p>Mọi chi tiết vui lòng liên hệ</p>
                            <ul>
                                <li>
                                    <span>Địa chỉ :</span>
                                    <address>
                                       Khóm 4 Thị trấn Cái Nhum, huyện Mang Thít, tỉnh Vĩnh Long 
                                    </address>
                                </li>
                                <li>
                                    <span>Phone :</span>
                                    0123 456 789
                                </li>
                                <li>
                                    <span>Email :</span>
                                    TD@gmail.com
                                </li>
                            </ul>
                        </div>
                       
                    </div>
                    <!--End footer left-->

                    <!--Start footer right-->
                    <div class="footer-right">
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="widget widget_nav_menu">
                                    <h3 class="widget-title">HOW TO BUY</h3>
                                    <ul>
                                        <li>
                                            <a href="#">Contact Us</a>
                                        </li>
                                       
                                        <li>
                                            <a href="#">Site Map</a>
                                        </li>
                                        <li>
                                            <a href="#">Brands</a>
                                        </li>
                                        <li>
                                            <a href="#">Gift Vouchers</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="widget widget_nav_menu">
                                    <h3 class="widget-title">MY ACCOUNT</h3>
                                    <ul>
                                        <li>
                                            <a href="#">My Account</a>
                                        </li>
                                        <li>
                                            <a href="#">Order History</a>
                                        </li>
                                        <li>
                                            <a href="#">Wish List</a>
                                        </li>
                                        <li>
                                            <a href="#">Specials</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="widget widget_nav_menu">
                                    <h3 class="widget-title">Infomation</h3>
                                    <ul>
                                        <li>
                                            <a href="#">About Us</a>
                                        </li>
                                        <li>
                                            <a href="#">Contact Us</a>
                                        </li>
                                        <li>
                                            <a href="#">Term & Conditions</a>
                                        </li>
                                        <li>
                                            <a href="#">Privacy Policy</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End footer right-->

                </div>
            </div>
            <div class="tz-copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <p>Copyright &copy; 2022 <a href="https://facebook.com" target="_blank">Facebook</a> </p>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="pull-right">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--End Footer-->

    </div>
    <!--End class site-->

    <script type='text/javascript' src="{{asset('public/frontend/js/jquery.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('public/frontend/js/off-canvas.js')}}"></script>    <!--jQuery Countdow-->
    <script type='text/javascript' src="{{asset('public/frontend/js/jquery.plugin.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('public/frontend/js/jquery.countdown.min.js')}}"></script>    <!--End Countdow-->
    <script type='text/javascript' src="{{asset('public/frontend/js/jquery.parallax-1.1.3.js')}}"></script>
    <script type='text/javascript' src="{{asset('public/frontend/js/owl.carousel.js')}}"></script>
    <script type='text/javascript' src="{{asset('public/frontend/js/custom.js')}}"></script>
    <script type='text/javascript' src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('public/frontend/rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('public/frontend/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('public/frontend/rs-plugin/js/custom-rs.js')}}"></script>
    
    <script type="text/javascript">
            $(document).ready(function(){
                $('#orderby').on('change', function(){
                    var url = $(this).val();
                    alert(url);
                    //if(url){
                    //    window.location = url;
                    //}
                    //return false;
                });
            });
    </script>

</body>
</html>