
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
                                <h4 class="card-title">Đơn hàng đã xác nhận</h4>

                                <?php
                                     $message = Session::get('message');
                                     if($message) {
                                     echo '<span class="alert alert-success alert-dismissible fade show">'
                                         ,$message, '</span>';
                                         Session::put('message', null);
                                     }
                                 ?>
                            <li class="nav-item">
								<div class="input-group search-area d-xl-inline-flex d-none">
                                <form action="">
									<input type="text" name = "search" class="form-control" placeholder="Tìm kiếm đơn hàng">
                                </form>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="flaticon-381-search-2"></i></a></span>
                                    </div>
								</div>
							</li>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th>ID Đơn hàng</th>
                                                <th>Tên người đặt</th>
                                                <th>Tổng giá tiền</th>
                                                <th>Tình trạng</th>
                                                <th>Xem đơn hàng</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($confirm_order as $key => $order)
                                            <tr>
                                                <td><div> <span class="w-space-no" style="color:black">{{$order->order_id}}</span></div></td>
                                                <td><div> <span class="w-space-no" style="color:black">{{$order->customer_name}}</span></div></td>
                                                <td><div> <span class="w-space-no" style="color:black">{{$order->order_total}} VND</span></div></td>
                                                <td><div> <span class="w-space-no" style="color:black">{{$order->order_status}}</span></div></td>
                                               
                                                <td>
                                                
													<div class="d-flex">
														<a href="{{URL::to('/view-confirm/'.$order->order_id)}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-eye"></i></a>
													</div>
												</td>
                                            </tr>
                                        @endforeach    
											
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