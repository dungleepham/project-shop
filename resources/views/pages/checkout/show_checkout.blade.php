@extends('layout')
@section('content')

<section class="shop-cart">
            <div class="container">
                <!--Start Breadcrumbs-->
                <ul class="tz-breadcrumbs">
                <li>
                    <a href="{{URL::to('/trang-chu')}}">Trang chủ</a>
                </li>
                <li class="current">
                   Thanh toán
                </li>
            </ul>
                <!--End Breadcrumbs-->
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-title">Thanh toán</h1>
                        <!--Start form checkout-->
                        <form action="{{URL::to('/save-checkout-customer')}}" method="POST">
                            {{csrf_field()}}
                            <div class="shop-billing-fields">
                                <h3>1. Thông tin gửi hàng</h3>
                                <p class="form-row form-row-wide">
                                    <label for="username">Họ và tên khách hàng<span class="required">*</span></label>
                                    <input type="text" class="input-text" name="name" value="">
                                </p>
                                <div class="clear"></div>
                                <p class="form-row">
                                    <label for="address">Địa chỉ khách hàng<span class="required">*</span></label>
                                    <input type="text" class="input-text " name="address" id="address" placeholder="" value="">
                                </p>
                                <div class="clear"></div>
                                <p class="form-row form-row-wide">
                                    <label for="phone">Số điện thoại<span class="required">*</span></label>
                                    <input type="text" class="input-text " name="phone" id="phone" placeholder="" value="">
                                </p>
                                <div class="clear"></div>
                                <p class="form-row notes">
                                    <label for="order_comments" class="">Ghi chú đơn hàng</label>
                                    <textarea name="notes" class="input-text " id="order_comments" rows="2" cols="5"></textarea>
                                </p>
                                <button style="float:right" class="update-cart-qty" type="submit">Đi đến đặt hàng</button>

                            </div>
                        </form>
                        <!--End form checkout-->

                    </div>
                    
                </div>

            </div>
        </section>

@endsection