@extends('admin_layout')
@section('admin_content')
 
<div class="content-body">

       
   
    <!-- row -->
	<div class="container-fluid">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Nhập hàng</h4>
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
                
               
                    <div class="basic-form" >
                        <form id = "save-receipt" action="{{URL::to('/save-import-product')}}" method="post">
                            {{csrf_field()}}
                            <div class="col-xl-12 col-lg-12" >
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Sản phẩm</h4>
                                        </div>
                                        <div class="card-body" id="receipt">
                                           
                                                <div class="basic-form" id = "form1" style="margin-bottom: 10px">
                                                    <div class="form-row">
                                                        <label>chọn sản phẩm</label>
                                                        <select name="product_cate[]" class="form-control default-select col-sm-4" id="sel1">


                                                        @foreach($import_product as $key => $import_pd)    
                                                            <option value="{{$import_pd->product_id}}">{{$import_pd->product_name}}</option>
                                                        @endforeach    
                                                        </select>
                                                        <label  class="col-sm-1 col-form-label">Giá nhập vào</label>
                                                        <input type="number" class="form-control col-sm-2" name="product_import_price[]">
                                        
                                                        <label  class="col-sm-1 col-form-label">Số lượng nhập</label>
                                                        <input type="number" class="form-control col-sm-2" name="product_quantity[]">

                                                        <button class="col-sm-1 btn btn-danger remove-form" data-id = "1">Xóa</button>
                                                    </div>

                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            <input type="hidden" name="index" id = "i" value = "1">                   
                          
                                
                                   
                        </form>
                        <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button name="add_product"  class="btn btn-success add-component">Thêm sản phẩm</button>
                                        </div>
                                    </div>
                        <div style="float:right ; margin: 10px" class="form-group row">
                                        <div class="col-sm-10">
                                            <button name="add_product" type="submit" class="btn btn-primary save-recpt">Lưu phiếu nhập hàng</button>
                                        </div>
                                    </div>
                    </div>
                </div>
            </div>
		</div>
    </div>
</div>

<Script type= "text/javascript">

        $(document).ready(function(){
            $('.add-component').click(function(event){
                event.preventDefault();
                var i = $('#i').val();
                var u = Number(i) + 1;
                $('#receipt').append('<div class="basic-form" id = "form'+u+'" style="margin-bottom: 10px"> <div class="form-row"><label>chọn sản phẩm</label><select name="product_cate[]" class="form-control default-select col-sm-4" id="sel1"> @foreach($import_product as $key => $import_pd) <option value="{{$import_pd->product_id}}">{{$import_pd->product_name}}</option>@endforeach  </select><label class="col-sm-1 col-form-label">Giá nhập vào</label><input type="number" class="form-control col-sm-2" name="product_import_price[]"><label class="col-sm-1 col-form-label">Số lượng nhập</label><input type="number" class="form-control col-sm-2" name="product_quantity[]"><button class="col-sm-1 btn btn-danger remove-form" data-id = "'+u+'">Xóa</button> </div> </div> ');
                $('#i').val(u);
            });

            $('#receipt').on('click', '.remove-form', function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var i = $('#i').val();
                var u = Number(i) - 1;
                $('#i').val(u);
                $('#form' + id).remove();
            });

            $('.save-recpt').click(function(event){
                $('#save-receipt').submit();
            });
        });



</Script>

@endsection