
@extends('admin_layout')
@section('admin_content')


    <link href="{{asset('public/backend/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/backend/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/backend/icon/font-awesome-old/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

<div class="content-body">
            <!-- row -->
			<div class="container-fluid">
            
            <div class="col-lg-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thông tin khách hàng</h4>

                                <?php
                                     $message = Session::get('message');
                                     if($message) {
                                     echo '<span class="alert alert-success alert-dismissible fade show">'
                                         ,$message, '</span>';
                                         Session::put('message', null);
                                     }
                                 ?>
                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                
                                                <th>Tên khách hàng</th>
                                                <th>Địa chỉ</th>
                                                <th>Số điện thoại</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order_by_id as $values) 
                                        @endforeach 
                                        <tr>
                                            <td>{{$values->customer_name}}</td>
                                            <td>{{$values->customer_address}}</td>
                                            <td>{{$values->customer_phone}}</td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thông tin vận chuyển</h4> 
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th>Tên khách đặt hàng</th>
                                                <th>Địa chỉ giao hàng</th>
                                                <th>Số điện thoại</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order_by_id as $values)  
                                        <?php
                                            $total = $values->order_total;
                                        ?>
                                        @endforeach 
                                       
                                            
                                       
                                            <tr>
                                          
                                                <td>{{$values->customer_name}}</td>
                                                <td>{{$values->customer_address}}</td>
                                                <td>{{$values->customer_phone}}</td>
                                            </tr>
                                       
                                  
											
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Chi tiết đơn hàng</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                               
                                                <th>Tên sản phẩm</th>
                                                <th>Số lượng</th>
                                                <th>giá</th>
                                                
                                            </tr>
                                           
                                        </thead>
                                        <tbody>
                                            @foreach($order_details as $values)
                                            <tr>
                                                
                                                <td>{{$values->product_name}}</td>
                                                <td>{{$values->product_quantity}}</td>
                                                <td>{{number_format($values->product_price).' '.'VND'}}</td>   
                                            @endforeach        
                                            </tr>

                                            <tr>
                                                <td>Mã đơn hàng: {{$values->order_id}}</td>
                                                <td>&nbsp;</td>
                                                <td>Tổng Tiền: {{$total}} VND</td>
                                            </tr>
											
                                        </tbody>
                                        
                                    </table>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
    <script src="{{asset('public/backend/vendor/global/global.min.js')}}"></script>
	<script src="{{asset('public/backend/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('public/backend/js/custom.min.js')}}"></script>
	<script src="{{asset('public/backend/js/deznav-init.js')}}"></script>

@endsection