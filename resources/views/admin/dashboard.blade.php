@extends('admin_layout')
@section('admin_content')

        <div class="content-body">
          
			<div class="container-fluid">
				
            <div class="col-xl-10 col-lg-10 col-sm-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Số đơn hàng theo tháng</h4>
                    </div>
                    <div class="card-body">
                        <form>
                        @csrf
                            <canvas id="myChart"></canvas>
                        </form>
                    </div>
                </div>
            </div>

            </div>
        </div>
       
@endsection