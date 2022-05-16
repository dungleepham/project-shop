@extends('layout')
@section('content')
<section class="default-page">
        <div class="container">
            <div class="tz-register">
                <h2>Đăng Nhập</h2>

                <!--Start form-->
                <form action="{{URL::to('/login-customer')}}" method="POST">
                    {{csrf_field()}}
                    <p class="form-row form-row-wide">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" class="input-text" name="phone" value="">
                    </p>
                    <p class="form-row form-row-wide">
                        <label for="password">Mật khẩu</label>
                        <input class="input-text" type="password" name="password">
                    </p>
                     <p class="form-row">
                        Chưa có tài khoản? <a href="{{URL::to('/register')}}"  style="color:red">Đăng ký</a>
                    </p>
                    <?php
                        $message = Session::get('message');
                        if($message) {
                        echo  '<span style = "color:red">' ,$message, '</span>' ;
                        Session::put('message', null);
                        }
                                        ?>
                    <p class="form-row">
                        <input type="submit" class="button" name="login" value="Đăng nhập">
                    </p>
                   
                </form>
                <!--End form-->

            </div>
        </div>
    </section>

@endsection