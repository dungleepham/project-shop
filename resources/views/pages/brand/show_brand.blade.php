@extends('layout')
@section('content')
  <!--Start shop-->
  <div class="tz-shop">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!--Start shop content-->
                    <div class="tz-shop-content">
                        <ul class="tz-breadcrumbs">
                            <li>
                                <a href="{{URL::to('/trang-chu')}}">Trang chủ</a>
                            </li>
                            <li class="current">
                            @foreach($brand_name as $key => $name)
                                {{($name->brand_name)}}
                            @endforeach
                            </li>
                        </ul>
                        

                        <div class="tz-product row grid-eff">
                            <!--Product item-->
                            <!--Start section large top for tabs content-->
                            <div class="section-large-top">
                                <div class="container">
                            <!--Tabs Shop-->
                                    <div class="tz-shortcode-tabs">

                            <!--Tabs Header-->
                                        <div class="tz-tabs-header">
                        <h2 class="tz-tabs-title pull-left">
                            @foreach($brand_name as $key => $name)
                                {{($name->brand_name)}}
                            @endforeach
                            
                        </h2>
                                </div>
                        <div class="catalog-meta">
                            <div class="catalog_top">
                                <form class="shop-order">
                                    @csrf
                                    <label class="form-arrow" >
                                        <select id="orderby" name="orderby" class="orderby">
                                            <option value="{{Request::url()}}?sort_by=none"> Xếp theo </option>
                                            <option value="{{Request::url()}}?sort_by=asc"> Giá tăng dần </option>
                                            <option value="{{Request::url()}}?sort_by=desc"> Giá giảm dần </option>
                                            <option value="{{Request::url()}}?sort_by=az"> Tên: A - Z </option>
                                            <option value="{{Request::url()}}?sort_by=za"> Tên: Z - A </option>
                                        </select>
                                    </label>
                                </form>
                            </div>
                        </div>

                        <hr>
                            <!--End tab header-->
                            <!--Tab content-->
                    <div class="tab-content">
                            <!--Tab item-->
                        <div class="tab-pane active" id="one_read">
                            <div class="row">
                                 @foreach($brand_by_id as $key => $product)
                                <div class="col-md-6 col-sm-6">
                                    <!--Start product item-->
                                    <div class="product-item">
                                        <a href="{{URL::to('chi-tiet-san-pham/'.$product->product_id)}}">
                                            <div class="product-thubnail">
                                                <img src="{{URL::to('public/upload/products/'.$product->product_image)}}" alt="product" />
                                                <div class="product-meta">
                                                </div>
                                            </div>
                                            <div class="product-infomation">
                                                <h4><a href="{{URL::to('chi-tiet-san-pham/'.$product->product_id)}}">{{$product->product_name}}</a></h4>
                                                <span class="product-price">{{number_format($product->product_price).' '. 'VND'}}</span>
                                            </div>
                                        </a>
                                    </div>
                                    <!--End product item-->
                                </div>
                                @endforeach       
                            </div>
                        </div>
                        <!--End tab item-->
                    </div>
                </div>
            </div>
        </div>
        <!--End section large top for tabs content-->
                            <!--End product item-->

                <div>
                   {{$brand_by_id->links()}}
                    <!--End shop content-->
                </div>

                        </div>

                    </div>
                    <!--End shop content-->
                </div>
            </div>
        </div>
    </div>
    <!--End Shop-->
@endsection