<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\homeController;
use App\Http\Controllers\admincontroller;
use App\Http\Controllers\CategoryProductcontroller;
use App\Http\Controllers\BrandProductcontroller;
use App\Http\Controllers\Productcontroller;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [homeController::class, 'index'] );
Route::get('/trang-chu', [homeController::class, 'index']);
Route::post('/tim-kiem', [homeController::class, 'search']);

//error pages
Route::get('/404', [homeController::class, 'error_page_404']);
Route::get('/500', [homeController::class, 'error_page_500']);

//customer page
Route::get('/customer', [homeController::class, 'show_customer_page']);
Route::get('/customer-delete-order/{order_id}', [homeController::class, 'customer_delete_order']);
Route::get('/edit-customer-info/{customer_id}', [homeController::class, 'edit_customer_infor']);
Route::post('/update-customer-info/{customer_id}', [homeController::class, 'update_customer_info']);
Route::get('/customer-details-order/{order_id}', [homeController::class, 'customer_details_order']);
Route::get('/customer-received-order/{order_id}', [homeController::class, 'customer_received_order']);

//contact
Route::get('/lien-he', [ContactController::class, 'lien_he'] );

//BACK-END

Route::get('/admin', [admincontroller::class, 'index'] );
Route::get('/dashboard', [admincontroller::class, 'show_dashboard']);
Route::post('/admin-dashboard', [admincontroller::class, 'dashboard']);
Route::get('/logout', [admincontroller::class, 'logout']);
Route::post('/load_statistic', [admincontroller::class, 'load_statistic']);



//category product
Route::get('/add-category-product', [CategoryProductcontroller::class, 'add_category_product'] );
Route::get('/all-category-product', [CategoryProductcontroller::class, 'all_category_product']);
Route::get('/edit-category-product/{category_product_id}', [CategoryProductcontroller::class, 'edit_category_product']);
Route::get('/delete-category-product/{category_product_id}', [CategoryProductcontroller::class, 'delete_category_product'] );
Route::post('/update-category-product/{category_product_id}', [CategoryProductcontroller::class, 'update_category_product']);
Route::get('/unactive-category-product/{category_product_id} ', [CategoryProductcontroller::class, 'unactive_category_product']);
Route::get('/active-category-product/{category_product_id} ', [CategoryProductcontroller::class, 'active_category_product']);
Route::post('/save-category-product', [CategoryProductcontroller::class, 'save_category_product']);



//brand product
Route::get('/add-brand-product', [brandProductcontroller::class, 'add_brand_product'] );
Route::get('/all-brand-product', [brandProductcontroller::class, 'all_brand_product']);
Route::get('/edit-brand-product/{brand_product_id}', [brandProductcontroller::class, 'edit_brand_product']);
Route::get('/delete-brand-product/{brand_product_id}', [brandProductcontroller::class, 'delete_brand_product'] );
Route::post('/update-brand-product/{brand_product_id}', [brandProductcontroller::class, 'update_brand_product']);
Route::get('/unactive-brand-product/{brand_product_id} ', [brandProductcontroller::class, 'unactive_brand_product']);
Route::get('/active-brand-product/{brand_product_id} ', [brandProductcontroller::class, 'active_brand_product']);
Route::post('/save-brand-product', [brandProductcontroller::class, 'save_brand_product']);



//product
Route::get('/add-product', [ProductController::class, 'add_product'] );
Route::get('/all-product', [ProductController::class, 'all_product']);
Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product'] );
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);
Route::get('/unactive-product/{product_id} ', [ProductController::class, 'unactive_product']);
Route::get('/active-product/{product_id} ', [ProductController::class, 'active_product']);
Route::post('/save-product', [ProductController::class, 'save_product']);


//danh muc san pham trang chu

Route::get('/danh-muc-san-pham/{category_id}', [CategoryProductController::class, 'show_category_home']); 
Route::get('/thuong-hieu-san-pham/{brand_id}', [BrandProductController::class, 'show_brand_home']); 
Route::get('/chi-tiet-san-pham/{product_id}', [ProductController::class, 'show_details_product']); 


//cart
//Route::post('/save-cart', [CartController::class, 'save_cart']);
Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity']);
Route::get('/show-cart', [CartController::class, 'show_cart']); 
Route::get('/delete-to-cart/{rowId}', [CartController::class, 'delete_to_cart']); 
Route::get('/delete-to-cart-home/{rowId}', [CartController::class, 'delete_to_cart_home']); 

// ------------------------------------------------------------------------------------------
// Cart ajax

Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax']);
Route::get('/show-cart-ajax', [CartController::class, 'show_cart_ajax']); 
Route::post('/update-cart', [CartController::class, 'update_cart']);
Route::get('/delete-cart-product/{session_id}', [CartController::class, 'delete_cart_product']); 
Route::get('/delete-all-product', [CartController::class, 'delete_all_product']); 
Route::get('/load-cart-ajax', [CartController::class, 'load_cart_ajax']); 





// ------------------------------------------------------------------------------------------

//checkout
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']); 
Route::get('/register', [CheckoutController::class, 'register']); 
Route::get('/checkout', [CheckoutController::class, 'checkout']); 
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout']); 
Route::get('/payment', [CheckoutController::class, 'payment']); 
Route::post('/add-customer', [CheckoutController::class, 'add_customer']);
Route::post('/login-customer', [CheckoutController::class, 'login_customer']);
Route::post('/save-checkout-customer', [CheckoutController::class, 'save_checkout_customer']);
Route::post('/order-place', [CheckoutController::class, 'order_place']);


//manage order
Route::get('/manage-order', [CheckoutController::class, 'manage_order']); 
Route::get('/print-order/{orderId}', [CheckoutController::class, 'print_order']); 
Route::get('/view-confirm-order', [CheckoutController::class, 'view_confirm_order']); 
Route::get('/view-order/{orderId}', [CheckoutController::class, 'view_order']); 


Route::get('/confirm-order/{orderId}', [CheckoutController::class, 'confirm_order']);
Route::get('/view-confirm/{orderId}', [CheckoutController::class, 'view_confirm']); 
Route::get('/view-received-order', [CheckoutController::class, 'view_received_order']); 
