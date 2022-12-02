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
                        <?php $customer_id = Session::get('customer_id');
                                $customer_name = Session::get('customer_name');
                                $customer_phone = Session::get('customer_phone');
                                $customer_address = Session::get('customer_address');

                                $shipping_id = Session::get('shipping_id');
                                $shipping_address = Session::get('shipping_address');
                                
                            if($customer_id == null) {
                        
                        ?>

                          
                        <?php
                            } elseif($customer_id != null){
                        ?>
                        <div>
                            <h3 >Thông tin giao hàng</h3>
                            <div class= "pull-left">
                                 <select name = "shipping_address">
                                    @foreach ($shipping as $value => $key)
                                        <option value = "{{$key->shipping_address}}"> Khách hàng: {{$key->shipping_name}}  -  Số điện thoại: {{$key->shipping_phone}}  -  Địa chỉ: {{$key->shipping_address}}</option>
                                    @endforeach
                                </select>       
                            </div>  
                            <div class= "pull-right"> 
                                    <button style="float:right" class="btn-add-address" data-toggle="modal" data-target="#exampleModalCenter">Địa chỉ giao hàng khác</button>
                                    <div class="modal fade" id="exampleModalCenter">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Địa chỉ giao hàng mới</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                   
                                                <form action="{{URL::to('/save-checkout-customer')}}" method="POST">
                                                    <div class="shop-billing-fields">
                                                        <h3>1. Thông tin gửi hàng</h3>
                                                        {{csrf_field()}}
                                                        <label for="username">Họ và tên khách hàng<span class="required">*</span></label>
                                                        <p class="form-row form-row-wide">
                                                            <input type="text" class="input-text" name="name" value="">
                                                        </p>
                                                            
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
                                                                <textarea name="notes" style = " resize: none" class="input-text" id="order_comments" rows="2" cols="5" ></textarea>
                                                            </p>
                                                            
                                                            <button style="float:right" class="btn-add-address pull-right" type="submit">Lưu</button>
                                                           
                                                            <button type="button" class="update-cart-qty pull-left" data-dismiss="modal">đóng</button>
                                                           <!-- <button type="button" type="hidden"  class="btn-add-address pull-right" >lưu</button>-->
                                                         
                                                    </div>
                                                </form>
                                                    <div class="clear"></div>

                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            
                        </div>

                        <?php
                           }
                        ?>
                        <!--<form action="{{URL::to('/save-checkout-customer')}}" method="POST">
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
                                    <textarea name="notes" style = " resize: none" class="input-text" id="order_comments" rows="2" cols="5" ></textarea>
                                </p>
                                <button style="float:right" class="update-cart-qty" type="submit">Đi đến đặt hàng</button>

                            </div>
                        </form> -->

                        <!--End form checkout-->
                    

                    </div>
                   
        </section>

@endsection