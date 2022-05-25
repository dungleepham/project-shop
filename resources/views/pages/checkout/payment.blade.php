@extends('layout')
@section('content')

<div class="col-md-12">

<!--Order review-->

<?php
$content = Cart::content();
$ajax_content = Session::get('cart');
?>
<div id="order_review">
    <h3>Đơn hàng của bạn</h3>
    <!--Shop table-->
    <table class="shop_table">
        <thead>
            <tr>
                <th class="product-name">Sản phẩm</th>
                <th class="product-quantity" style="float:center">Số lượng</th>
                <th class="product-total">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @if(Session::get('cart') == true )  
            @php
            $total = 0;
            @endphp
            @foreach($ajax_content as $key => $v_content)
            <tr class="cart_item">
                <td style="float:left">
                <a href="{{URL::to('chi-tiet-san-pham/'.$v_content['product_id'])}}"> {{$v_content['product_name']}} </a>
                </td>
                <td class="product-quantity">
                    <span class="amount">x {{$v_content['product_quantity']}}</span>
                </td>
                <td style="float:right">
                    <span style="color:red" class="amount"> <?php $subtotal = $v_content['product_price'] * $v_content['product_quantity']; echo number_format($subtotal).' '.'VND'; ?></span>
                    <?php
                        $total = $total + $subtotal;
                       
                    ?>
                </td>                           
            </tr>
            <!-- <td class="actions" colspan="6">
                
            </td>--> 
            @endforeach
           
        </tbody>
        
        <tfoot>
            <tr class="order-total">
                <th>Tổng tiền</th><td ></td>
                
                <td ><strong><span class="amount"> {{number_format($total).' '.'VND'}}</span></strong> </td>
            </tr>
            
        </tfoot>
            @else
            <span style="font-size: 20px; font-weight:300; color:red">
                Không có sản phẩm
            @endif

    </table>
    <!--End shop table-->
    <!--Start payment-->
    
    <div id="payment" class="checkout-payment">
        <h4>Hình thức thanh toán </h4> <br>
        <ul class="payment_methods methods">
            <form action="{{URL::to('/order-place')}}" method="POST">
                {{csrf_field()}}
            <li class="payment_method_bacs">
                <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="TienMat"  checked="checked">
                <label for="payment_method_bacs">
                Thanh toán khi nhận hàng
            </label>
            </li>
            
            </li>
            <button style="float:right" class="update-cart-qty" type="submit" name="send_order"<?php if(count($ajax_content)==0) echo "Disabled" ?>>Đặt hàng</button>
            </form>
        </ul>

        <div class="clear"></div>
    </div> <hr>
    <!--End payment-->
    
</div>
<!--End order review-->

</div>
<div class="clear"> 
</div>

@endsection