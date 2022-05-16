@extends('layout')
@section('content')


<section class="shop-checkout">
        <div class="container">
            <!--Start Breadcrumbs-->
            <ul class="tz-breadcrumbs">
                <li>
                    <a href="{{URL::to('/trang-chu')}}">Trang chủ</a>
                </li>
                <li class="current">
                    Giỏ hàng
                </li>
            </ul>
            <!--End Breadcrumbs-->
            <h1 class="page-title">Giỏ hàng</h1>


            <?php
            $content = Cart::content();

            ?>

            <!--Start form table-->
            
      
                <table class="shop_table cart">
                    <!--Table header-->
                    <thead>
                        <tr>
                            <th class="product-remove">&nbsp;</th>
                            <th class="product-thumbnail">Sản phẩm</th>
                            <th class="product-name">&nbsp;</th>
                            <th class="product-price">Giá</th>
                            <th class="product-quantity">Số lượng</th>
                            <th class="product-subtotal">Tổng</th>
                            
                        </tr>
                    </thead>
                    <!--End table header-->

                    <!--Table body-->
                    <tbody>
                       
                        @foreach($content as $v_content)

                            <tr class="cart_item">
                                <td class="product-remove">
                                    <a href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}" class="remove" title="Xóa sản phẩm này"></a>
                                </td>
                                <td class="product-thumbnail">
                                    <a href="{{URL::to('chi-tiet-san-pham/'.$v_content->id)}}"><img src="{{URL::to('public/upload/products/'.$v_content->options->image)}}" width = "70" height = "70" /></a>
                                </td>

                                <td class="product-name">
                                    <a href="{{URL::to('chi-tiet-san-pham/'.$v_content->id)}}"> {{$v_content->name}} </a>
                                </td>
                                <td class="product-price">
                                    <span class="amount">{{number_format($v_content->price).' '.'VND'}} </span>
                                </td>
                                 <form action= "{{URL::to('/update-cart-quantity')}}" method="POST">
                                    {{ csrf_field() }}
                                    <td class="product-quantity">
                                    <div class="quantity"><input type="number" min="0" name="cart" value="{{$v_content->qty}}" title="Số lượng" class="input-text qty text" size="4"></div>
                                    <input type="hidden" class="form-control" value="{{$v_content->rowId}}" name="rowId_cart">
                                    <button class="update-cart-qty" type="submit">Cập nhật</button>
                                    </td>
                               </form>
                                <td class="product-subtotal">
                                    <span class="amount"> <?php $subtotal = $v_content->price * $v_content->qty; echo number_format($subtotal).' '.'VND'; ?></span>
                                </td>                           
                            </tr>
                            <!-- <td class="actions" colspan="6">
                                
                            </td>--> 
                        @endforeach
                        
                    </tbody>
                    <!--End table body--> 
                </table>
            
            <br><hr>
            <!--End form table-->

            <!--Cart attr-->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <!--Cart totals-->
                    <div class="thanhtoan">
                        <div class="thanhtoan-inner">
                            <ul>
                            <li>Tổng tiền <span> {{(Cart::subtotal()).' '.'VND'}} </li>
                            </ul>
                             <?php $customer_id = Session::get('customer_id');
                                    $shipping_id = Session::get('shipping_id');
                                if($customer_id == NULL && $shipping_id != NULL){
                            ?>
                                <a href="{{URL::to('/register')}}">Thanh Toán</a>
                            <?php  }elseif($customer_id != NULL && $shipping_id != NULL){ 
                            ?>
                            <a href="{{URL::to('/payment')}}">Thanh Toán</a>
                            <?php
                                }else { ?>                                           
                                <a class="" href="{{URL::to('/login-checkout')}}">Thanh Toán</a>
                            <?php }
                            ?>
                        </div>  
                    </div>
                       <!--<div>
                            <table>
                                <tbody>
                                    <form action="{{URL::to('/login-checkout')}}"  method="get">
                                        <tr class="order-total">
                                            <th>Tổng tiền</th>
                                            <td><span class="amount">{{(Cart::subtotal()).' '.'VND'}}</span></td>
                                        </tr>
                                        <tr>
                                       
                                        </tr>
                                    </form>
                                </tbody>
                            </table>
                        </div>-->
                
            </div>
            <!--End cart attr-->
           
        </div>
    </section>


@endsection