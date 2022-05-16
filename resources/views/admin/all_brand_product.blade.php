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
                                <h4 class="card-title">thương hiệu</h4>

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
                                                <th class="width50">
													<div class="custom-control custom-checkbox checkbox-success check-lg mr-3">
														<input type="checkbox" class="custom-control-input" id="checkAll" required="">
														<label class="custom-control-label" for="checkAll"></label>
													</div>
												</th>
                                                <th>Tên</th>
                                                <th>Ẩn/Hiển thị</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($all_brand_product as $key => $brand_pro)
                                            <tr>
                                                <td>
													<div> <label class="i-checks m-b-none check-lg mr-3"> 
														<input type="checkbox" name="post[]"><i></i> </label>
														
													</div>
												</td>
                                                <td><div> <span class="w-space-no" style="color:black">{{$brand_pro->brand_name}}</span></div></td>
                                                <td style="color:black">
                                                    <?php
                                                        if($brand_pro->brand_status == 0)
                                                        {
                                                            ?>
                                                        <a href="{{URL::to('/active-brand-product/'.$brand_pro->brand_id)}}"> <i class="fa-eye-styling fa fa-eye-slash" aria-hidden="true"> </i> </a>
                                                    <?php
                                                        }
                                                        else{
                                                    ?> 
                                                        <a href="{{URL::to('/unactive-brand-product/'.$brand_pro->brand_id)}}"> <i class="fa-eye-styling fa fa-eye" aria-hidden="true"></i> </a>
                                                    <?php 
                                                        }
                                                    ?>
                                                
                                                </td>
                                                <td>
													<div class="d-flex">
														<a href="{{URL::to('/edit-brand-product/'.$brand_pro->brand_id)}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
														<a onclick="return confirm('Bạn muốn xóa mục này?')" href="{{URL::to('/delete-brand-product/'.$brand_pro->brand_id)}}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
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