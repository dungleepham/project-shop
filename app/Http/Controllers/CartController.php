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
  

}
