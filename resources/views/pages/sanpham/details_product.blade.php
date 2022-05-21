@extends('layout')
@section('content')

<section class="tz-shop-single">
        <div class="container">

            <!--Start Breadcrumbs-->
            <ul class="tz-breadcrumbs">
                <li>
                    <a href="{{URL::to('/trang-chu')}}">Trang chủ</a>
                </li>
                <li class="current">
                    Category
                </li>
            </ul>

         
           
            <!--End Breadcrumbs-->
            @foreach($details_product as $key => $value)
            <div class="row">
                <div class="col-md-6 col-sm-6">

                    <!--Shop images-->
                    <div class="shop-images">
                        <ul class="single-gallery">
                            <li>
                                <img src="{{URL::to('public/upload/products/'.$value->product_image)}}" alt="">
                            </li>
                        </ul>
                        
                    </div>
                    <!--End shop image-->
                </div>
                <div class="col-md-6 col-sm-6">
                    <!--Shop content-->
                    <div class="entry-summary">
                        <h1>{{$value->product_name}}  {{$value->brand_name}}</h1>
                        
                        <p class="product-price">
                            <span class="price">{{number_format($value->product_price).' '.'VND'}}</span>
                            <span class="stock">Còn lại:  <span>{{$value->product_quantity}}</span></span>
                        </p>
                        <div class="description">
                            <p>
                                {{$value->product_desc}}
                            </p>
                        </div>
                        <form class="tz_variations_form ">
                            @csrf
                            <p class="form-attr" >
                                <span class="tzqty">
                                    <label>Số lượng</label>
                                    <input type="hidden"   value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                                    <input type="hidden"   value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                                    <input type="hidden"   value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                                    <input type="hidden"   value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
                                    <input type="number" step="1" min="1" name="qty" value="1" class="cart_product_quantity_{{$value->product_id}}" size="4">
                                    <!-- <input type="hidden"  name="productid_hidden" value="{{$value->product_id}}"> -->
                                </span>
                            </p>
                            <p>
                                <button type="button" data-id="{{$value->product_id}}" class="single_add_to_cart_button add_cart" name="add_cart"> Thêm vào giỏ hàng </button>
                            </p>
                        </form>
                    </div>
                    <!--End shop content-->
                </div>

            </div>
        </div>
        @endforeach
        <!--Shop tabs-->
        <div class="tz-shop-tabs">
            <div class="container">
                <div class="tab-head">
                    <ul class="nav nav-tabs">
                        <li role="presentation" class="active"><a href="#description" data-toggle="tab">Mô tả sản phẩm</a></li>
                       
                        <li role="presentation"><a href="#information" data-toggle="tab">Thông tin sản phẩm</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="description">
                        <p>
                        {{$value->product_desc}}
                        </p>
                    </div>
                    <div class="tab-pane" id="information">
                        <p> {{$value->product_content}}</p>
                    </div>
                </div>
            </div>
        </div>
        <!--End tab-->



        <!--Relative product -->

        <div class="recommended_items"><!--recommended_items-->
						<h2 class="title text" style="padding-left:30px">Sản phẩm liên quan</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
                                    @foreach($relate as $key => $lienquan)
									<div class="col-sm-4">
                                    <a href="{{URL::to('chi-tiet-san-pham/'.$lienquan->product_id)}}">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{URL::to('/public/upload/products/'.$lienquan->product_image)}}" alt="" />
													<p><a href="{{URL::to('chi-tiet-san-pham/'.$lienquan->product_id)}}"> {{$lienquan->product_name}} </a></p>
                                                    <h2 class="price">{{number_format($lienquan->product_price).' '. 'VND'}}</h2>
												</div>
											</div>
										</div>
                                    </a>
									</div>
                                   
									@endforeach
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
        <!--End relative product -->
</section>
    <!--End Shop single-->

@endsection