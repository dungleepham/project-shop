<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use PDF;
use Illuminate\Support\Facades\Redirect;
use DB;
use Carbon\Carbon;

session_start();


class CheckoutController extends Controller
{

    public function PaymentLogin(){
        $checkout_id = Session::get('customer_id');
        if($checkout_id){
        }
        else{
            return redirect::to('/login-checkout');
        }
    }

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
        $this->PaymentLogin();
        $customer_id = Session:: get('customer_id');

        $shipping = DB::table('tbl_shipping')->where('customer_id', $customer_id)->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id','desc')->get();
        
        return view('pages.checkout.show_checkout')->with('category', $cate_product)->with('brand', $brand_product)->with('shipping',$shipping);
    }

   

    public function payment(){
        $this->PaymentLogin();
        $customer_id = Session:: get('customer_id');
       

        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id','desc')->get();
        $shipping = DB::table('tbl_shipping')->where('customer_id', $customer_id)->get();


        return view('pages.checkout.payment')->with('category', $cate_product)->with('brand', $brand_product)->with('shipping', $shipping);
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
        $result = DB::table('tbl_customers')
        ->where('customer_phone', $phone)->where('customer_password', $password)->first();

       

        if($result){
            session::put('customer_id', $result->customer_id);
            session::put('customer_name', $result->customer_name);
            session::put('customer_address', $result->customer_address);
            session::put('customer_phone', $result->customer_phone);

          
            
           /* $shipping_data = array();
            $now = Carbon::now('Asia/Ho_Chi_Minh');
            $shipping_data['shipping_name'] = session::get('customer_name');
            $shipping_data['shipping_phone'] = $REQUEST->phone;
            $shipping_data['shipping_address'] = session::get('customer_address');
            $hipping_data['created_at'] = $now;
            $hipping_data['updated_at'] = $now;
            $shipping_id = DB::table('tbl_shipping')->insertGetId($shipping_data);
            
            session::put('shipping_id', $shipping_id);*/

            return redirect::to('/trang-chu');
        }else{
            Session::put('message', 'Sai tài khoản hoặc mật khẩu!');
            return redirect::to('/login-checkout');
        }
       
    }

    public function save_checkout_customer(request $REQUEST){
        $data = array();
        $customer_id = Session::get('customer_id');
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $data['shipping_name'] = $REQUEST->name;
        $data['customer_id'] = $customer_id;
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
        $this->PaymentLogin();
        $ajax_content = Session::get('cart');

        
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
        $order_data['shipping_address'] = $REQUEST->shipping_address;
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = 0;
        $order_data['order_status'] = 'Đã đặt hàng';
        $order_data['created_at'] = $now;
        $order_data['updated_at'] = $now;
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        
        //insert order details
        $total = 0;
        foreach($ajax_content as $key => $v_content)
        {   $total += $v_content['product_price']*$v_content['product_quantity'];
            $order_details_data = array();
            $order_details_data['order_id'] = $order_id;
            $order_details_data['product_id'] = $v_content['product_id'];
            $order_details_data['product_name'] = $v_content['product_name'];
            $order_details_data['product_price'] = $v_content['product_price'];
            $order_details_data['product_quantity'] = $v_content['product_quantity'];
            $order_details_data['created_at'] = $now;
            $order_details_data['updated_at'] = $now;
            $result = DB::table('tbl_order_details')->insert($order_details_data);
            
        }
        if($result){
            DB::table('tbl_order')->where('order_id', $order_id)->update(['order_total'=> $total]);
            Session::put('cart', null);
            // $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','asc')->get();
            // $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id','desc')->get();
            
            // return view('pages.checkout.handcash');//->with('category', $cate_product)->with('brand', $brand_product);
            return redirect('/complete_checkout');
        }

    }

    public function complete_checkout(){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id','desc')->get();
        return view('pages.checkout.handcash')->with('category', $cate_product)->with('brand', $brand_product);;
    }

   
    public function vnpay_payment(Request $REQUEST) {
        $ajax_content = Session::get('cart');

        $data = $REQUEST->all();
       
        $shipping_address = Session::put('addrs', $data['shipping_address']);
        $total = 0;
        foreach($ajax_content as $key => $v_content)
        {   $total += $v_content['product_price']*$v_content['product_quantity'];

        }
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost/shoplaravel/vnpay_return";
        $vnp_TmnCode = "ZWHE76WJ";//Mã website tại VNPAY 
        $vnp_HashSecret = "FINCWKGUYYBTEQVYJRPSKYCQUFYHXDQN"; //Chuỗi bí mật
        
        $vnp_TxnRef = rand(0,50000); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh toan don hang';
        $vnp_OrderType = 'bill-payment';
        $vnp_Amount = $total * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        //$vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
           /* "vnp_ExpireDate"=>$vnp_ExpireDate,
            "vnp_Bill_Mobile"=>$vnp_Bill_Mobile,
            "vnp_Bill_Email"=>$vnp_Bill_Email,
            "vnp_Bill_FirstName"=>$vnp_Bill_FirstName,
            "vnp_Bill_LastName"=>$vnp_Bill_LastName,
            "vnp_Bill_Address"=>$vnp_Bill_Address,
            "vnp_Bill_City"=>$vnp_Bill_City,
            "vnp_Bill_Country"=>$vnp_Bill_Country,
            "vnp_Inv_Phone"=>$vnp_Inv_Phone,
            "vnp_Inv_Email"=>$vnp_Inv_Email,
            "vnp_Inv_Customer"=>$vnp_Inv_Customer,
            "vnp_Inv_Address"=>$vnp_Inv_Address,
            "vnp_Inv_Company"=>$vnp_Inv_Company,
            "vnp_Inv_Taxcode"=>$vnp_Inv_Taxcode,
            "vnp_Inv_Type"=>$vnp_Inv_Type*/
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            return redirect($vnp_Url);
        //     // vui lòng tham khảo thêm tại code demo
    }

    public function vnpay_return(Request $REQUEST){
        
       
        $ajax_content = Session::get('cart');
        $shipping_address = Session::get('addrs');

        
        $data = array();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $data['payment_method'] = "online";
        $data['payment_status'] = 'Đang xử lý';
        $data['created_at'] = $now;
        $data['updated_at'] = $now;
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //insert order

        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_address'] = $shipping_address;
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = 0;
        $order_data['order_status'] = 'Đã đặt hàng';
        $order_data['created_at'] = $now;
        $order_data['updated_at'] = $now;
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

         //insert order details
         $total = 0;
         foreach($ajax_content as $key => $v_content)
         {   $total += $v_content['product_price']*$v_content['product_quantity'];
             $order_details_data = array();
             $order_details_data['order_id'] = $order_id;
             $order_details_data['product_id'] = $v_content['product_id'];
             $order_details_data['product_name'] = $v_content['product_name'];
             $order_details_data['product_price'] = $v_content['product_price'];
             $order_details_data['product_quantity'] = $v_content['product_quantity'];
             $order_details_data['created_at'] = $now;
             $order_details_data['updated_at'] = $now;
             $result = DB::table('tbl_order_details')->insert($order_details_data);
             
         }
         if($result){
             DB::table('tbl_order')->where('order_id', $order_id)->update(['order_total'=> $total]);
             Session::put('cart', null);
            //  $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','asc')->get();
            //  $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id','desc')->get();
             
            //  return view('pages.checkout.handcash')->with('category', $cate_product)->with('brand', $brand_product);
            return redirect('/complete_checkout');
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
    public function manage_order(Request $REQUEST){
        $this->AuthLogin();
        
        $search = $REQUEST['search'];
        if($search != ""){
            $all_order = DB::table('tbl_order')
            ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
            ->select('tbl_order.*','tbl_customers.customer_name')->where('tbl_order.order_status', 'Đã đặt hàng')->where('tbl_order.order_id', '=' , $search)->orwhere('tbl_order.order_status', 'Đã đặt hàng')->where('tbl_customers.customer_name', 'LIKE' , "%$search%")
            ->get();
        }else{
            $all_order = DB::table('tbl_order')
            ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
            ->select('tbl_order.*','tbl_customers.customer_name')->where('tbl_order.order_status', 'Đã đặt hàng')
            ->orderby('tbl_order.order_id', 'asc')->get();
        }

       
        
        $manager_order = view('admin.manage_order')->with('all_order', $all_order);
        
        return view('admin_layout')->with('admin.manage_order', $manager_order);
    }

    //chi tiết các đơn hàng chưa duyệt
    public function view_order($orderId){
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
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
    public function view_confirm_order(Request $REQUEST){
        $this->AuthLogin();
        $search = $REQUEST['search'];
        if($search != ""){
            $confirm_order = DB::table('tbl_order')
            ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
            ->select('tbl_order.*','tbl_customers.customer_name')->where('tbl_order.order_status', 'Đã xác nhận')->where('tbl_order.order_id', '=', $search)->orwhere('tbl_order.order_status', 'Đã xác nhận')->where('tbl_customers.customer_name', 'LIKE', "%$search%")
            ->get();
        }
        else{
            $confirm_order = DB::table('tbl_order')
            ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
            ->select('tbl_order.*','tbl_customers.customer_name')->where('tbl_order.order_status', 'Đã xác nhận')
            ->orderby('tbl_order.order_id', 'asc')->get();
    
        }

        
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

    public function view_received_order(Request $REQUEST){
        $this->AuthLogin();

        $search = $REQUEST['search'];
        if($search != "")
        {
            $received_order = DB::table('tbl_order')
            ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
            ->select('tbl_order.*','tbl_customers.customer_name')->where('tbl_order.order_status', 'Đã nhận được hàng')
            ->where('tbl_order.order_id', '=', $search)->orwhere('tbl_order.order_status', 'Đã nhận được hàng')->where('tbl_customers.customer_name', 'LIKE', "%$search%")
            ->get();
        }
        else{
            $received_order = DB::table('tbl_order')
            ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
            ->select('tbl_order.*','tbl_customers.customer_name')->where('tbl_order.order_status', 'Đã nhận được hàng')
            ->orderby('tbl_order.order_id', 'asc')->get();
        }

       

        $manager_received_order = view('admin.view_receive')->with('received_order', $received_order);

        
        return view('admin_layout')->with('admin.view_receive', $manager_received_order);

    }


    public function print_order($orderId){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($orderId));
        return $pdf->stream();
    }

    public function print_order_convert($orderId){
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $data=array();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->where('tbl_order.order_id', $orderId)
        ->get();
        
        $order_detail = DB::table('tbl_order')
        ->join('tbl_order_details','tbl_order.order_id', '=', 'tbl_order_details.order_id')
        ->where('tbl_order.order_id', $orderId)
        ->get();

        
        
    
       
        $output = '';
        $output .= '<style>
        body{
                font-family: Dejavu Sans;
        }
        table{
            border: 1px, solid black;
            border-collapse: collapse;
            
        }
        table , tr, th, td{
            border: 1px, solid black;
            padding: 8px;
            margin 10px;
        }
        </style>
        <div>
                    <h2 > Cửa hàng nội thất Tiến Đạt </h2>
                   
        </div>
         
            <span>Địa chỉ: Khóm 4, Thị trấn Cái Nhum, huyện Mang Thít, tỉnh Vĩnh Long</span>
            <br>
            <span>Số điện thoại: 0964618627 </span>
            <br><br><br>

            <h1 style="color:red"> <center> Hóa đơn bán hàng </center> </h1>';
            foreach($order_by_id as $key => $val){
            $output .= '
            <p>Tên khách hàng:  '.$val->customer_name.'</p>
            <p>Địa chỉ:  '.$val->customer_address.'  </p>
            <p>Số điện thoại:  '.$val->customer_phone.' </p> <br><br><br>';
            }
            $output .= '
            <table>
                <thead>
                    <tr>
                        <th style="width:5%" >STT</th>
                        <th style="width:40%" >Tên Sản Phẩm</th>
                        <th style="width:15%" >SL</th>
                        <th style="width:15%" >Đơn Giá</th>
                        <th style="width:25%" >Thành Tiền</th>
                    </tr>
                </thead>
                <tbody>';
                $tong = 0;
                $now = Carbon::now('Asia/Ho_Chi_Minh');
                foreach($order_detail as $key => $value){
                $tong += $value->product_price * $value->product_quantity;
                $output .= '
                    <tr>
                        <td style="text-align: center"> '.++$key.' </td>
                        <td> '.$value->product_name.'</td>
                   
                        <td style="text-align: center">'.$value->product_quantity.' </td>

                        <td style="text-align: center">'.number_format($value->product_price).' VND </td>

                        <td style="text-align: center">'.number_format($value->product_price * $value->product_quantity).' VND </td>
                                            
                    </tr>
                    
                    
                    '; }
                    $output .= '
                        <td colspan="2">Tổng cộng: </td>  
                          
                          
                        <td colspan="3" style="text-align: center" >'. number_format($tong).' VND </td>  
                        
                </tbody>
                
            </table>';

            $output .= '
                    <p>Thành tiền: (Bằng chữ).................................................................................................
                    ...................................................................................................................................... </a><br><br>
                    <span style="float:right">Ngày '.$now->day.' Tháng '.$now->month.' năm '.$now->year.' </span><br><br>

                    <span style="margin-left: 15px; font-size:20px">Khách Hàng</span> 
                    <span style="float:right; font-size: 20px">Người Bán Hàng</span> 
            ';



        
            
         
      return $output;
    }

   

}
