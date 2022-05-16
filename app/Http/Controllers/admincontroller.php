<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class admincontroller extends Controller
{

    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return redirect::to('dashboard');
        }
        else{
            return redirect::to('admin')->send();
        }
    }

    public function index(){
        
        return view('admin_login');
    }

    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }

    public function dashboard(Request $request){
        
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password', $admin_password)->first();
        
        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->id);
            return Redirect::to('/dashboard');
            }
        else{
            Session::put('message', 'Sai tài khoản hoặc mật khẩu!');
            return Redirect::to('/admin');
        }
       
    }

    public function load_statistic(){
    	$now = Carbon::now('Asia/Ho_Chi_Minh');
    	$first_day=Carbon::create(Carbon::now()->year, 1, 1);

    	$revenue = DB::table('tbl_order')
    	->whereBetween('created_at', [ $first_day, $now])
    	->select(DB::raw('COUNT(order_id) as soluong, MONTH(created_at) as Thang'))->groupBy('Thang')
    	->get();

    	$labels=array();
    	$series=array();
    	foreach ($revenue as $key => $value) {
    		$labels[]='Tháng '.$value->Thang;
    		$series[]=$value->soluong;
    	}
    	$chart_data = array(
    		'labels' => $labels,
    		'series' => $series
    	);

        //print_r($chart_data);

    	echo $data = json_encode($chart_data);
    }

    public function logout(){
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
}
