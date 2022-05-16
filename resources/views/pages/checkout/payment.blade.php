@extends('layout')
@section('content')

<div class="col-md-12">

<!--Order review-->

<?php
$content = Cart::content();
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
            @foreach($content as $v_content)
            <tr class="cart_item">
                <td style="float:left">
                <a href="{{URL::to('chi-tiet-san-pham/'.$v_content->id)}}"> {{$v_content->name}} </a>
                </td>
                <td class="product-quantity">
                    <span class="amount">x {{$v_content->qty}}</span>
                </td>
                <td style="float:right">
                    <span style="color:red" class="amount"> <?php $subtotal = $v_content->price * $v_content->qty; echo number_format($subtotal).' '.'VND'; ?></span>
                </td>                           
            </tr>
            <!-- <td class="actions" colspan="6">
                
            </td>--> 
            @endforeach
        </tbody>
        <tfoot>
            <tr class="order-total">
                <th>Tổng tiền</th><td ></td>
                <td ><strong><span class="amount"> {{(Cart::subtotal()).' '.'VND'}}</span></strong> </td>
            </tr>
        </tfoot>
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

            <button style="float:right" class="update-cart-qty" type="submit" name="send_order">Đặt hàng</button>
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