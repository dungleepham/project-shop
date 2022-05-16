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
     $customer_id = Session::get('customer_id');
     $customer_name = Session::get('customer_name');
     $customer_address = Session::get('customer_address');
     $customer_phone = Session::get('customer_phone');
     $customer_password = Session::get('customer_password');
     $shipping_id = Session::get('shipping_id');
    
    // test
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
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                        @foreach($thongtinKhach as $key => $val)
                            <div class="basic-form">
                                <form action="{{URL::to('/update-customer-info/'.$val->customer_id)}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Tên khách hàng</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="customer_name" value="{{$val->customer_name}}">
                                            </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Số điện thoại khách hàng</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="customer_phone" value="{{$val->customer_phone}}">
                                            </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Địa chỉ khách hàng</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="customer_address" value="{{$val->customer_address}}">
                                            </div>
                                    </div> 
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button name="add_product" type="submit" class="btn btn-primary">Cập nhật</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @endforeach
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