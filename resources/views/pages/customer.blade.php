<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Khách hàng</title>
    <!-- Favicon icon -->

    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/backend/img/favicon.png')}}">
	<link rel="stylesheet" href="public/backend/vendor/chartist/css/chartist.min.css">
    <link href="{{asset('public/backend/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/backend/vendor/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('public/backend/css/style.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>

	<div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

	
       <!--**********************************
            Content body start
        ***********************************-->
        <?php
         // test
            $customer_id = Session::get('customer_id');
            $customer_name = Session::get('customer_name');
            $customer_address = Session::get('customer_address');
            $customer_phone = Session::get('customer_phone');
            $customer_password = Session::get('customer_password');
            $shipping_id = Session::get('shipping_id');
            //echo $customer_id;
            //echo $customer_address;
            //echo $shipping_id;
        ?>
        <div class="content-body-custom">
            <div class="container-fluid">
                <div class="page-titles">
					
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="profile card card-body px-3 pt-3 pb-0">
                            <div class="profile-head">
                                <div class="photo-content">
                                    <div class="cover-photo"><img src="public/frontend/img/background_cus.jpg" height="400px" width="1970px"  alt=""> </div>
                                    
                                </div>
                                <div class="profile-info">
                                    <div class="profile-photo">
										<img src="public/frontend/img/avata.jpg" height="300px" width="300px" class="img-fluid rounded-circle" alt="">
									</div>
									<div class="profile-details">
                                    @foreach($thongtinKhach as $key => $values)
                                    
										<div class="profile-name px-3 pt-2">
                                            <p>Tên Khách hàng</p>
											<h4 class="text-primary mb-0">{{$values->customer_name}}</h4>
										</div>
										<div class="profile-email px-2 pt-2">
											<p>Số điện thoại</p>
                                            <h4 class="text-muted mb-0">{{$values->customer_phone}}</h4>
										</div>
                                    @endforeach    
									</div>
                                    <div class="bootstrap-badge" style="float:right">
                                        <a href="{{URL::to('/trang-chu')}}" class="badge badge-secondary">Trở lại trang chủ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                        <div class="card">
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <div class="custom-tab-1">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#home1"><i class="la la-home mr-2"></i>Trang cá nhân</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#profile1"><i class="la la-user mr-2"></i>Thông tin cá nhân</a>
                                        </li>
                                        
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="home1" role="tabpanel">
                                            <div class="pt-4">
                                                <h4>Đơn hàng của tôi</h4>
                                                
                                            <table class="table table-responsive-md">
                                                <thead>
                                                    <tr>

                                                        <th>Mã đơn hàng</th>
                                                        <th>Tổng giá tiền</th>
                                                        <th>Tình trạng</th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>                                                
                                                @foreach($donhang as $key => $order)
                                                    <tr>                                               
                                                        <td><div> <span class="w-space-no" style="color:black">{{$order->order_id}}</span></div></td>
                                                        <td><div> <span class="w-space-no" style="color:black">{{$order->order_total}} VND</span></div></td>
                                                        <td><div> <span class="w-space-no" style="color:black">{{$order->order_status}}</span></div></td>  
                                                        <td>
                                                            <div class="d-flex">
														        <a href="{{URL::to('/customer-details-order/'.$order->order_id)}}" class="badge badge-info">Xem đơn</a>
													        </div>
                                                        </td>
                                                        <td>
                                                            @if($order->order_status == 'Đã đặt hàng')
													        <div class="d-flex">
                                                                <a onclick="return confirm('Bạn muốn xóa đơn hàng này?')" href="{{URL::to('/customer-delete-order/'.$order->order_id)}}" class="badge badge-danger">Xóa đơn</i></a>
													        </div>
                                                            @endif
												        </td>
                                                        <td>
                                                            @if($order->order_status != 'Đã nhận được hàng')
                                                            <div class="d-flex">
														        <a href="{{URL::to('/customer-received-order/'.$order->order_id)}}" class="badge badge-success">Đã nhận đơn</a>
													        </div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach    
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>

                                       
                                        
                                        <div class="tab-pane fade" id="profile1">
                                            <div class="pt-4">                                               
                                                <table class="table table-responsive-md">
                                                    <thead>
                                                        <tr>                                                            
                                                            <th>Tên khách hàng</th>
                                                            <th>Số điện thoại khách hàng</th>
                                                            <th>Địa chỉ khách hàng</th>
                                                            <th>&nbsp;</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>                                                
                                                    @foreach($thongtinKhach as $key => $values)
                                                        <tr>                                                             
                                                            <td><div> <span class="w-space-no" style="color:black">{{$values->customer_name}}</span></div></td>
                                                            <td><div> <span class="w-space-no" style="color:black">{{$values->customer_phone}}</span></div></td>
                                                            <td><div> <span class="w-space-no" style="color:black">{{$values->customer_address}}</span></div></td>
                                                           <td><a href="{{URL::to('/edit-customer-info/'.$values->customer_id)}}" class="badge badge-secondary">Chỉnh sửa</a></td>
                                                        </tr>
                                                    @endforeach    
                                                    </tbody>
                                                </table>
                                       
                                            </div>
                                        </div>
                                        
                                    
                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


<!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                    
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('public/backend/vendor/global/global.min.js')}}"></script>
	<script src="{{asset('public/backend/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
	<script src="{{asset('public/backend/vendor/chart.js/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('public/backend/js/custom.min.js')}}"></script>
	<script src="{{asset('public/backend/js/deznav-init.js')}}"></script>
	<script src="{{asset('public/backend/vendor/owl-carousel/owl.carousel.js')}}"></script>
	
	<!-- Chart piety plugin files -->
    <script src="{{asset('public/backend/vendor/peity/jquery.peity.min.js')}}"></script>
	
	<!-- Apex Chart -->
	<script src="{{asset('public/backend/vendor/apexchart/apexchart.js')}}"></script>
	
	<!-- Dashboard 1 -->
	<script src="{{asset('public/backend/js/dashboard/dashboard-1.js')}}"></script>
	
	<script>
		function carouselReview(){
			/*  event-bx one function by = owl.carousel.js */
			jQuery('.event-bx').owlCarousel({
				loop:true,
				margin:30,
				nav:true,
				center:true,
				autoplaySpeed: 3000,
				navSpeed: 3000,
				paginationSpeed: 3000,
				slideSpeed: 3000,
				smartSpeed: 3000,
				autoplay: false,
				navText: ['<i class="fa fa-caret-left" aria-hidden="true"></i>', '<i class="fa fa-caret-right" aria-hidden="true"></i>'],
				dots:true,
				responsive:{
					0:{
						items:1
					},
					720:{
						items:2
					},
					
					1150:{
						items:3
					},			
					
					1200:{
						items:2
					},
					1749:{
						items:3
					}
				}
			})			
		}
		jQuery(window).on('load',function(){
			setTimeout(function(){
				carouselReview();
			}, 1000); 
		});
	</script>
</body>
</html>