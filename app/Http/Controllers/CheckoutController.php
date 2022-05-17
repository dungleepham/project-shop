<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use DB;
use Carbon\Carbon;
session_start();


class CheckoutController extends Controller
{
    public function login_checkout(){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id','desc')->get();
        return view('pages.checkout.login_checkout')->with('category', $cate_product)->with('brand', $brand_product);
    }


    public function register(){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id','desc')->get();
        return view('pages.checkout.register')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function add_customer(request $REQUEST){
        $data = array();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $data['customer_name'] = $REQUEST->name;
        $data['customer_phone'] = $REQUEST->phone;
        $data['customer_password'] = md5($REQUEST->password);
        $data['customer_address'] = $REQUEST->address;
        $data['created_at'] = $now;
        $data['updated_at'] = $now;
        $customer_id = DB::table('tbl_customers')->insertGetId($data);

        session::put('customer_id', $customer_id);
        session::put('customer_name', $REQUEST->name);
        return redirect::to('/login-checkout');
    }

    public function checkout(){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id','desc')->get();
        return view('pages.checkout.show_checkout')->with('category', $cate_product)->with('brand', $brand_product);
    }

   

    public function payment(){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id','desc')->get();
        return view('pages.checkout.payment')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function logout_checkout(){
        Session::flush();
        return redirect::to('/login-checkout');
    }


    public function login_customer(request $REQUEST){
        
        $data = array();
        $phone = $REQUEST->phone;
        $password = md5($REQUEST->password);
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $result = DB::table('tbl_customers')->where('customer_phone', $phone)->where('customer_password', $password)->first();
        if($result){
            session::put('customer_id', $result->customer_id);
            session::put('customer_name', $result->customer_name);
            session::put('customer_address', $result->customer_address);
            session::put('customer_phone', $result->customer_phone);
            
            $shipping_data = array();
            $now = Carbon::now('Asia/Ho_Chi_Minh');
            $shipping_data['shipping_name'] = session::get('customer_name');
            $shipping_data['shipping_phone'] = $REQUEST->phone;
            $shipping_data['shipping_address'] = session::get('customer_address');
            $hipping_data['created_at'] = $now;
            $hipping_data['updated_at'] = $now;
            $shipping_id = DB::table('tbl_shipping')->insertGetId($shipping_data);
            

            session::put('shipping_id', $shipping_id);

            return redirect::to('/trang-chu');
        }else{
            Session::put('message', 'Sai tài khoản hoặc mật khẩu!');
            return redirect::to('/login-checkout');
        }
       
    }

    public function save_checkout_customer(request $REQUEST){
        $data = array();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $data['shipping_name'] = $REQUEST->name;
        $data['shipping_phone'] = $REQUEST->phone;
        $data['shipping_notes'] = $REQUEST->notes;
        $data['shipping_address'] = $REQUEST->address;
        $data['created_at'] = $now;
        $data['updated_at'] = $now;
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        session::put('shipping_id', $shipping_id);
        return redirect::to('/payment');
    }

    public function order_place(request $REQUEST){

        //GET PAYMENT METHOD
        $data = array();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $data['payment_method'] = $REQUEST->payment_method;
        $data['payment_status'] = 'Đang xử lý';
        $data['created_at'] = $now;
        $data['updated_at'] = $now;
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //insert order
        
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::subtotal();
        $order_data['order_status'] = 'Đã đặt hàng';
        $order_data['created_at'] = $now;
        $order_data['updated_at'] = $now;
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //insert order details
        $content = Cart::content();
        foreach($content as $v_content){
        $order_details_data = array();
        $order_details_data['order_id'] = $order_id;
        $order_details_data['product_id'] = $v_content->id;
        $order_details_data['product_name'] = $v_content->name;
        $order_details_data['product_price'] = $v_content->price;
        $order_details_data['product_quantity'] = $v_content->qty;
        $order_details_data['created_at'] = $now;
        $order_details_data['updated_at'] = $now;
        DB::table('tbl_order_details')->insert($order_details_data);
        }

        if( $data['payment_method'] == 'TienMat'){
           Cart::destroy();
           $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','asc')->get();
           $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id','desc')->get();
           return view('pages.checkout.handcash')->with('category', $cate_product)->with('brand', $brand_product);
        }
    }




    //manage order
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return redirect::to('dashboard');
        }
        else{
            return redirect::to('admin')->send();
        }
    }

    //xem các đơn hàng chưa duyệt
    public function manage_order(){
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name')->where('tbl_order.order_status', 'Đã đặt hàng')
        ->orderby('tbl_order.order_id', 'asc')->get();
        $manager_order = view('admin.manage_order')->with('all_order', $all_order);
        
        return view('admin_layout')->with('admin.manage_order', $manager_order);
    }

    //chi tiết các đơn hàng chưa duyệt
    public function view_order($orderId){
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        //->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->select('tbl_order.*','tbl_customers.*')->where('tbl_order.order_id', $orderId)->get();
        
        $order_details = DB::table('tbl_order_details')
        ->join('tbl_product', 'tbl_order_details.product_id','=', 'tbl_product.product_id')
        ->where('tbl_order_details.order_id', $orderId)
        ->select('tbl_order_details.*', 'tbl_product.product_name')->get();
        $manager_order_by_id = view('admin.view_order')->with('order_by_id', $order_by_id)->with('order_details', $order_details);
        


        return view('admin_layout')->with('admin.view_order', $manager_order_by_id);
    }



    //xác nhận đơn hàng
    public function confirm_order($orderId){
        $this->AuthLogin();
        DB::table('tbl_order')
        ->where('tbl_order.order_id', $orderId)
        ->update(['order_status'=>'Đã xác nhận']);
        
        $confirm_order = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name')->where('tbl_order.order_status', 'Đã đặt hàng')
        ->orderby('tbl_order.order_id', 'asc')->get();
        
        $manage_confirm_order = view('admin.confirm_order')->with('confirm_order', $confirm_order);
        return view('admin_layout')->with('admin.confirm_order', $manage_confirm_order);

        //echo $orderId;
    }

    //xem đơn hàng đã xác nhận
    public function view_confirm_order(){
        $this->AuthLogin();
        $confirm_order = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name')->where('tbl_order.order_status', 'Đã xác nhận')
        ->orderby('tbl_order.order_id', 'asc')->get();

        $manager_confirm_order = view('admin.confirm_order')->with('confirm_order', $confirm_order);

        
        return view('admin_layout')->with('admin.confirm_order', $manager_confirm_order);
    }




    //xem chi tiết các đơn hàng đã xác nhận 
    public function view_confirm($orderId){
        //$this->AuthLogin();
        //$view_confirm_order_by_id = DB::table('tbl_order')
        //->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        //->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        //->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        //->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_details.*')->where('tbl_order.order_id', $orderId)->get();
        //
        //$view = view('admin.view_confirm')->with('view_confirm_order_by_id', $view_confirm_order_by_id);
        //
        //return view('admin_layout')->with('admin.view_confirm', $view);
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        //->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->select('tbl_order.*','tbl_customers.*')->where('tbl_order.order_id', $orderId)->get();
        
        $order_details = DB::table('tbl_order_details')
        ->join('tbl_product', 'tbl_order_details.product_id','=', 'tbl_product.product_id')
        ->where('tbl_order_details.order_id', $orderId)
        ->select('tbl_order_details.*', 'tbl_product.product_name')->get();
        $manager_order_by_id = view('admin.view_confirm')->with('order_by_id', $order_by_id)->with('order_details', $order_details);
        


        return view('admin_layout')->with('admin.view_confirm', $manager_order_by_id);
    }

    public function view_received_order(){
        $this->AuthLogin();
        $received_order = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name')->where('tbl_order.order_status', 'Đã nhận được hàng')
        ->orderby('tbl_order.order_id', 'asc')->get();

        $manager_received_order = view('admin.view_receive')->with('received_order', $received_order);

        
        return view('admin_layout')->with('admin.view_receive', $manager_received_order);

    }

   

}
