@extends('admin_layout')
@section('admin_content')
 
<div class="content-body">

       
   
    <!-- row -->
	<div class="container-fluid">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thêm danh mục sản phẩm</h4>
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
                        <form action="{{URL::to('/save-category-product')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên danh mục</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="category_product_name">
                                    </div>
                                
                                <div class="col-xl-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Mô tả danh mục</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="basic-form">
                                               <div class="form-group">
                                                    <textarea name="category_product_desc" style="resize:none" class="form-control" rows="6" id="comment"></textarea>
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
                                                        <select name="category_product_status" class="form-control default-select" id="sel1">
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
                                            <button name="add_category_product" type="submit" class="btn btn-primary">Thêm danh mục</button>
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