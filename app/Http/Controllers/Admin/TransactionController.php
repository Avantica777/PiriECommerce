<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Guesttransaction;
use App\Models\Product;
use App\Models\Sub_category;
use App\Models\Transaction;
use App\Models\User;
use App\Models\User_profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    //
    public function getYear(){
        $nowyear = (int)date('Y');
        $years = [];
        for ($i=$nowyear; $i>=$nowyear-2; $i--){
            array_push($years, $i);
        }
        return view('admin/transaction/year',['years'=>$years]);
    }

    public function getMonth($year){
        $month = ['January','February','March','April','May','June','July','August','September','October','November','December'];

        return view('admin/transaction/month',['year'=>$year,'months'=>$month]);
    }
    public function allTransaction($year, $month){
        $_diff = Session::get('user_timezone')*60;
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
            $alltransaction['posted_at'] = date('Y-m-d g:i A',strtotime($alltransaction['created_at'])-$_diff);
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
            $allguesttransaction['posted_at'] = date('Y-m-d g:i A',strtotime($allguesttransaction['created_at'])-$_diff);
            $alltransactions[] = $allguesttransaction;
        }
        return view('admin/transaction/transaction',['alltransactions'=>$alltransactions]);
    }
}
