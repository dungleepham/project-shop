<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nội thất Tiến Đạt</title>

     <script type='text/javascript' src="{{asset('public/frontend/js/jquery.min.js')}}"></script>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet" type='text/css'>
    <link href="{{asset('public/frontend/font/font-awesome/css/font-awesome.min.css')}}" rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
   
    <link href="{{asset('public/frontend/css/owl.carousel.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{asset('public/frontend/css/owl.theme.css')}}" rel='stylesheet' type='text/css'>
    <link href="{{asset('public/frontend/rs-plugin/css/settings.css')}}" rel="stylesheet" type='text/css'>
    <link href="{{asset('public/frontend/rs-plugin/css/settings-ie8.css')}}" rel="stylesheet" type='text/css'>
    <link href="{{asset('public/frontend/css/custom.css')}}" rel="stylesheet" type='text/css'>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
   
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

<?php
                    $content = Cart::content();
                    
                    $ajax_content = Session::get('cart');
                    


                ?>
    <!--Start class site-->
    <div class="tz-site">

        <!--Start id tz header-->
        <header id="tz-header" class="bk-white">
            <div class="container">
                <!--Start class header top-->
                <div class="header-top">
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
                                //$shipping_id = Session::get('shipping_id');
                                
                                if($customer_id != null) // && $shipping_id != NULL)
                                { if(Session::get('cart') == true){
                            ?>
                               <li><a href="{{URL::to('/payment')}}">Thanh Toán</a></li>
                            <?php
                                }}else{
                            ?>
                            <li class="tz-header-login"><a href="{{URL::to('/login-checkout')}}">Thanh Toán</a></li>
                            <?php
                                }
                            ?>
                        <li>
                            <a href="{{URL::to('/show-cart-ajax')}}">Giỏ Hàng</a>
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
                    <h3 class="tz-logo"><a href="{{URL::to('/trang-chu')}}"><img src="{{asset('public/frontend/img/logo.png')}}" alt="home" /></a></h3>
                    <div class="tz-search pull-right">

                        <!--Start form search-->
                        <form action="{{URL::to('/tim-kiem')}}" method="POST" id="form-search">
                           {{ csrf_field()}}
                           
                            <input type="text" class="tz-query" id="tz-query" name="keywords_submit" value="" placeholder="Tìm kiếm sản phẩm">
                            <button type="submit" ></button>
                           
                            <i class = "fa fa-microphone" id="voice-search"></i> 
                           
                        </form>
                        
                        <!--End Form search-->
                    </div>
                   
                </div>
                <!--End class header content-->
            </div>

            <!--Start main menu -->
            <nav class="tz-menu-primary">
                <div class="container">

                
                <?php
                    $content = Cart::content();
                    
                    $ajax_content = Session::get('cart');
                    


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
                            <a href="{{URL::to('/show-cart-ajax')}}"> Giỏ hàng </a>
                            <div id="Customer"></div>

                            <!--Mini cart-->
                            <ul class="cart-inner">
                            @if(Session::get('cart') == true )  
                                <?php
                                    $total = 0;
                                    ?>
                                 @foreach($ajax_content as $key => $v_content)
                                 <?php
                                    $total = $total + $v_content['product_quantity'] * $v_content['product_price'];
                                 ?>
                                <li class="mini-cart-content">
                               
                                    <div class="mini-cart-img"><img src="{{URL::to('public/upload/products/'.$v_content['product_image'])}}" alt="product search one"></div>
                                    <div class="mini-cart-ds">
                                        <h6><a href="{{URL::to('chi-tiet-san-pham/'.$v_content['product_id'])}}">{{$v_content['product_name']}}</a></h6>
                                        <span class="mini-cart-meta">
                                            <a href="{{URL::to('chi-tiet-san-pham/'.$v_content['product_id'])}}">{{number_format($v_content['product_price']).' '.'VND'}} </a>
                                            <span class="mini-meta">
                                               <span class="mini-qty">Số Lượng: {{$v_content['product_quantity']}}</span>
                                            </span>
                                        </span>
                                    </div>
                                    <span class="mini-cart-delete"><a href="{{URL::to('/delete-cart-product/'.$v_content['session_id'])}}"><img src="{{asset('public/frontend/img/delete.png')}}" alt="delete"></a></span>
                                </li>
                                 @endforeach
                                <li class="mini-subtotal">
                                    <span class="subtotal-content">
                                        Tạm tính
                                        <strong class="pull-right"> {{number_format($total).' '.'VND'}}</strong>
                                    </span>
                                </li>
                                <li class="mini-footer">
                                    <a href="{{URL::to('/show-cart-ajax')}}" class="view-cart">giỏ hàng</a>
                                    <?php
                                $customer_id = Session::get('customer_id');
                                //$shipping_id = Session::get('shipping_id');
                                if($customer_id != NULL) {// && $shipping_id != NULL) {
                                    ?>
                                    <a href="{{URL::to('/payment')}}" class="check-out">Thanh Toán</a>
                                   
                                </li>
                                <?php
                                }elseif($customer_id == NULL){// && $shipping_id == NULL){
                                ?>
                                <a href="{{URL::to('/login-checkout')}}" class="check-out">Thanh toán</a>
                                <?php
                                }
                                ?>
                               
                                @endif
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
                                    <h3 class="widget-title">Cách mua hàng</h3>
                                    <ul>
                                        <li>
                                            <a href="#">Liên hệ</a>
                                        </li>
                                       
                                        <li>
                                            <a href="#">Bản đồ</a>
                                        </li>
                                        <li>
                                            <a href="#">Thương hiệu</a>
                                        </li>
                                        <li>
                                            <a href="#">Mã giảm giá</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="widget widget_nav_menu">
                                    <h3 class="widget-title">Tài khoản</h3>
                                    <ul>
                                        <li>
                                            <a href="#">Tài khoản của tôi</a>
                                        </li>
                                        <li>
                                            <a href="#">Lịch sử mua hàng</a>
                                        </li>
                                        <li>
                                            <a href="#">Yêu thích</a>
                                        </li>
                                        <li>
                                            <a href="#">Đặc biệt</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="widget widget_nav_menu">
                                    <h3 class="widget-title">Thông tin</h3>
                                    <ul>
                                        <li>
                                            <a href="#">Chúng tôi</a>
                                        </li>
                                        <li>
                                            <a href="#">Liên hệ</a>
                                        </li>
                                        <li>
                                            <a href="#">Điều khoản & Điều kiện</a>
                                        </li>
                                        <li>
                                            <a href="#">Chính sách bảo mật</a>
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

    
    <script type='text/javascript' src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('public/frontend/js/off-canvas.js')}}"></script>    
    <script type='text/javascript' src="{{asset('public/frontend/js/jquery.plugin.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('public/frontend/js/jquery.countdown.min.js')}}"></script> 
    <script type='text/javascript' src="{{asset('public/frontend/js/jquery.parallax-1.1.3.js')}}"></script>
    <script type='text/javascript' src="{{asset('public/frontend/js/owl.carousel.js')}}"></script>
    <!-- <script type='text/javascript' src="{{asset('public/frontend/js/custom.js')}}"></script> -->
    <script type='text/javascript' src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('public/frontend/rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('public/frontend/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>
    <script type='text/javascript' src="{{asset('public/frontend/rs-plugin/js/custom-rs.js')}}"></script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $('.add_cart').click(function(){
                var id = $(this).data('id');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var _token = $('input[name = "_token"]').val();
                
                $.ajax({
                        url:' {{url('/add-cart-ajax')}}',
                        method: 'POST',
                        dataType: 'JSON',
                        data: { cart_product_id:cart_product_id, 
                                cart_product_name:cart_product_name,
                                cart_product_image:cart_product_image,
                                cart_product_price:cart_product_price,
                                cart_product_quantity:cart_product_quantity,
                                _token:_token} , 
                                success:function(data){
                                if(data.error==0){    
                                    swal({
                                        title: "",
                                        text: "Đã thêm vào giỏ", 
                                        type: "success",
                                        timer: 1e3,
                                        showConfirmButton: !1
                                    })
                                }else{
                                    swal({
                                        title: "",
                                        text: "Số lượng tồn không đủ", 
                                        type: "error",
                                        timer: 1e3,
                                        showConfirmButton: !1
                                        });
                                }
                              
                            }

                });


            });
        });
    </script>

<script type="text/javascript">
        $(document).ready(function(){
            $('#orderby').on('change',function(){
                var url = $(this).val();
                // alert(url);
                if (url) {
                    window.location = url;

                }
            return false;
           
            });
        });
</script>

<!--voice search-->

<script>
    let mic = document.getElementById('voice-search');
    const search = document.querySelector(".tz-query");
    const formSearch = document.querySelector("#form-search");
    const searchInput = search.querySelector('#tz-query'); 
    

    mic.onclick = ()=>{
        mic.classList.add('record');
        let recognization = new webkitSpeechRecognition;
        recognization.lang = 'vi';
        recognization.start();
        recognization.onresult = e=>{
            const result1 = event.results[0][0].transcript;
           // alert(result1);
            document.getElementById("tz-query").value = result1;
            formSearch.submit();
            mic.classList.remove('record');
        }
    }

</script>




<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6389b83fdaff0e1306da8f41/1gj8vfeun';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

</body>
</html>