<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('login');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('change-password', 'ChangePasswordController@index');
Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

//product-code
Route::resource('admin/product-code', 'Admin\ProductCodeController');

//role
Route::resource('admin/role', 'Admin\RoleController');
Route::get('admin/role/active/{id}', 'Admin\RoleController@active_role')->name('active-role');
Route::get('admin/role/inactive/{id}', 'Admin\RoleController@inactive_role')->name('inactive-role');
//product
Route::resource('admin/product', 'Admin\ProductController');
Route::get('admin/product/active/{id}', 'Admin\ProductController@active_product')->name('active-product');
Route::get('admin/product/inactive/{id}', 'Admin\ProductController@inactive_product')->name('inactive-product');
Route::post('admin/quantity/update', 'Admin\ProductController@update_quantity')->name('update-quantity');
Route::post('admin/quantity/reduce', 'Admin\ProductController@reduce_quantity')->name('reduce-quantity');
Route::get('admin/add-product-stock/{id}', 'Admin\ProductController@add_product_stock')->name('add-product-stock');
Route::post('admin/get-reduce-product-information', 'Admin\ProductController@get_reduce_product_information')->name('get-reduce-product-information');
Route::get('admin/product-index', 'Admin\ProductController@product_index')->name('product-index');


Route::get('admin/get-product-discount-information','Admin\ProductController@get_product_discount_information')->name('get-product-discount-information');
//wear house
Route::resource('admin/wear-house', 'Admin\WearHouseController');
Route::get('admin/wearhouse/active/{id}', 'Admin\WearHouseController@active_wear_house')->name('active-wear-house');
Route::get('admin/wearhouse/inactive/{id}', 'Admin\WearHouseController@inactive_wear_house')->name('inactive-wear-house');
Route::post('admin/get-wearhouseProduct-history', 'Admin\WearHouseController@get_wearhouseProduct_history')->name('get-wearhouseProduct-history');

//category
Route::resource('admin/category', 'Admin\CategoryController');
Route::get('admin/category/active/{id}', 'Admin\CategoryController@active_category')->name('active-category');
Route::get('admin/category/inactive/{id}', 'Admin\CategoryController@inactive_category')->name('inactive-category');
//brand
Route::resource('admin/brand', 'Admin\BrandController');
Route::get('admin/brand/active/{id}', 'Admin\BrandController@active_brand')->name('active-brand');
Route::get('admin/brand/inactive/{id}', 'Admin\BrandController@inactive_brand')->name('inactive-brand');
//suplier
Route::resource('admin/supplier', 'Admin\SupplierController');
Route::get('admin/supplier/active/{id}', 'Admin\SupplierController@active_supplier')->name('active-supplier');
Route::get('admin/supplier/inactive/{id}', 'Admin\SupplierController@inactive_supplier')->name('inactive-supplier');
Route::post('/admin/get-supplier-information','Admin\SupplierController@get_supplier_information')->name('get-supplier-information');
Route::post('/admin/save-supplier-payment','Admin\SupplierController@save_supplier_payment')->name('save-supplier-payment');
// Route::get('/admin/supplier-purchase','Admin\SupplierController@supplier_purchase')->name('supplier-purchase');
//supplier purchase
Route::resource('admin/supplier-purchase', 'Admin\SupplierPurchase');

//head customer
Route::resource('admin/head-customer', 'Admin\HeadCustomerController');
Route::get('admin/head-customer/active/{id}', 'Admin\HeadCustomerController@active_head_customer')->name('active-head-customer');
Route::get('admin/head-customer/inactive/{id}', 'Admin\HeadCustomerController@inactive_head_customer')->name('inactive-head-customer');
Route::post('/admin/get-head-customer-information','Admin\HeadCustomerController@get_head_customer_information')->name('get-head-customer-information');
Route::post('/admin/save-payment','Admin\HeadCustomerController@save_payment')->name('save-payment');
//customer
Route::resource('admin/customer', 'Admin\CustomerController');
Route::get('admin/online-customer', 'Admin\CustomerController@online_customer')->name('online-customer');
Route::get('admin/customer/active/{id}', 'Admin\CustomerController@active_customer')->name('active-customer');
Route::get('admin/customer/inactive/{id}', 'Admin\CustomerController@inactive_customer')->name('inactive-customer');

//user-management
Route::resource('admin/user', 'Admin\ManageUserController');
Route::get('admin/user/active/{id}', 'Admin\ManageUserController@active_user')->name('active-user');
Route::get('admin/user/inactive/{id}', 'Admin\ManageUserController@inactive_user')->name('inactive-user');
Route::get('admin/profile', 'Admin\ManageUserController@profile')->name('profile');
Route::post('admin/update-profile', 'Admin\ManageUserController@update_profile')->name('update-profile');
//distributed
Route::resource('admin/distributed', 'Admin\DistributedController');
Route::get('admin/distributed/active/{id}', 'Admin\DistributedController@active_distributed')->name('active-distributed');
Route::get('admin/distributed/inactive/{id}', 'Admin\DistributedController@inactive_distributed')->name('inactive-distributed');
Route::get('admin/distributed-products', 'Admin\DistributedController@distributed_products')->name('distributed-products');
Route::post('admin/get-distributedProduct-history', 'Admin\DistributedController@get_distributedProduct_history')->name('get-distributedProduct-history');

//transfer
Route::get('admin/wearhouse-transfer', 'Admin\TransferController@wearhouse_transfer')->name('wearhouse-transfer');
Route::post('admin/save-transfer', 'Admin\TransferController@save_transfer')->name('save-transfer');
Route::post('admin/distributed-transfer-product', 'Admin\TransferController@distributed_transfer_product')->name('distributed-transfer-product');
Route::get('admin/wearhouse-product', 'Admin\TransferController@wearhouse_product')->name('wearhouse-product');
Route::get('admin/distributed-product', 'Admin\TransferController@distributed_product')->name('distributed-product');
Route::get('admin/distributed-transfer', 'Admin\TransferController@distributed_transfer')->name('distributed-transfer');
Route::post('admin/get-product-information','Admin\TransferController@get_product__information')->name('get-product-information');
Route::post('admin/get-wearhouse-product-information','Admin\TransferController@get_wearhouse_product__information')->name('get-wearhouse-product-information');
Route::post('admin/get-product-qty-information','Admin\TransferController@get_product_qty_information')->name('get-product-qty-information');
Route::post('admin/save-ready-quantity','Admin\TransferController@save_ready_quantity')->name('save-ready-quantity');


//pos
Route::get('admin/pos-product', 'Admin\PosController@pos_product')->name('pos-product');
Route::post('admin/create-sale', 'Admin\PosController@create_sale')->name('create-sale');
Route::post('admin/create-sale-online', 'Admin\PosController@create_sale_online')->name('create-sale-online');
Route::post('admin/final-invoice', 'Admin\PosController@final_invoice')->name('final-invoice');
//pos customer
Route::get('admin/pos-customer-product', 'Admin\CustomerPosController@customer_pos_product')->name('pos-customer-product');
Route::post('admin/pos-customer-product', 'Admin\CustomerPosController@save_customer_pos_product')->name('pos-customer-product');

//cart
Route::post('admin/add-to-cart', 'Admin\CartController@add_to_cart')->name('add-to-cart');
Route::post('admin/cart-update', 'Admin\CartController@cart_update')->name('cart-update');
Route::get('admin/cart-remove/{id}', 'Admin\CartController@cart_remove')->name('cart-remove');
//assign role
Route::resource('admin/assign-role', 'Admin\AssignRoleController');
//order
Route::get('admin/manage-order', 'Admin\OrderController@manage_order')->name('manage-order');
Route::get('admin/edit-order/{id}', 'Admin\OrderController@edit_order')->name('edit-order');
Route::post('admin/final-order', 'Admin\OrderController@final_order')->name('final-order');
Route::get('admin/delete-order/{id}', 'Admin\OrderController@delete_order')->name('delete-order');
// report
Route::get('admin/customer-wise-sales', 'Admin\ReportController@customer_wise_sales')->name('customer-wise-sales');
Route::post('/admin/get-customerwise-sales','Admin\ReportController@get_customerwise_sales');
Route::get('admin/stock-report', 'Admin\ReportController@stock_report')->name('stock-report');
Route::post('admin/get-stock-report', 'Admin\ReportController@get_stock_report')->name('get-stock-report');
Route::get('admin/filter-products-sales', 'Admin\ReportController@filter_products_sales')->name('filter-products-sales');
//customer wise report
Route::get('admin/customer-daily-report', 'Admin\ReportController@customer_daily_report')->name('customer-daily-report');
Route::get('admin/customer-weekly-report', 'Admin\ReportController@customer_weekly_report')->name('customer-weekly-report');
Route::get('admin/customer-monthly-report', 'Admin\ReportController@customer_monthly_report')->name('customer-monthly-report');
Route::get('admin/customer-annual-report', 'Admin\ReportController@customer_annual_report')->name('customer-annual-report');
//product wise sales report
Route::get('admin/products-daily-report', 'Admin\ReportController@products_daily_report')->name('products-daily-report');
Route::get('admin/products-weekly-report', 'Admin\ReportController@products_weekly_report')->name('products-weekly-report');
Route::get('admin/products-monthly-report', 'Admin\ReportController@products_monthly_report')->name('products-monthly-report');
Route::get('admin/products-annual-report', 'Admin\ReportController@products_annual_report')->name('products-annual-report');
Route::post('admin/get-annual-report', 'Admin\ReportController@get_annual_report')->name('get-annual-report');
Route::get('admin/reduce-report', 'Admin\ReportController@reduce_report')->name('reduce-report');
Route::get('admin/customer-payment', 'Admin\ReportController@customer_payment')->name('customer-payment');
Route::get('admin/filter-annual-sales', 'Admin\ReportController@filter_annual_sales')->name('filter-annual-sales');
Route::get('admin/filter-weekly-sales', 'Admin\ReportController@filter_weekly_sales')->name('filter-weekly-sales');
Route::get('admin/filter-daily-sales', 'Admin\ReportController@filter_daily_sales')->name('filter-daily-sales');
Route::get('admin/date-range-report', 'Admin\ReportController@date_range_report')->name('date-range-report');
Route::get('admin/filter-date-range', 'Admin\ReportController@filter_date_range')->name('filter-date-range');
Route::get('admin/stock-history', 'Admin\ReportController@stock_history')->name('stock-history');


//color
Route::resource('/admin/color', 'Admin\ColorController');
Route::get('/admin/color/active/{id}', 'Admin\ColorController@active_color')->name('active-color');
Route::get('/admin/color/inactive/{id}', 'Admin\ColorController@inactive_color')->name('inactive-color');
//shop address
Route::resource('/admin/shop-address', 'Admin\ShopAddressController');
// Route::get('/admin/shop-address/active/{id}', 'Admin\ColorController@active_color')->name('active-color');
// Route::get('/admin/shop-address/inactive/{id}', 'Admin\ColorController@inactive_color')->name('inactive-color');
//clear-cache
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
