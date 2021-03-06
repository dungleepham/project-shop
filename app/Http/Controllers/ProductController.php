<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
session_start();
use DB;



class ProductController extends Controller
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

    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();
        
        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
       
    }

    public function all_product(){
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id', 'desc')->get();
        $manager_product = view('admin.all_product')->with('all_product', $all_product);
        return view('admin_layout')->with('admin.add_product', $manager_product);
    }

    public function save_product(request $REQUEST){
        $this->AuthLogin();
        $data = array();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $data['product_name'] = $REQUEST->product_name;
        $data['product_price'] = $REQUEST->product_price;
        $data['product_quantity'] = $REQUEST->product_quantity;
        $data['product_desc'] = $REQUEST->product_desc;
        $data['product_content'] = $REQUEST->product_content;
        $data['category_id'] = $REQUEST->product_cate;
        $data['brand_id'] = $REQUEST->product_brand;
        $data['product_status'] = $REQUEST->product_status;
        $data['created_at'] = $now;
        $data['updated_at'] = $now;
        $data['product_image'] = $REQUEST->product_status;
        $get_image = $REQUEST->file('product_image');

       if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/products', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            session::put('message', 'Th??m s???n ph???m th??nh c??ng');
            return redirect::to('add-product');
        }
        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        session::put('message', 'Th??m s???n ph???m th??nh c??ng');
        return redirect::to('/all-product');
    }


    public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]); 
        session::put('message', 'Kh??ng k??ch ho???t s???n ph???m th??nh c??ng');
        return redirect::to('all-product');
    }


    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]); 
        session::put('message', 'K??ch ho???t s???n ph???m th??nh c??ng');
        return redirect::to('all-product');
    }


    public function edit_product($product_id){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_product', $cate_product)
        ->with('brand_product', $brand_product) ;
        
        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }

    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete(); 
        session::put('message', 'X??a s???n ph???m th??nh c??ng');
        return redirect::to('all-product');

    }

    public function update_product(Request $REQUEST, $product_id){
        $this->AuthLogin();
        $data = array();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $data['product_name'] = $REQUEST->product_name;
        $data['product_price'] = $REQUEST->product_price;
        $data['product_quantity'] = $REQUEST->product_quantity;
        $data['product_desc'] = $REQUEST->product_desc;
        $data['product_content'] = $REQUEST->product_content;
        $data['category_id'] = $REQUEST->product_cate;
        $data['brand_id'] = $REQUEST->product_brand;
        $data['product_status'] = $REQUEST->product_status;
        $data['product_image'] = $REQUEST->product_status;
        $data['updated_at'] = $now;
        $get_image = $REQUEST->file('product_image');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/products', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            session::put('message', 'C???p nh???t s???n ph???m th??nh c??ng');
            return redirect::to('add-product');
        }
        $data['product_image'] = '';
        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        session::put('message', 'C???p nh???t s???n ph???m th??nh c??ng');
        return redirect::to('all-product');

    }

        //end admin page
    public function show_details_product($product_id){
            
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id','desc')->get();

        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id', $product_id)->get();

        foreach($details_product as $key => $value){
            $category_id = $value->category_id;
        }
       
      

        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id', $category_id)->whereNotIn('tbl_product.product_id', [$product_id])->limit(3)->get();


        return view('pages.sanpham.details_product')->with('category', $cate_product)->with('brand', $brand_product)->with('details_product', $details_product)
        ->with('relate', $related_product);
        
    }
}
