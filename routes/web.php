<?php

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

Route::get('/', 'Buyer\ProductsController@getAllImages');
Route::get('guest/productdetail/{product_id}', 'Buyer\ProductsController@getGuestProductDetail');
Route::post('guest/order/{product_id}', 'Buyer\PaymentsController@toGuestPaymentPage');
Route::post('guest/pay/{product_ID}/{quantity}/{amount}', 'Buyer\PaymentsController@payGuest');
Route::get('guest/report/{customername}/{partnumber}/{quantity}/{description}/{total_price}/{view_type}/', 'Buyer\PaymentsController@report');

Route::get('signin', function () {
    return view('login');
});

Route::get('signin/{s_type}',function(Request $request ,$s_type){
    $m_res = ['s_type'=>$s_type];
    return view('login',['sign_type'=>$m_res]);
});

Route::get('contact_us', function(){
    return view('contactus');
});

Route::get('about_me', function(){
    return view('aboutme');
});

//auth routes
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');
Route::post('buyerregister', 'AuthController@buyerRegister');
Route::post('adminregister', 'AuthController@adminRegister');
Route::post('buyerlogin', 'AuthController@buyerLogin');

Route::group(['middleware'=>['owner']],function (){
    Route::get('owner', function (){
        return view('owner');
    });
    Route::get('owner/admins', 'Owner\OwnerController@getAdmins');
    Route::get('owner/buyers', 'Owner\OwnerController@getBuyers');
    Route::get('owner/removebuyer/{user_id}', 'Owner\OwnerController@removeBuyer');
    Route::get('owner/removeadmin/{user_id}', 'Owner\OwnerController@removeAdmin');
    Route::get('owner/allproducts', 'Owner\OwnerController@allProducts');
    Route::get('owner/productdetail/{product_id}', 'Owner\OwnerController@productDetail');
    Route::get('owner/removeoneproduct/{product_id}', 'Owner\OwnerController@removeOneProduct');
    Route::post('owner/updateproduct/{product_id}', 'Owner\OwnerController@updateProduct');
    Route::get('owner/purchasebyid', 'Owner\OwnerController@purchaseByProductID');
    Route::get('owner/purchaseeachmonth', 'Owner\OwnerController@purchaseEachMonth');

    //Admin request routes
    Route::get('owner/adminrequest', 'Owner\OwnerController@getAdminRequest');
    Route::get('owner/acceptrequest/{request_id}', 'Owner\OwnerController@acceptRequest');
    Route::get('owner/rejectrequest/{request_id}', 'Owner\OwnerController@rejectRequest');

    //categories routes
    Route::get('owner/categories', 'Owner\OwnerController@getCategories');
    Route::get('owner/addcategorypage', function (){
        return view('owner/addcategory');
    });
    Route::post('owner/addcategory', 'Owner\OwnerController@addCategory');
    Route::get('owner/removecategory/{category_id}', 'Owner\OwnerController@removeCategory');
    Route::get('owner/editcategory/{category_id}', 'Owner\OwnerController@editCategory');
    Route::post('owner/updatecategory/{category_id}', 'Owner\OwnerController@updateCategory');

    //sub category routes
    Route::get('owner/subcategories/{category_id}', 'Owner\OwnerController@getSubCategories');
    Route::get('owner/addsubcategorypage/{category_id}', 'Owner\OwnerController@getCategoryId');
    Route::post('owner/addsubcategory/{category_id}', 'Owner\OwnerController@addSubCategory');
    Route::get('owner/editsubcategory/{subcategory_id}', 'Owner\OwnerController@editSubCategory');
    Route::post('owner/updatesubcategory/{subcategory_id}', 'Owner\OwnerController@updateSubCategory');
    Route::get('owner/removesubcategory/{subcategory_id}', 'Owner\OwnerController@removeSubCategory');

    //products routes
    Route::get('owner/products/{subcategory_id}', 'Owner\OwnerController@getProducts');
    Route::get('owner/addproductpage/{subcategory_id}', 'Owner\OwnerController@getSubCategoryId');
    Route::post('owner/addproduct/{subcategory_id}', 'Owner\OwnerController@addProduct');
    Route::get('owner/removeproduct/{product_id}', 'Owner\OwnerController@removeProduct');

    //transaction routes
    Route::get('owner/year', 'Owner\OwnerController@getYear');
    Route::get('owner/transaction/{year}', 'Owner\OwnerController@getMonth');
    Route::get('owner/transaction/{year}/{month}', 'Owner\OwnerController@allTransaction');

    //user profile
    Route::get("owner/userprofile",'Owner\OwnerController@getUserProfile');
});

Route::group(['middleware'=>['admin']],function (){
    //admin dashboard routes
    Route::get('admin', function (){
        return view('admin');
    });

    //buyers routes
    Route::get('buyers', 'Admin\BuyerController@getBuyers');
    Route::get('removebuyer/{user_id}', 'Admin\BuyerController@removeBuyer');

    //categories routes
    Route::get('categories', 'Admin\ProductsController@getCategories');

    Route::post('addcategory', 'Admin\ProductsController@addCategory');
    Route::get('removecategory/{category_id}', 'Admin\ProductsController@removeCategory');
    Route::get('editcategory/{category_id}', 'Admin\ProductsController@editCategory');
    Route::post('updatecategory/{category_id}', 'Admin\ProductsController@updateCategory');

    //sub category routes
    Route::get('subcategories/{category_id}', 'Admin\ProductsController@getSubCategories');
    Route::get('addsubcategorypage/{category_id}', 'Admin\ProductsController@getCategoryId');
    Route::post('addsubcategory/{category_id}', 'Admin\ProductsController@addSubCategory');
    Route::get('editsubcategory/{subcategory_id}', 'Admin\ProductsController@editSubCategory');
    Route::post('updatesubcategory/{subcategory_id}', 'Admin\ProductsController@updateSubCategory');
    Route::get('removesubcategory/{subcategory_id}', 'Admin\ProductsController@removeSubCategory');

    //products routes
    Route::get('products/{subcategory_id}', 'Admin\ProductsController@getProducts');
    Route::get('addproductpage/{subcategory_id}', 'Admin\ProductsController@getSubCategoryId');
    Route::post('addproduct/{subcategory_id}', 'Admin\ProductsController@addProduct');
    Route::get('removeproduct/{product_id}', 'Admin\ProductsController@removeProduct');
    Route::get('removeoneproduct/{product_id}', 'Admin\ProductsController@removeOneProduct');
    Route::get('productdetail/{product_id}', 'Admin\ProductsController@productDetail');
    Route::post('updateproduct/{product_id}', 'Admin\ProductsController@updateProduct');
    Route::get('allproducts', 'Admin\ProductsController@allProducts');

    //transaction routes
    Route::get('year', 'Admin\TransactionController@getYear');
    Route::get('transaction/{year}', 'Admin\TransactionController@getMonth');
    Route::get('transaction/{year}/{month}', 'Admin\TransactionController@allTransaction');

    //user profile
    Route::get("userprofile/{email}",'Admin\BuyerController@getUserProfile');
    // Route::get('userprofile',function(){
    //     return view('userprofile');
    // });
});

Route::group(['middleware'=>['user']],function (){
    //buyer dashboard routes
    // Route::get('/', 'Buyer\ProductsController@getAllImages');
    Route::get('buyer', function (){
        return view('buyer');
    });
    Route::get('buyer/success',function(){
        return view('buyer',['succ'=>'1']);
    });
    //contact us& about me
    //products routes
    Route::get('buyer/allproducts', 'Buyer\ProductsController@getAllProducts');
    Route::get('buyer/productdetail/{product_id}', 'Buyer\ProductsController@getProductDetail');

    //payment routes
    Route::post('buyer/order/{product_id}', 'Buyer\PaymentsController@toPaymentPage');
    Route::post('buyer/pay/{product_ID}/{quantity}/{amount}', 'Buyer\PaymentsController@pay');
    Route::get('buyer/transaction', 'Buyer\TransactionController@transactionHistory');
    Route::get('buyer/writereviewpage/{product_ID}', 'Buyer\TransactionController@productToEvaluate');
    Route::post('buyer/writereview/{product_ID}', 'Buyer\TransactionController@writeReview');
    Route::get('buyer/review', 'Buyer\TransactionController@getReview');
    Route::get('buyer/report/{customername}/{partnumber}/{quantity}/{description}/{total_price}/{email_addr}/{view_type}', 'Buyer\PaymentsController@report');
    //user profile
    Route::get("userprofile/{email}",'Admin\BuyerController@getUserProfile');
    // Route::get('userprofile',function(){
    //     return view('userprofile');
    // });
});