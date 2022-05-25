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
                            $message = Session::get('message');
                            if($message) {
                            echo '<span class="alert alert-success alert-dismissible fade show">'
                                ,$message, '</span>';
                                Session::put('message', null);
                            }
                        ?>
                
            <!--Start form table-->
            
            <form action= "{{url('/update-cart')}}" method="POST">
                {{ csrf_field() }}
                <table class="shop_table cart">
                    <colgroup>
						<col span="1" style="width: 10%">
						<col span="1" style="width: 15%">
						<col span="1" style="width: 30%">
						<col span="1" style="width: 15%">
						<col span="1" style="width: 15%">
						<col span="1" style="width: 15%">
					</colgroup>
                    <!--Table header-->
                    <thead>
                        <tr>
                            <th class="product-remove" scope="col">&nbsp;</th>
                            <th class="product-thumbnail" scope="col">Sản phẩm</th>
                            <th class="product-name" scope="col">Tên sản phẩm</th>
                            <th class="product-price" scope="col">Giá</th>
                            <th class="product-quantity" scope="col">Số lượng</th>
                            <th class="product-subtotal" scope="col">Thành Tiền</th>
                            
                        </tr>
                    </thead>
                    <!--End table header-->

                    <!--Table body-->
                    <tbody>
                    @if(Session::get('cart') == true )  
                    @php
                        $total = 0;
                    @endphp
                   
                        @foreach(Session::get('cart') as $key => $cart)
                        @php
                            $total = $total + $cart['product_quantity'] * $cart['product_price'];
                        @endphp

                            <tr class="cart_item">
                                <td class="product-remove">
                                    <a href="{{url('/delete-cart-product/'.$cart['session_id'])}}" class="remove" title="Xóa sản phẩm này"></a>
                                </td>
                                <td class="product-thumbnail">
                                    <a href=""><img src="{{asset('public/upload/products/'.$cart['product_image'])}}" width = "70" height = "70" /></a>
                                </td>

                                <td class="product-name">
                                    <a href=""> {{$cart['product_name']}} </a>
                                </td>
                                <td class="product-price">
                                    <span class="amount"> {{number_format($cart['product_price'],0,',','.')}} VND </span>
                                </td>
                               
                                    <td class="product-quantity">
                                    <div class="quantity"><input type="number" min="0" name="cart_quantity[{{$cart['session_id']}}]" value="{{$cart['product_quantity']}}" title="Số lượng" class="input-text qty text" size="4"></div>
                                   
                                    </td>
                             
                                <td class="product-subtotal">
                                    <span class="amount"> {{number_format($cart['product_quantity'] * $cart['product_price'] , 0,',','.')}} VND   </span>
                                </td>                           
                            </tr>
                           
                            <!-- <td class="actions" colspan="6">
                                
                            </td>--> 
                     @endforeach
                            <tr>
                                
                                <td colspan="5" style= "float:center; font-size: 20px; font-weight:300; ">Tổng tiền: </td>
                                <td colspan="1"><span style="font-size: 20px; font-weight:300; color:red"> {{number_format($total,0,',','.')}} VND </td>
                            </tr>
                            
                     
                            <tr>
                               
                                <td>&nbsp;</td>
                                <td><a href="{{url('/delete-all-product')}}" class="checkoutCustom" style="width: 200px">Xóa tất cả sản phẩm</a></td>
                                <td>&nbsp;</td>
                                <td><button class="update-cart-qty" type="submit" style="width: 200px">Cập nhật số lượng</button></td>
                                <td>&nbsp;</td> 
                                <td> <?php $customer_id = Session::get('customer_id');
                                    $shipping_id = Session::get('shipping_id');
                                    if($customer_id == NULL && $shipping_id != NULL){
                                    ?>
                                    <a href="{{URL::to('/register')}}" class="checkoutCustom">Thanh Toán</a>
                                    <?php  }elseif($customer_id != NULL && $shipping_id != NULL){ 
                                    ?>
                                    <a href="{{URL::to('/payment')}}" class="checkoutCustom">Thanh Toán</a>
                                    <?php
                                    }else { ?>                                           
                                    <a href="{{URL::to('/login-checkout')}}" class="checkoutCustom">Thanh Toán</a>
                                    <?php }
                                    ?></td>
                                
                            </tr>
                            @else 
                            <tr >
								<td colspan=5 >
                                <span style="font-size: 20px; font-weight:300; color:red">
                                    Không có sản phẩm
                                </td>
                                
							</tr>
                            @endif
                    </tbody>
                    <!--End table body--> 
                </table>
              </form>
        
            <!--End form table-->

          
           
        </div>
    </section>


@endsection