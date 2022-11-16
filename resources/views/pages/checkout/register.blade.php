@extends('layout')
@section('content')
<section class="default-page">
        <div class="container">
            <div class="tz-register">
                <h2>Đăng ký</h2>

                <!--Start form-->
                <form action="{{URL::to('/add-customer')}}" method="post">
                    {{csrf_field()}}
                    <p class="form-row form-row-wide">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" class="input-text" name="phone" value="">
                    </p>
                    <p class="form-row form-row-wide">
                        <label for="password">Mật khẩu mới</label>
                        <input class="input-text" type="password" name="password">
                    </p>
                    <!-- <p class="form-row form-row-wide">
                        <label for="password">Nhập lại mật khẩu</label>
                        <input class="input-text" type="password" name="password">
                    </p> -->

                    <p class="form-row form-row-wide">
                        <label for="name">Họ và tên</label>
                        <input type="text" class="input-text" name="name" value="">
                    </p>
                    <p class="form-row form-row-wide">
                        <label for="address">Địa chỉ Giao Hàng</label>
                        <input type="text" class="input-text" name="address" value="">
                    </p>
                    
                    <p class="form-row">
                        <input type="submit" class="button" name="register" value="Đăng ký">
                    </p>
                </form>
                <!--End form-->

            </div>
        </div>
    </section>

@endsection