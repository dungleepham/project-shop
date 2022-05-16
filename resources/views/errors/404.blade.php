<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Lỗi</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/backend/img/favicon.png')}}">
    <link href="{{asset('public/backend/css/style.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-8">
                    <div class="form-input-content text-center error-page">
                        <h1 class="error-text font-weight-bold">404</h1>
                        <h4><i class="fa fa-exclamation-triangle text-warning"></i> Trang bạn tìm kiếm không tồn tại!</h4>
                        <p>Bạn có thể đã nhập sai địa chỉ hoặc trang có thể đã bị di chuyển.</p>
						<div>
                            <a class="btn btn-primary" href="{{URL::to('/trang-chu')}}">Trở lại trang chủ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
<script src="{{asset('public/backend/vendor/global/global.min.js')}}"></script>
<script src="{{asset('public/backend/js/custom.min.js')}}"></script>
<script src="{{asset('public/backend/js/deznav-init.js')}}"></script>

</html>