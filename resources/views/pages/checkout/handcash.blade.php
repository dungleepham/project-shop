@extends('layout')
@section('content')


 <!--SATRT REVOLUTION SLIDER-->
 <div id="rev_slider_1_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container">
            <div id="rev_slider_1_1" class="rev_slider fullwidthabanner">
                <ul>
                    
                    <li data-transition="fade" data-slotamount="7" data-masterspeed="1000"  data-saveperformance="off" >
                        <!-- MAIN IMAGE -->
                        <img src="{{('public/frontend/img/parallax.jpg')}}"  alt="slider31"  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                        <!-- LAYERS -->

                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption slider-title sfr tp-resizeme"
                             data-x="center" data-hoffset="0"
                             data-y="center" data-voffset="-52"
                             data-speed="2000"
                             data-start="500"
                             data-easing="easeOutExpo"
                             data-splitin="chars"
                             data-splitout="none"
                             data-elementdelay="0.1"
                             data-endelementdelay="0.1"
                             data-endspeed="300">THANKS FOR SHOPPING WITH US
                        </div>

                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption black sfb tp-resizeme"
                             data-x="center" data-hoffset="0"
                             data-y="center" data-voffset="34"
                             data-speed="800"
                             data-start="2200"
                             data-easing="Quad.easeInOut"
                             data-splitin="none"
                             data-splitout="none"
                             data-elementdelay="0.1"
                             data-endelementdelay="0.1"
                             data-endspeed="300"><a href="{{URL::to('/trang-chu')}}" class='buttom_bike'>QUAY VỀ TRANG CHỦ</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div><!--END REVOLUTION SLIDER-->


@endsection