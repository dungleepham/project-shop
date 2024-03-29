<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/backend/img/favicon.png')}}">
	<link rel="stylesheet" href="public/backend/vendor/chartist/css/chartist.min.css">
    <link href="{{asset('public/backend/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/backend/vendor/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('public/backend/css/style.css')}}" rel="stylesheet">
    <script src="{{asset('public/backend/vendor/jquery/jquery.min.js')}}"></script>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

       

        <!--**********************************
            Nav header start
        ***********************************--> 

        <div class="nav-header">  
            <a href="{{asset('/dashboard')}}" class="brand-logo">
                <img class="logo-abbr"       src="{{asset('public/backend/img/logo.png')}}" alt="">
                <img class="logo-compact"    src="{{asset('public/backend/img/logo-text.png')}}" alt="">
                <img class="brand-title"     src="{{asset('public/backend/img/logo-text.png')}}" alt="">
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

		
		<!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
								Dashboard
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
                                    <?php
                                       $admin_name = Session::get('admin_name');
                                      
                                    ?>
                                    <img src="{{asset('/public/frontend/img/avata.jpg')}}" width="20" alt=""/>
									 <div class="header-info">
										<span class="text-black"><strong>{{$admin_name}}</strong></span>
										<p class="fs-12 mb-0">Admin</p>
									</div> 
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{{URL::to('/logout')}}" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ml-2">Đăng xuất</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
                   
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-networking"></i>
							<span class="nav-text">Đơn hàng</span>
						</a>
                         <ul class="sub">
                            <li><a href="{{URL::to('/manage-order')}}">Đơn hàng chờ</a></li>
							<li><a href="{{URL::to('/view-confirm-order')}}">Đơn hàng đã xác nhận</a></li>
                            <li><a href="{{URL::to('/view-received-order')}}">Đơn hàng đã giao</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-networking"></i>
							<span class="nav-text">Danh mục sản phẩm</span>
						</a>
                         <ul class="sub">
                            <li><a href="{{URL::to('/add-category-product')}}">Thêm danh mục sản phẩm</a></li>
							<li><a href="{{URL::to('/all-category-product')}}">Liệt kê danh mục sản phẩm</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-networking"></i>
							<span class="nav-text">Thương hiệu sản phẩm</span>
						</a>
                         <ul class="sub">
                            <li><a href="{{URL::to('/add-brand-product')}}">Thêm thương hiệu sản phẩm</a></li>
							<li><a href="{{URL::to('/all-brand-product')}}">Liệt kê thương hiệu sản phẩm</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-networking"></i>
							<span class="nav-text">Sản phẩm</span>
						</a>
                         <ul class="sub">
                            <li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
							<li><a href="{{URL::to('/all-product')}}">Liệt kê sản phẩm</a></li>
                            <li><a href="{{URL::to('/import-product')}}">Nhập hàng</a></li>
                        </ul>
                    </li>
                </ul>
				
			</div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
	
		@yield('admin_content')


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
    <script src="{{asset('public/backend/vendor/chart.js/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('public/backend/js/plugins-init/chartjs-init.js')}}"></script>
	
	<!-- Dashboard 1 -->
	<script src="{{asset('public/backend/js/dashboard/dashboard-1.js')}}"></script>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
	

<script type="text/javascript">
  $(document).ready(function() {
    setStatistic();
    function setStatistic(){
      var _token = $('input[name="_token"]').val();
      console.log(_token)
      $.ajax({
        url: '{{url('/load_statistic')}}',
        method: "POST",
        dataType: 'JSON',
        data:{_token:_token},
        success:function(data){
            const ctx = $('#myChart');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Số đơn hàng',
                        data: data.series,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
      });
    }
  });
</script>
</body>
</html>