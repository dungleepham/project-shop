<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use DB;
use Gloudemans\Shoppingcart\Facades\Cart;


session_start();

class CartController extends Controller
{
    public function show_cart(){
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id','desc')->get();
        return view('pages.cart.show_cart')->with('category', $cate_product)->with('brand', $brand_product);
        }

    public function save_cart(request $REQUEST){
       
         $product_id = $REQUEST->productid_hidden;
         $quantity = $REQUEST->qty;
         $product_info = DB::table('tbl_product')->where('product_id',$product_id)->first();


         $data['id'] = $product_info->product_id;
         $data['qty'] = $quantity;
         $data['name'] = $product_info->product_name;
         $data['price'] = $product_info->product_price;
         $data['options']['image'] = $product_info->product_image;
         $data['weight'] = $product_info->product_price;
         Cart::add($data);

         return redirect::to('show-cart');
    }

    public function delete_to_cart($rowId){
        Cart::update($rowId, 0);
        return redirect::to('show-cart');
    }

    public function delete_to_cart_home($rowId){
        Cart::update($rowId, 0);
        return redirect::to('/trang-chu');
    }

   public function update_cart_quantity(request $REQUEST){
        $rowId = $REQUEST->rowId_cart;
        $qty = $REQUEST->cart;
        Cart::update($rowId, $qty);
        return redirect::to('show-cart');
   }
  

   public function add_cart_ajax(request $REQUEST){
        
        $slton = 0;
        $notification = array();
        $notification['error'] = 0; 
        $data = $REQUEST->all();
        $session_id = substr(md5(microtime()),rand(0,30),5);
        $cart = Session::get('cart');
        $kq = DB::table('tbl_product')->where('product_id', $data['cart_product_id'])->select('product_quantity')->get();
        
        foreach ($kq as $k => $val) {
            $slton = $val->product_quantity;
        }
        if($cart == true){
            $is_available = 0;
            foreach($cart as $key => $val){
                if($val['product_id'] == $data['cart_product_id']){
                    $is_available++;
                    $session_id = $key;
                }
            }
                if($is_available == 0){
                    if($data['cart_product_quantity'] <= $slton){
                    $cart[] = array(
                        'session_id' => $session_id,
                        'product_name' => $data['cart_product_name'],
                        'product_id' => $data['cart_product_id'],
                        'product_image' => $data['cart_product_image'],
                        'product_quantity' => $data['cart_product_quantity'],
                        'product_price' => $data['cart_product_price']
        
                    );
                    Session::put('cart', $cart);
                    }else{
                        $notification['error'] = 1;
                    }
                   
                
                }else{
                    $quantity_new = $cart[$session_id]['product_quantity']+ $data['cart_product_quantity'];
                    if ( $quantity_new <= $slton ) {
                        $cart[$session_id]['product_quantity']=$cart[$session_id]['product_quantity']+ $data['cart_product_quantity'];
                        Session::put('cart',$cart);
                    }else{
                        $notification['error']=1;
                    }
                }
        }else{
            if($data['cart_product_quantity']<=$slton){
                    $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_quantity' => $data['cart_product_quantity'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart', $cart);
            }else{
                $notification['error']=1;
            }
            
        }
        
        Session::save();
        echo json_encode($notification);
   }


   public function show_cart_ajax(request $REQUEST){

    $meta_desc = "Giỏ hàng của bạn";
    $meta_keywords = "Giỏ hàng ajax";
    $meta_title = "Giỏ hàng Ajax";
    $url_canonical = $REQUEST->url();

    $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','asc')->get();
    $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id','desc')->get();
    return view('pages.cart.show_cart_ajax')->with('category', $cate_product)->with('brand', $brand_product);
   }

   public function update_cart(request $REQUEST){
        $data = $REQUEST->all();
        $cart = Session::get('cart');
        if($cart == true){
            foreach($data['cart_quantity'] as $key => $qty){
                foreach($cart as $session => $val){
                    if($val['session_id'] == $key){
                        $cart[$session]['product_quantity'] = $qty;
                    }
                }
            } 
                Session::put('cart', $cart);
                return redirect()->back()->with('message', 'cập nhật số lượng thành công');
        }else{
            return redirect()->back()->with('message', 'cập nhật không thành công');
        }
   }
   public function delete_cart_product($session_id){
        $cart = Session::get('cart');
        if($cart == true){
            foreach($cart as $key => $val){
                if($val['session_id'] == $session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('message', 'xóa thành công');
        }
        else redirect()->back()->with('message', 'xóa không thành công');
   }

   public function delete_all_product(){
        $cart = Session::get('cart');
        if($cart == true){
            //Session::destroy();
            Session::forget('cart');
            return redirect()->back()->with('message', 'xóa thành công');
        }
   }

   public function load_cart_ajax(){
    
    }


}
