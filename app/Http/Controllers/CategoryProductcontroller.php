<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
use DB;

class CategoryProductcontroller extends Controller
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


    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.add_category_product');
       
    }

    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product', $all_category_product);
        return view('admin_layout')->with('admin.add_category_product', $manager_category_product);
    }

    public function save_category_product(request $REQUEST){
        $this->AuthLogin();
        $data = array();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
       
        $data['category_name'] = $REQUEST->category_product_name;
        $data['category_desc'] = $REQUEST->category_product_desc;
        $data['category_status'] = $REQUEST->category_product_status;
        $data['created_at'] = $now;
        $data['updated_at'] = $now;
        DB::table('tbl_category_product')->insert($data); 
        session::put('message', 'Thêm danh mục sản phẩm thành công');
        return redirect::to('add-category-product');
    }


    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]); 
        session::put('message', 'Kích hoạt danh mục sản phẩm thành công');
        return redirect::to('all-category-product');
    }


    public function active_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]); 
        session::put('message', 'Kích hoạt danh mục sản phẩm thành công');
        return redirect::to('all-category-product');
    }


    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id', $category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
        
        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }

    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete(); 
        session::put('message', 'Xóa danh mục sản phẩm thành công');
        return redirect::to('all-category-product');

    }

    public function update_category_product(Request $REQUEST, $category_product_id){
        $this->AuthLogin();
        $data = array();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $data['category_name'] = $REQUEST->category_product_name;
        $data['category_desc'] = $REQUEST->category_product_desc;
        $data['updated_at'] = $now;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data); 
        session::put('message', 'Cập nhật danh mục sản phẩm thành công');
        return redirect::to('all-category-product');
    }


    //end admin-page function

    //start product page fuction

    public function show_category_home($category_id){

        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id','asc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderby('brand_id','desc')->get();
          
        $category_by_id = DB::table('tbl_product')->join('tbl_category_product', 'tbl_product.category_id','=','tbl_category_product.category_id')
        ->where('tbl_product.category_id', $category_id)->Paginate(4);

        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id', $category_id)->limit(1)->get();

        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            
            if($sort_by == 'desc'){
                $category_by_id = DB::table('tbl_product')->join('tbl_category_product', 'tbl_product.category_id','=','tbl_category_product.category_id')
                ->where('tbl_product.category_id', $category_id)
                ->orderBy('product_price', 'DESC')->Paginate(4)->appends(request()->query());
               
            }
            elseif($sort_by == 'asc'){
                $category_by_id = DB::table('tbl_product')->join('tbl_category_product', 'tbl_product.category_id','=','tbl_category_product.category_id')
                ->where('tbl_product.category_id', $category_id)->orderBy('product_price', 'ASC')->Paginate(4)->appends(request()->query());
            }
            elseif($sort_by == 'az'){
                $category_by_id = DB::table('tbl_product')->join('tbl_category_product', 'tbl_product.category_id','=','tbl_category_product.category_id')
                ->where('tbl_product.category_id', $category_id)->orderBy('product_name', 'ASC')->Paginate(4)->appends(request()->query());
            }
            elseif($sort_by == 'za'){
                $category_by_id = DB::table('tbl_product')->join('tbl_category_product', 'tbl_product.category_id','=','tbl_category_product.category_id')
                ->where('tbl_product.category_id', $category_id)->orderBy('product_name', 'DESC')->Paginate(4)->appends(request()->query());
            }

            else{
                $category_by_id = DB::table('tbl_product')->join('tbl_category_product', 'tbl_product.category_id','=','tbl_category_product.category_id')
                ->where('tbl_product.category_id', $category_id)->orderBy('category_id', 'ASC');
            }


        }
        
      
        

        
       
        
        return view('pages.category.show_category')->with('category', $cate_product)->with('brand', $brand_product)
        ->with('category_by_id', $category_by_id)->with('category_name', $category_name);
    
        
    }

    

}
