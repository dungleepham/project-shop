@extends('layout')
@section('content')

<div class="col-md-12">

<!--Order review-->

<?php
$content = Cart::content();
$ajax_content = Session::get('cart');
$customer_id = Session::get('customer_id');
$customer_name = Session::get('customer_name');
$customer_phone = Session::get('customer_phone');
$customer_address = Session::get('customer_address');
$shipping_id = Session::get('shipping_id');

$shipping_address = Session::get('addrs');
echo $shipping_address;


?>
 <div class="row">

   
    <h1 class="page-title">Đơn hàng của bạn</h1>
        <div id="order_review">
           
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
            
                
                <form id = "order-form" action="{{URL::to('/order-place')}}" method="POST">
                        {{csrf_field()}}
                    <div style= "display:flex">
                        <div style = "margin-right: 10rem; flex-grow: 3" >
                        <h4>Hình thức thanh toán </h4> <br>
                        <ul class="payment_methods methods">
                            <li class="payment_method_bacs">
                                <input id="payment_method_bacs" type="radio" class="input-radio payment-method" name="payment_method" value="TienMat"  checked="checked">
                                <label for="payment_method_bacs">
                                Thanh toán khi nhận hàng
                                </label>
                            </li>
                            <li class="payment_method_bacs">
                                <input id="payment_method_bacs" type="radio" class="input-radio payment-method" name="payment_method" value="online"  >
                                <label for="payment_method_bacs">
                                    Thanh toán vnpay
                                </label>
                            </li>
                        
                        </ul>
                        </div>   
                        <div style = "margin-right: 10rem; flex-grow: 5">
                        <h4>Thông tin giao hàng </h4> 
                            <p class="form-row">
                            
                                <label> Địa chỉ giao hàng <span class="required">*</span></label>
                                    <select name = "shipping_address">
                                @foreach ($shipping as $value => $key)
                                    <option value = "{{$key->shipping_address}}"> Khách hàng: {{$key->shipping_name}}  -  Số điện thoại: {{$key->shipping_phone}}  -  Địa chỉ: {{$key->shipping_address}}</option>
                                @endforeach
                                </select>
                            </p>
                            <button style = "margin-top: 10px" class="btn-add-address button-add-address">+</button>
                        </div>
                        
 
                        </div>  
                        <button style="width: 120px; height: 50px; flex-grow: 2" name="redirect" class="update-cart-qty pull-right" type="submit" name="send_order"<?php if(count($ajax_content)==0) echo "Disabled" ?>>Đặt hàng</button>
                    </form>
                <div class="clear"></div>
            </div> <hr>
            <!--End payment-->
            
        </div>
        <!--End order review-->

  
<div class="clear"> 
</div>
    <div class="modal fade" id="ModalCenter">
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
                        <div class="clear"></div></div>
                
                    </div>
            </div>       
        </div>
    </div>

<script>
      $(document).ready(function(){
            $('.button-add-address').click(function(event){
               event.preventDefault();
               $('#ModalCenter').modal('show');
            });

            $(".payment-method").change(function() { 
                var type = $(this).val();
                if(type == "TienMat"){
                    $('#order-form').attr('action', "{{URL::to('/order-place')}}");
                }
                else {
                    $('#order-form').attr('action', "{{URL::to('/vnpay_payment')}}");
                }
                
            });
        });

    
</script>
@endsection