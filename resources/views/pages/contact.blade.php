@extends('layout')
@section('content')
  <!--Start Blog-->
  <div class="blog">
            <div class="container">
                <ul class="tz-breadcrumbs">
                    <li>
                        <a href="{{URL::to('/trang-chu')}}">Trang chủ</a>
                    </li>
                    <li class="current">
                        Liên hệ
                    </li>
                </ul>
                <div class="blog-container">
                    <div class="row">
                    <div class="col-md-4">

                        <!--Blog Sidebar-->
                        <div class="blog-sidebar">
                            <aside class="contact-info widget no-border">
                                <h4 class="widget-title">Thông tin liên hệ</h4>
                                <p>Nếu có vấn đề gì xin liên hệ qua thông tin dưới đây</p>
                                <ul>
                                    <li>
                                        <span>Địa chỉ</span>
                                        <address>Đường Nguyễn Trãi, Khóm 4, Thị Trấn Cái Nhum, Huyện Mang Thít, Tỉnh Vĩnh Long</address>
                                    </li>
                                    <li>
                                        <span>Số điện thoại: </span> 0964.618.627
                                    </li>
                                    <li>
                                        <span>Email:</span> dunglepham@gmail.com
                                    </li>
                                </ul>
                            </aside>
                        </div>
                        <!--End Blog Sidebar-->
                    </div>
                    <div class="col-md-8 tz-blog-content">
                        <h1 class="large-ttle">Liên hệ với chúng tôi</h1>
                        <div id="contact-form" class="contact-respond">
                           
                        </div>
                        
                        <div class="map">
                            <h3 class="tz-title">Địa chỉ cửa hàng trên bảng đồ</h3>
                            <div class="map-iframe">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d476.8967863690511!2d106.1185904536195!3d10.183302507754492!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0750e97691c5d%3A0x39a4bd3e2b2eaeff!2zQ-G7rWEgSMOgbmcgVHJhbmcgVHLDrSBO4buZaSBUaOG6pXQgVGnhur9uIMSQ4bqhdA!5e0!3m2!1svi!2s!4v1646903119621!5m2!1svi!2s"></iframe></iframe>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Start Blog-->
@endsection