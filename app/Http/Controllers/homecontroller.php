<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use DB;
use Carbon\Carbon;
class homecontroller extends Controller
{
    

    public function index(){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id','desc')->get();
        $all_product = DB::table('tbl_product')->where('product_status', '1')->orderby('product_id','desc')->limit(4)->get();
        //$all_product = DB::table('tbl_product')
        //->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        //->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        //->orderby('tbl_product.product_id', 'desc')->get();
        return view('pages.home')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product);

      


    }

    public function search(request $REQUEST){

        $keywords = $REQUEST->keywords_submit;

        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id','desc')->get();

        $search_product = DB::table('tbl_product')->where('product_name', 'like', '%'.$keywords.'%')->get();

        return view('pages.sanpham.search_product')->with('category', $cate_product)->with('brand', $brand_product)->with('search_product', $search_product);
    }

    public function show_customer_page(){
        // view don hang
        $customer_id = Session::get('customer_id');
        

        $donhang = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->where('tbl_customers.customer_id', $customer_id)
        ->orderby('tbl_order.order_id', 'asc')->get();
       

        

        //view thong tin ca nhan
        $thongtinKhach = DB::table('tbl_customers')->where('tbl_customers.customer_id', $customer_id)->get();

        return view('pages.customer')->with('donhang', $donhang)->with('thongtinKhach', $thongtinKhach);
    }

    public function edit_customer_infor($customer_id){
        $thongtinKhach = DB::table('tbl_customers')->where('tbl_customers.customer_id', $customer_id)->get();
        return view('pages.edit_customer')->with('thongtinKhach', $thongtinKhach);
    }

    public function update_customer_info(request $REQUEST, $customer_id){
        $thongtinKhach = DB::table('tbl_customers')->where('tbl_customers.customer_id', $customer_id)->get();
        $customer_data = array();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $customer_data['customer_name'] = $REQUEST->customer_name;
        $customer_data['customer_phone'] = $REQUEST->customer_phone;
        $customer_data['customer_address'] = $REQUEST->customer_address;
        $customer_data['updated_at'] = $now;

       
        DB::table('tbl_customers')->where('customer_id', $customer_id)->update($customer_data);
      
      
        return redirect::to('customer');
    }

    public function customer_details_order ($order_id){
        //view chi tiet don

        $chitiet = DB::table('tbl_order_details')
        ->join('tbl_product', 'tbl_order_details.product_id','=', 'tbl_product.product_id')
        ->where('tbl_order_details.order_id', $order_id)
        ->select('tbl_order_details.*', 'tbl_product.product_name')->get();

        return view('pages.customer_view_order')->with('chitiet', $chitiet);

    }


    public function customer_delete_order($order_id){

        DB::table('tbl_order')->where('order_id',$order_id)->delete();
        DB::table('tbl_order_details')->where('order_id',$order_id)->delete();
        
        
        return redirect::to('customer');
    }

    

    public function error_page_404(){
        return view('errors.404');
    }

    public function error_page_500(){
        return view('errors.500');
    }
    
}
