@extends('admin_layout')
@section('admin_content')
 
<div class="content-body">

       
   
    <!-- row -->
	<div class="container-fluid">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Cập nhật sản phẩm</h4>
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
                @foreach($edit_product as $key => $pro)
               
                    <div class="basic-form">
                        <form action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên sản phẩm</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="product_name" value="{{$pro->product_name}}">
                                    </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Giá sản phẩm</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="product_price" value="{{$pro->product_price}}">
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số lượng sản phẩm</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="product_quantity" value="{{$pro->product_price}}">
                                    </div>
                            </div>
                            <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" name="product_image" class="custom-file-input">
                                                <label class="custom-file-label">Chọn ảnh sản phẩm</label>
                                            </div>
                                            <hr>
                                            <div><img src="{{URL::to('public/upload/products/'.$pro->product_image)}}" height="200" width="200" ></div> 
                                        </div>     
                                <div class="col-xl-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Mô tả sản phẩm</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="basic-form">
                                               <div class="form-group">
                                                    <textarea name="product_desc" style="resize:none" class="form-control" rows="6" id="comment">{{$pro->product_desc}}</textarea>
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
                                                    <textarea name="product_content" style="resize:none" class="form-control" rows="6" id="comment">{{$pro->product_content}}</textarea>
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
                                                            @if($cate->category_id == $pro->category_id)
                                                            <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                                            @else
                                                            <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                                            @endif
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
                                                            @if($brand->brand_id == $pro->brand_id) 
                                                            <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                                            @else
                                                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                                            @endif
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
                                            <button name="add_product" type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                                        </div>
                                    </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
		</div>
    </div>
</div>


@endsection