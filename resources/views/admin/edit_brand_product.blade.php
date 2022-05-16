@extends('admin_layout')
@section('admin_content')
 
<div class="content-body">

       
   
    <!-- row -->
	<div class="container-fluid">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Cập nhật thương hiệu sản phẩm</h4>
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
                
                @foreach($edit_brand_product as $key => $edit_value)
                    <div class="basic-form">
                        <form action="{{URL::to('/update-brand-product/'.$edit_value->brand_id)}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên thương hiệu</label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{$edit_value->brand_name}}" class="form-control" name="brand_product_name">
                                    </div>
                                
                                <div class="col-xl-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Mô tả thương hiệu</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="basic-form">
                                               <div class="form-group">
                                                    <textarea name="brand_product_desc" style="resize:none" class="form-control" rows="6" id="comment">{{$edit_value->brand_desc}}</textarea>
                                                </div>
                                        </div>
                                    </div>
                                </div>        
                            </div>        
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button name="update_brand_product" type="submit" class="btn btn-primary">Cập nhật thương hiệu</button>
                                        </div>
                                    </div>
                        </form>
                    </div>
                @endforeach    
                </div>
            </div>
		</div>
    </div>
</div>


@endsection