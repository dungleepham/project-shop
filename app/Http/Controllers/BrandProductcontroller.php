<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use DB;
use Carbon\Carbon;

class BrandProductcontroller extends Controller
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

    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand_product');
       
    }

    public function all_brand_product(){
        $this->AuthLogin();
        $all_brand_product = DB::table('tbl_brand_product')->get();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
        return view('admin_layout')->with('admin.add_brand_product', $manager_brand_product);
    }

    public function save_brand_product(request $REQUEST){
        $this->AuthLogin();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $data = array();
        $data['brand_name'] = $REQUEST->brand_product_name;
        $data['brand_desc'] = $REQUEST->brand_product_desc;
        $data['brand_status'] = $REQUEST->brand_product_status;
        $data['created_at'] = $now;
        $data['updated_at'] = $now;

        DB::table('tbl_brand_product')->insert($data);
        session::put('message', 'Thêm thương hiệu thành công');
        return redirect::to('add-brand-product');
    }


    public function unactive_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]); 
        session::put('message', 'Kích hoạt thương hiệu thành công');
        return redirect::to('all-brand-product');
    }


    public function active_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]); 
        session::put('message', 'Kích hoạt thương hiệu thành công');
        return redirect::to('all-brand-product');
    }


    public function edit_brand_product($brand_product_id){
        $this->AuthLogin();
        $edit_brand_product = DB::table('tbl_brand_product')->where('brand_id', $brand_product_id)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
        
        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }

    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->delete(); 
        session::put('message', 'Xóa thương hiệu thành công');
        return redirect::to('all-brand-product');

    }

    public function update_brand_product(Request $REQUEST, $brand_product_id){
        $this->AuthLogin();
        $data = array();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $data['brand_name'] = $REQUEST->brand_product_name;
        $data['brand_desc'] = $REQUEST->brand_product_desc;
        $data['updated_at'] = $now; 
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update($data); 
        session::put('message', 'Cập nhật thương hiệu thành công');
        return redirect::to('all-brand-product');
    }

    public function show_brand_home($brand_id){

        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id','desc')->get();

        $brand_by_id = DB::table('tbl_product')->join('tbl_brand_product', 'tbl_product.brand_id','=','tbl_brand_product.brand_id')
        ->where('tbl_product.brand_id', $brand_id)->Paginate(4);
        $brand_name = DB::table('tbl_brand_product')->where('tbl_brand_product.brand_id', $brand_id)->limit(1)->get();
        return view('pages.brand.show_brand')->with('category', $cate_product)->with('brand', $brand_product)->with('brand_by_id', $brand_by_id)
        ->with('brand_name', $brand_name);
    }
}
