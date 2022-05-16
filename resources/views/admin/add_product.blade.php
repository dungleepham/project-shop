@extends('admin_layout')
@section('admin_content')
 
<div class="content-body">

       
   
    <!-- row -->
	<div class="container-fluid">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thêm sản phẩm</h4>
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
                
               
                    <div class="basic-form">
                        <form action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên sản phẩm</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="product_name">
                                    </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Giá sản phẩm</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="product_price">
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số lượng sản phẩm</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="product_quantity">
                                    </div>
                            </div>
                            <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="product_image" class="custom-file-input">
                                                <label class="custom-file-label">Chọn ảnh sản phẩm</label>
												
                                            </div>
											
                                        </div>      
                                <div class="col-xl-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Mô tả sản phẩm</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="basic-form">
                                               <div class="form-group">
                                                    <textarea name="product_desc" style="resize:none" class="form-control" rows="6" id="comment"></textarea>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Nội dung sản phẩm</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="basic-form">
                                               <div class="form-group">
                                                    <textarea name="product_content" style="resize:none" class="form-control" rows="6" id="comment"></textarea>
                                                </div>
                                        </div>
                                    </div>
                                </div>             
                                   
                                <div class="col-xl-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Danh mục sản phẩm</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="basic-form">
                                                    <div class="form-group">
                                                        <label>chọn</label>
                                                        <select name="product_cate" class="form-control default-select" id="sel1">
                                                        @foreach($cate_product as $key => $cate)    
                                                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                                        @endforeach    
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-xl-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Thương hiệu sản phẩm</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="basic-form">
                                                    <div class="form-group">
                                                        <label>chọn</label>
                                                        <select name="product_brand" class="form-control default-select" id="sel1">
                                                        @foreach($brand_product as $key => $brand)    
                                                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                                        @endforeach 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Ẩn/Hiển thị</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="basic-form">
                                                    <div class="form-group">
                                                        <label>chọn</label>
                                                        <select name="product_status" class="form-control default-select" id="sel1">
                                                            <option value="0">Ẩn</option>
                                                            <option value="1">Hiển thị</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button name="add_product" type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                                        </div>
                                    </div>
                        </form>
                    </div>
                </div>
            </div>
		</div>
    </div>
</div>


@endsection