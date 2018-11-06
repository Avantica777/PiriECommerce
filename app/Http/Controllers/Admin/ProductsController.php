<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sub_category;
use Grimthorr\LaravelToast\Toast;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    //catetories Info
    public function getCategories(){
        $categories = Category::all();
        return view('admin/categories/categories', ['categories'=>$categories]);
    }

    public function addCategory(Request $request){
        $category = $request['category'];
        if ($category == null){
            return Redirect::to('categories');
        }else{
            $categories = new Category();
            $categories->category = $category;
            $categories->save();
            return Redirect::to('categories');
        }
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
        return Redirect::to('categories');
    }

    public function editCategory($category_id){
        $category = Category::where('id',$category_id)->get();
        return view('admin/categories/editcategory',['category'=>$category]);
    }

    public function updateCategory(Request $request, $category_id){
        $category = $request['category'];
        Category::where('id', $category_id)->update(['category'=>$category]);
        return Redirect::to('categories');
    }

    //subcategories Info
    public function getSubCategories($category_id){
        $subcategories = Sub_category::where('category_id',$category_id)->get();
        return view('admin/subcategories/subcategories', ['subcategories'=>$subcategories, 'category_id'=>$category_id]);
    }

    public function getCategoryId($category_id){
        return view('admin/subcategories/addsubcategory',['category_id'=>$category_id]);
    }

    public function addSubCategory(Request $request, $category_id){
        $subcategory = $request['subcategory'];
        if ($subcategory == null){
            return Redirect::to('subcategories/'.$category_id);
        }else{
            $subcategories = new Sub_category();
            $subcategories->sub_category = $subcategory;
            $subcategories->category_id = $category_id;
            $subcategories->save();
            return Redirect::to('subcategories/'.$category_id);
        }
    }

    public function editSubCategory($subcategory_id){
        $subcategory = Sub_category::where('id',$subcategory_id)->get();
        return view('admin/subcategories/editsubcategory',['subcategory'=>$subcategory]);
    }

    public function updateSubCategory(Request $request, $subcategory_id){
        $subcategory = $request['subcategory'];
        $category_id = Sub_category::where('id',$subcategory_id)->value('category_id');
        Sub_category::where('id', $subcategory_id)->update(['sub_category'=>$subcategory]);
        return Redirect::to('subcategories/'.$category_id);
    }

    public function removeSubCategory($subcategory_id){
        $category_id = Sub_category::where('id',$subcategory_id)->value('category_id');
        Sub_category::where('id',$subcategory_id)->delete();
        $product_ids = Product::where('sub_category_id',$subcategory_id)->select('id')->get();
        foreach ($product_ids as $product_id) {
            Product::where('id',$product_id)->delete();
        }
        return Redirect::to('subcategories/'.$category_id);
    }

    //products Info
    public function getProducts($subcategory_id){
        $products = Product::where('sub_category_id',$subcategory_id)->get();
        foreach ($products as $product) {
            $multipicture = $product['picture'];
            $onepicture = explode(',',$multipicture);
            $product['picture'] = $onepicture[0];
        }
        return view('admin/products/products',['products'=>$products,'sub_category_id'=>$subcategory_id]);
    }

    public function getSubCategoryId($subcategory_id){
        $lastproduct = Product::all()->last();
        $productID = $lastproduct['product_id'];
        $newproductID = $productID + 1;
        return view('admin/products/addproduct',['subcategory_id'=>$subcategory_id,'product_ID'=>$newproductID]);
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
            return Redirect::to('addproductpage/'.$subcategory_id)->with($notification);
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

            return Redirect::to('products/'.$subcategory_id);
        }

    }

    public function removeProduct($product_id){
        $subcategory_id = Product::where('id',$product_id)->value('sub_category_id');
        Product::where('id',$product_id)->delete();
        return Redirect::to('products/'.$subcategory_id);
    }

    public function removeOneProduct($product_id){
        Product::where('id',$product_id)->delete();
        return Redirect::to('allproducts');
    }

    public function productDetail($product_id){
        $detail = Product::where('id',$product_id)->get();
        $multipicture = $detail[0]['picture'];
        $pictures = explode(',',$multipicture);
        $detail['allpictures'] = $pictures;
        return view('admin/products/productdetail',['detail'=>$detail,'product_id'=>$product_id]);
    }

    public function updateProduct(Request $request, $product_id){
        $product_name = $request['product_name'];
        $price = $request['price'];
        $description = $request['description'];
        $quantity = $request['quantity'];

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
                'picture'=>implode(",",$images)]);

            return Redirect::to('productdetail/'.$product_id);
        }else{
            Product::where('id',$product_id)->update(['product_name'=>$product_name,
                'price'=>$price,
                'description'=>$description,
                'quantity'=>$quantity]);

            return Redirect::to('productdetail/'.$product_id);
        }

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

        return view('admin/products/allproducts',['products'=>$allproducts]);
    }

}
