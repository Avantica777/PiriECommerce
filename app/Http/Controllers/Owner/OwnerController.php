<?php

namespace App\Http\Controllers\Owner;

use App\Models\Category;
use App\Models\Guesttransaction;
use App\Models\Product;
use App\Models\Sub_category;
use App\Models\Transaction;
use App\Models\User;
use App\Models\User_profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class OwnerController extends Controller
{
    //
    public function getBuyers(){

        $users = User::where('role', 'user')->get();
        foreach ($users as $user){
            $profile = User_profile::where('user_id', $user['id'])->get();
            $fullname = $profile[0]['firstname']." ".$profile[0]['lastname'];
            $user['fullname'] = $fullname;
            $user['gender'] = $profile[0]['gender'];
            $user['country'] = $profile[0]['country'];
            $user['picture'] = $profile[0]['profile_picture'];
        }

        return view('owner/buyers', ['users'=>$users]);
    }

    public function removeBuyer($user_id){
        User::where('id', $user_id)->delete();
        User_profile::where('user_id', $user_id)->delete();
        $transaction_ids = Transaction::where('user_id',$user_id)->select('id')->get();

        foreach ($transaction_ids as $id){
            Transaction::where('id',$id['id'])->delete();
        }
        return Redirect::to('owner/buyers');
    }

    public function getAdmins(){

        $users = User::where('role', 'admin')->get();
        foreach ($users as $user){
            $profile = User_profile::where('user_id', $user['id'])->get();
            $fullname = $profile[0]['firstname']." ".$profile[0]['lastname'];
            $user['fullname'] = $fullname;
            $user['gender'] = $profile[0]['gender'];
            $user['country'] = $profile[0]['country'];
            $user['picture'] = $profile[0]['profile_picture'];
        }

        return view('owner/admins', ['users'=>$users]);
    }

    public function removeAdmin($user_id){
        User::where('id', $user_id)->delete();
        User_profile::where('user_id', $user_id)->delete();
        $transaction_ids = Transaction::where('user_id',$user_id)->select('id')->get();

        foreach ($transaction_ids as $id){
            Transaction::where('id',$id['id'])->delete();
        }
        return Redirect::to('owner/admins');
    }

    public function allProducts(){
        $allproducts = Product::all();
        foreach ($allproducts as $allproduct){
            $subcategory_id = $allproduct['sub_category_id'];
            $subcategory = Sub_category::where('id',$subcategory_id)->value('sub_category');
            $category_id = Sub_category::where('id',$subcategory_id)->value('category_id');
            $category = Category::where('id',$category_id)->value('category');
            $allproduct['subcategory'] = $subcategory;
            $allproduct['category'] = $category;
            if ($allproduct['limit']>=$allproduct['quantity']){
                $notification = array(
                    'message' => $allproduct['product_name'].' '.'is not enough...',
                    'alert-type' => 'warning'
                );
                $allproduct['notification'] = $notification;
            }
            $multipicture = $allproduct['picture'];
            $onepicture = explode(',',$multipicture);
            $allproduct['picture'] = $onepicture[0];
        }

        return view('owner/allproducts',['products'=>$allproducts]);
    }

    public function productDetail($product_id){
        $detail = Product::where('id',$product_id)->get();
        $multipicture = $detail[0]['picture'];
        $onepicture = explode(',',$multipicture);
        $detail['allpictures'] = $onepicture;
        return view('owner/productdetail',['detail'=>$detail,'product_id'=>$product_id]);
    }

    public function removeOneProduct($product_id){
        Product::where('id',$product_id)->delete();
        return Redirect::to('owner/allproducts');
    }

    public function updateProduct(Request $request, $product_id){
        $product_name = $request['product_name'];
        $price = $request['price'];
        $description = $request['description'];
        $quantity = $request['quantity'];
        $limit = $request['limit'];

        $files = $request->file('product_picture');
        if ($files != null){
            $images=array();
            foreach($files as $file){
                $name=$file->getClientOriginalName();
                $file->move('products',$name);
                $images[]=$name;
            }

            Product::where('id',$product_id)->update(['product_name'=>$product_name,
                'price'=>$price,
                'description'=>$description,
                'quantity'=>$quantity,
                'limit'=>$limit,
                'picture'=>implode(",",$images)]);

            return Redirect::to('owner/productdetail/'.$product_id);
        }else{
            Product::where('id',$product_id)->update(['product_name'=>$product_name,
                'price'=>$price,
                'description'=>$description,
                'quantity'=>$quantity,
                'limit'=>$limit]);

            return Redirect::to('owner/productdetail/'.$product_id);
        }

    }

    //transaction Info
    public function getYear(){
        $nowyear = (int)date('Y');
        $years = [];
        for ($i=$nowyear; $i>=$nowyear-2; $i--){
            array_push($years, $i);
        }
        return view('owner/year',['years'=>$years]);
    }

    public function getMonth($year){
        $month = ['January','February','March','April','May','June','July','August','September','October','November','December'];

        return view('owner/month',['year'=>$year,'months'=>$month]);
    }

    public function allTransaction($year, $month){
        switch ($month){
            case 'January':
                $everymonth = 1;
                break;
            case 'February':
                $everymonth = 2;
                break;
            case 'March':
                $everymonth = 3;
                break;
            case 'April':
                $everymonth = 4;
                break;
            case 'May':
                $everymonth = 5;
                break;
            case 'June':
                $everymonth = 6;
                break;
            case 'July':
                $everymonth = 7;
                break;
            case 'August':
                $everymonth = 8;
                break;
            case 'September':
                $everymonth = 9;
                break;
            case 'October':
                $everymonth = 10;
                break;
            case 'November':
                $everymonth = 11;
                break;
            case 'December':
                $everymonth = 12;
                break;
        }
        $alltransactions = Transaction::whereYear('created_at',$year)->whereMonth('created_at',$everymonth)->get();
        foreach ($alltransactions as $alltransaction) {
            $buyer_id = $alltransaction['user_id'];
            $buyer_firstname = User_profile::where('user_id',$buyer_id)->value('firstname');
            $buyer_lastname = User_profile::where('user_id',$buyer_id)->value('lastname');
            $buyer_fullname = $buyer_firstname." ".$buyer_lastname;
            $product_id = $alltransaction['product_id'];
            $product_ID = Product::where('id',$product_id)->value('product_id');
            $product_name = Product::where('id',$product_id)->value('product_name');
            $sub_categoryid = Product::where('id',$product_id)->value('sub_category_id');
            $sub_category = Sub_category::where('id',$sub_categoryid)->value('sub_category');
            $category_id = Sub_category::where('id',$sub_categoryid)->value('category_id');
            $category = Category::where('id',$category_id)->value('category');
            $alltransaction['buyer'] = $buyer_fullname;
            $alltransaction['product_id'] = $product_ID;
            $alltransaction['product_name'] = $product_name;
            $alltransaction['sub_category'] = $sub_category;
            $alltransaction['category'] = $category;
        }
        $allguesttransactions = Guesttransaction::whereYear('created_at',$year)->whereMonth('created_at',$everymonth)->get();
        foreach ($allguesttransactions as $allguesttransaction) {
            $allguesttransaction['buyer'] = "Guest";
            $product_id = $allguesttransaction['product_id'];
            $product_ID = Product::where('id',$product_id)->value('product_id');
            $product_name = Product::where('id',$product_id)->value('product_name');
            $sub_categoryid = Product::where('id',$product_id)->value('sub_category_id');
            $sub_category = Sub_category::where('id',$sub_categoryid)->value('sub_category');
            $category_id = Sub_category::where('id',$sub_categoryid)->value('category_id');
            $category = Category::where('id',$category_id)->value('category');
            $allguesttransaction['product_id'] = $product_ID;
            $allguesttransaction['product_name'] = $product_name;
            $allguesttransaction['sub_category'] = $sub_category;
            $allguesttransaction['category'] = $category;
            $alltransactions[] = $allguesttransaction;
        }
        return view('owner/transaction',['alltransactions'=>$alltransactions]);
    }

    public function purchaseByProductID(){
        $alltransactions = Transaction::all('product_id');
        $tran_product_ids = [];
        foreach ($alltransactions as $id){
            array_push($tran_product_ids,$id['product_id']);
        }
        $unique_product_ids = array_unique($tran_product_ids);

        $result_ids = [];
        foreach ($unique_product_ids as $item){
            array_push($result_ids, $item);
        }

        $result = [];
        foreach ($result_ids as $result_id) {
            $individual_product = array();
            $total_quantity = 0;
            $total_price = 0;
            $products = Transaction::where('product_id',$result_id)->get();
            $product_ID = Product::where('id',$result_id)->value('product_id');
            $sub_categoryid = Product::where('id',$result_id)->value('sub_category_id');
            $product_name = Product::where('id',$result_id)->value('product_name');
            $price = Product::where('id',$result_id)->value('price');
            $sub_category = Sub_category::where('id',$sub_categoryid)->value('sub_category');
            $category_id = Sub_category::where('id',$sub_categoryid)->value('category_id');
            $category = Category::where('id',$category_id)->value('category');
            foreach ($products as $product) {
                $total_quantity += $product['quantity'];
                $total_price += $product['total_price'];
            }

            $individual_product['product_ID'] = $product_ID;
            $individual_product['product_name'] = $product_name;
            $individual_product['category'] = $category;
            $individual_product['sub_category'] = $sub_category;
            $individual_product['price'] = $price;
            $individual_product['total_quantity'] = $total_quantity;
            $individual_product['total_price'] = $total_price;
            array_push($result,$individual_product);
        }
        return view('owner/purchasebyid',['results'=>$result]);
    }

    public function purchaseEachMonth(){
        $year = date('Y');
        $month = date('m');

        $eachpurchase = Transaction::whereMonth('created_at',$month)->whereYear('created_at',$year)->get();
        $result = [];
        $individual_product = array();
        $total_quantity = 0;
        $total_price = 0;
        foreach ($eachpurchase as $item) {
            $total_quantity += $item['quantity'];
            $total_price += $item['total_price'];
        }
        $individual_product['year'] = $year;
        $individual_product['month'] = $month;
        $individual_product['total_quantity'] = $total_quantity;
        $individual_product['total_price'] = $total_price;
        array_push($result,$individual_product);
        return view('owner/purchaseeachmonth',['results'=>$result]);
    }

    //Categories Info
    public function getCategories(){
        $categories = Category::all();
        return view('owner/categories', ['categories'=>$categories]);
    }

    public function addCategory(Request $request){
        $category = $request['category'];
        if ($category == null){
            return Redirect::to('owner/categories');
        }else{
            $categories = new Category();
            $categories->category = $category;
            $categories->save();
            return Redirect::to('owner/categories');
        }
    }

    public function editCategory($category_id){
        $category = Category::where('id',$category_id)->get();
        return view('owner/editcategory',['category'=>$category]);
    }

    public function updateCategory(Request $request, $category_id){
        $category = $request['category'];
        Category::where('id', $category_id)->update(['category'=>$category]);
        return Redirect::to('owner/categories');
    }

    public function removeCategory($category_id){
        Category::where('id',$category_id)->delete();
        $subcategory_ids = Sub_category::where('category_id',$category_id)->select('id')->get();
        foreach ($subcategory_ids as $subcategory_id) {
            Sub_category::where('id',$subcategory_id)->delete();
            $product_ids = Product::where('sub_category_id',$subcategory_id)->select('id')->get();
            foreach ($product_ids as $product_id) {
                Product::where('id',$product_id)->delete();
            }
        }
        return Redirect::to('owner/categories');
    }

    //Sub Categories Info
    public function getSubCategories($category_id){
        $subcategories = Sub_category::where('category_id',$category_id)->get();
        return view('owner/subcategories', ['subcategories'=>$subcategories, 'category_id'=>$category_id]);
    }

    public function getCategoryId($category_id){
        return view('owner/addsubcategory',['category_id'=>$category_id]);
    }

    public function addSubCategory(Request $request, $category_id){
        $subcategory = $request['subcategory'];
        if ($subcategory == null){
            return Redirect::to('owner/subcategories/'.$category_id);
        }else{
            $subcategories = new Sub_category();
            $subcategories->sub_category = $subcategory;
            $subcategories->category_id = $category_id;
            $subcategories->save();
            return Redirect::to('owner/subcategories/'.$category_id);
        }
    }

    public function editSubCategory($subcategory_id){
        $subcategory = Sub_category::where('id',$subcategory_id)->get();
        return view('owner/editsubcategory',['subcategory'=>$subcategory]);
    }

    public function updateSubCategory(Request $request, $subcategory_id){
        $subcategory = $request['subcategory'];
        $category_id = Sub_category::where('id',$subcategory_id)->value('category_id');
        Sub_category::where('id', $subcategory_id)->update(['sub_category'=>$subcategory]);
        return Redirect::to('owner/subcategories/'.$category_id);
    }

    public function removeSubCategory($subcategory_id){
        $category_id = Sub_category::where('id',$subcategory_id)->value('category_id');
        Sub_category::where('id',$subcategory_id)->delete();
        $product_ids = Product::where('sub_category_id',$subcategory_id)->select('id')->get();
        foreach ($product_ids as $product_id) {
            Product::where('id',$product_id)->delete();
        }
        return Redirect::to('owner/subcategories/'.$category_id);
    }

    //products Info
    public function getProducts($subcategory_id){
        $products = Product::where('sub_category_id',$subcategory_id)->get();
        foreach ($products as $product) {
            $multipicture = $product['picture'];
            $onepicture = explode(',',$multipicture);
            $product['picture'] = $onepicture[0];
        }
        return view('owner/products',['products'=>$products,'sub_category_id'=>$subcategory_id]);
    }

    public function getSubCategoryId($subcategory_id){
        $lastproduct = Product::all()->last();
        $productID = $lastproduct['product_id'];
        $newproductID = $productID + 1;
        return view('owner/addproduct',['subcategory_id'=>$subcategory_id,'product_ID'=>$newproductID]);
    }

    public function addProduct(Request $request, $subcategory_id){
        $rules = array(
            'product_id' => 'required|unique:products,product_id|numeric|min:6'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()){
            $notification = array(
                'message' => 'Sorry... The Product ID is already exist or it is too short',
                'alert-type' => 'warning'
            );
            return Redirect::to('owner/addproductpage/'.$subcategory_id)->with($notification);
        }else{
            $product_ID = $request['product_id'];
            $product_name = $request['product_name'];
            $price = $request['price'];
            $description = $request['description'];
            $quantity = $request['quantity'];

            $product = new Product();
            $product->sub_category_id = $subcategory_id;
            $product->product_id = $product_ID;
            $product->product_name = $product_name;
            $product->price = $price;
            $product->description = $description;
            $product->quantity = $quantity;

            $images=array();
            if($files=$request->file('product_picture')){
                foreach($files as $file){
                    $name=$file->getClientOriginalName();
                    $file->move('products',$name);
                    $images[]=$name;
                }
            }
            $product->picture = implode(",",$images);

            $product->save();

            return Redirect::to('owner/products/'.$subcategory_id);
        }
    }

    public function removeProduct($product_id){
        $subcategory_id = Product::where('id',$product_id)->value('sub_category_id');
        Product::where('id',$product_id)->delete();
        return Redirect::to('owner/products/'.$subcategory_id);
    }

    //admin request Info
    public function getAdminRequest(){

        $members = User::where('approve','request')->get();
        foreach ($members as $member){
            $profile = User_profile::where('user_id', $member['id'])->get();
            $fullname = $profile[0]['firstname']." ".$profile[0]['lastname'];
            $member['fullname'] = $fullname;
            $member['gender'] = $profile[0]['gender'];
            $member['country'] = $profile[0]['country'];
            $member['picture'] = $profile[0]['profile_picture'];
        }

        return view('owner/adminrequest', ['members'=>$members]);
    }

    public function acceptRequest($request_id){
        User::where('id', $request_id)->update(['approve'=>'approved']);
        return Redirect::to('owner/adminrequest');
    }

    public function rejectRequest($request_id){
        User::where('id', $request_id)->delete();
        return Redirect::to('owner/adminrequest');
    }
}
