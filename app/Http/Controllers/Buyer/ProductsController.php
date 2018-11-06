<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Category;
use App\Models\Product;
use App\Models\Sub_category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    //
    public function getAllProducts(){
        $allproducts = Product::all();
        foreach ($allproducts as $allproduct){
            $subcategory_id = $allproduct['sub_category_id'];
            $subcategory = Sub_category::where('id',$subcategory_id)->value('sub_category');
            $category_id = Sub_category::where('id',$subcategory_id)->value('category_id');
            $category = Category::where('id',$category_id)->value('category');
            $allproduct['subcategory'] = $subcategory;
            $allproduct['category'] = $category;

            $multipicture = $allproduct['picture'];
            $onepicture = explode(',',$multipicture);
            $allproduct['picture'] = $onepicture[0];
        }

        return view('buyer/products/allproducts',['products'=>$allproducts]);
    }

    public function getProductDetail($product_id){
        $detail = Product::where('id',$product_id)->get();
        $multipicture = $detail[0]['picture'];
        $pictures = explode(',',$multipicture);
        $detail['allpictures'] = $pictures;
        return view('buyer/products/productdetail',['detail'=>$detail,'product_id'=>$product_id]);
    }

    public function getGuestProductDetail($product_id){
        $detail = Product::where('id',$product_id)->get();
        $multipicture = $detail[0]['picture'];
        $pictures = explode(',',$multipicture);
        $detail['allpictures'] = $pictures;
        return view('buyer/guest_product_detail',['detail'=>$detail,'product_id'=>$product_id]);
    }

    public function getAllImages(){
        $allpictures = Product::all();
        foreach ($allpictures as $allpicture) {
            $multipicture = $allpicture['picture'];
            $onepicture = explode(',',$multipicture);
            $allpicture['picture'] = $onepicture[0];
        }

        $categories = Category::all();

        return view('buyer/buyer_dashboard',['pictures'=>$allpictures],['categories'=>$categories]);
    }
}
