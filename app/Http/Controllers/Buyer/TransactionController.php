<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Product;
use App\Models\Review;
use App\Models\User_profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class TransactionController extends Controller
{
    //
    public function transactionHistory(){
        $_diff = Session::get('user_timezone')*60;
        $mytransactions = Transaction::where('user_id',Auth::user()->id)->get();
        foreach ($mytransactions as $mytransaction) {
            $product_id = $mytransaction['product_id'];
            $product_info = Product::where('id',$product_id)->select('product_id','product_name','price')->get();
            $mytransaction['product_ID'] = $product_info[0]['product_id'];
            $mytransaction['product_name'] = $product_info[0]['product_name'];
            $mytransaction['price'] = $product_info[0]['price'];
            $mytransaction['posted_at'] = date('Y-m-d g:i A',strtotime($mytransaction['created_at'])-$_diff);
        }
        return view('buyer/transaction',['transactions'=>$mytransactions]);
    }

    public function productToEvaluate($product_ID){
        $detail = Product::where('product_id',$product_ID)->get();
        $multipicture = $detail[0]['picture'];
        $pictures = explode(',',$multipicture);
        $detail['allpictures'] = $pictures;
        return view('buyer/reviewpage',['detail'=>$detail,'product_ID'=>$product_ID]);
    }

    public function writeReview(Request $request, $product_ID){
        $comment = $request['review'];
        $rating = $request['rating'];
        $product_id = Product::where('product_id',$product_ID)->value('id');
        if ($comment == null){
            $notification = array(
                'message' => 'Sorry... Please write review of the product...',
                'alert-type' => 'warning'
            );
            return Redirect::to('buyer/writereviewpage/'.$product_ID)->with($notification);
        }else{
            $you = Review::where('user_id',Auth::user()->id)->where('product_id',$product_id)->get();
            if (sizeof($you) != 0){
                $notification = array(
                    'exist' => 'Sorry... Please write review of the product...',
                    'alert-type' => 'warning'
                );
                return Redirect::to('buyer/writereviewpage/'.$product_ID)->with($notification);
            }else{
                $review = new Review();
                $review->user_id = Auth::user()->id;
                $review->product_id = $product_id;
                $review->review = $comment;
                $review->rating = $rating;

                $review->save();
                return Redirect::to('buyer/review');
            }

        }

    }

    public function getReview(){
        $_diff = Session::get('user_timezone')*60;
        $myreviews = Review::where('user_id',Auth::user()->id)->get();
        foreach ($myreviews as $myreview) {
            $product_name = Product::where('id',$myreview['product_id'])->value('product_name');
            $product_ID = Product::where('id',$myreview['product_id'])->value('product_id');
            $myreview['product_name'] = $product_name;
            $myreview['product_ID'] = $product_ID;
            $myreview['posted_at'] = date('Y-m-d g:i A',strtotime($myreview['created_at'])-$_diff);
        }
        return view('buyer/review',['reviews'=>$myreviews]);
    }


}
