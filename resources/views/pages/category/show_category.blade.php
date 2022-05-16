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
                                @foreach($category_name as $key => $name)
                                {{($name->category_name)}}
                                @endforeach
                            </li>
                        </ul>
                    <!--    <div class="catalog-meta">
                            <div class="catalog_top">
                                <span class="style-switch">
                                    <a class="nav-grid-view fa fa-th-large active"></a>
                                    <a class="nav-list-view fa fa-list"></a>
                                </span>
                                <form class="shop-order">
                                    <label class="form-arrow" >
                                        <select id="orderby" name="orderby" class="orderby">
                                            <option value="{{Request::url()}}?sort_by=none"> Sắp xếp theo </option>
                                            <option value="{{Request::url()}}sort_by=asc"> Sắp xếp theo: Giá tăng dần </option>
                                            <option value="{{Request::url()}}sort_by=desc"> Sắp xếp theo: Giá giảm dần </option>
                                            <option value="{{Request::url()}}sort_by=az"> Sắp xếp theo tên: A - Z </option>
                                            <option value="{{Request::url()}}sort_by=za"> Sắp xếp theo tên: Z - A </option>
                                        </select>
                                    </label>
                                </form>
                            </div>
                        </div>-->

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
                            @foreach($category_name as $key => $name)
                                {{($name->category_name)}}
                            @endforeach
                            </h2>
                       
                        </div>
                        <hr>
                            <!--End tab header-->
                            <!--Tab content-->
                                        <div class="tab-content">
                            <!--Tab item-->
                        <div class="tab-pane active" id="one_read">
                            <div class="row">
                                 @foreach($category_by_id as $key => $product)
                                <div class="col-md-6 col-sm-6">
                                    <!--Start product item-->
                                    <div class="product-item">
                                        <a href = "{{URL::to('chi-tiet-san-pham/'.$product->product_id)}}">
                                            <div class="product-thubnail">
                                                <img src="{{URL::to('public/upload/products/'.$product->product_image)}}" alt="product" />
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
                    <!--End tab content-->
                   
                <!--End Tabs Shop-->
                    </div>
                </div>
            </div>
        <!--End section large top for tabs content-->
                <div>
                   {{$category_by_id->links()}}
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