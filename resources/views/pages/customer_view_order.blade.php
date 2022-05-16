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

    <div class="content-body-custom">
            <div class="container-fluid">
                <div class="page-titles">
                    <div class = "row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class = "card-header">
                                <h2>Chi tiết đơn hàng</h2>
                                </div>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="home1" role="tabpanel">
                                    <div class="pt-4">


                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th>Tên Sản phẩm</th>
                                                <th>Số Lượng</th>
                                                <th>Giá</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                                
                                        @foreach($chitiet as $values)
                                            <?php $order_id = $values->order_id; ?>
                                            <tr>                                                
                                                <td>{{$values->product_name}}</td>
                                                <td>{{$values->product_quantity}}</td>
                                                <td>{{number_format($values->product_price).' '.'VND'}}</td>           
                                            </tr>
                                        @endforeach
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td >Mã đơn hàng: {{$values->order_id}}</td>

                                            </tr>
                                        </tbody>

                                    </table>
                                    <div style="float:right ; margin: 30px">  <a href="{{URL::to('/customer')}}" class="badge badge-info">Trở lại trang cá nhân</a> </div>
                                </div>
                            </div>
                        </div>
                    </div>                                   
                </div>
        </div>
    </div>
</div>

    <div class="footer">
        <div class="copyright">
                    
        </div>
    </div>
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