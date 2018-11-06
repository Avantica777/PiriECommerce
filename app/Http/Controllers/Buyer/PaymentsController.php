<?php

namespace App\Http\Controllers\Buyer;

use App\Models\Guesttransaction;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User_profile;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Stripe\Charge;
use Stripe\Stripe;
use PDF;

class PaymentsController extends Controller
{
    //
    public function toPaymentPage(Request $request, $product_id){
        $quantity = $request['quantity'];
        if ($quantity == null){
            $notification = array(
                'message' => 'Sorry... Please input quantity of the product...',
                'alert-type' => 'warning'
            );
            return Redirect::to('buyer/productdetail/'.$product_id)->with($notification);
        }else{
            $exist_quantity = Product::where('id',$product_id)->value('quantity');
            $remain_quantity = $exist_quantity - $quantity;

            if ($remain_quantity<0){
                $notification = array(
                    'message' => 'Sorry... Product quantity is not enough...',
                    'alert-type' => 'warning'
                );
                return Redirect::to('buyer/productdetail/'.$product_id)->with($notification);
            }else{
                $product_ID = Product::where('id',$product_id)->value('product_id');
                $product_name = Product::where('id',$product_id)->value('product_name');
                $price = Product::where('id',$product_id)->value('price');
                $description = Product::where('id',$product_id)->value('description');
                $email_addr = User::where('id',Auth::user()->id)->select('email')->get();
                $total_budget = $price * $quantity;
                $digited_price = number_format($total_budget,2);
                $name = User_profile::where('user_id',Auth::user()->id)->select('firstname','lastname')->get();
                $fullname = $name[0]['firstname']." ".$name[0]['lastname'];
                $orders = ['customername'=>$fullname,
                    'partnumber'=>$product_ID,
                    'product_name'=>$product_name,
                    'price'=>$price,
                    'quantity'=>$quantity,
                    'description'=>$description,
                    'email_addr'=>$email_addr[0]['email'],
                    'total_price'=>$digited_price];
                return view('buyer/paymentpage',['order'=>$orders]);
            }
        }

    }

    public function report(Request $request, $customername, $partnumber, $quantity, $description, $total_price,$email_addr){
        $report = [];
        $report['customername'] = $customername;
        $report['partnumber'] = $partnumber;
        $report['quantity'] = $quantity;
        $report['description'] = $description;
        $report['total_price'] = $total_price;
        $report['email_addr'] = $email_addr;

        if ($request->view_type === 'download'){
            $pdf = PDF::loadView('buyer/report', ['report' => $report]);
            return $pdf->download('receipt.pdf');
        } else {
            $view = View('buyer/report', ['report' => $report]);
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($view->render());
            return $pdf->stream();
        }


    }

    public function pay($product_ID,$quantity,$amount)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $token = request('stripeToken');

        $charge = Charge::create([
            'amount' => $amount,
            'currency' => 'usd',
            'description' => 'Test Book',
            'source' => $token,
        ]);

        return $this->saveTransaction($product_ID,$quantity,$amount);
    }

    public function saveTransaction($product_ID,$quantity,$amount){
        $product_id = Product::where('product_id',$product_ID)->value('id');
        $exist_quantity = Product::where('id',$product_id)->value('quantity');
        $remain_quantity = $exist_quantity - $quantity;
        Product::where('id',$product_id)->update(['quantity'=>$remain_quantity]);

        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->product_id = $product_id;
        $transaction->quantity = $quantity;
        $transaction->total_price = $amount/100;

        $transaction->save();
        return Redirect::to('buyer/success');
        // return redirect()->route('buyer', ['succ' => 1]);
    }

    public function toGuestPaymentPage(Request $request, $product_id){
        $quantity = $request['quantity'];
        if ($quantity == null){
            $notification = array(
                'message' => 'Sorry... Please input quantity of the product...',
                'alert-type' => 'warning'
            );
            return Redirect::to('guest/productdetail/'.$product_id)->with($notification);
        }else{
            $exist_quantity = Product::where('id',$product_id)->value('quantity');
            $remain_quantity = $exist_quantity - $quantity;

            if ($remain_quantity<0){
                $notification = array(
                    'message' => 'Sorry... Product quantity is not enough...',
                    'alert-type' => 'warning'
                );
                return Redirect::to('guest/productdetail/'.$product_id)->with($notification);
            }else{
                $product_ID = Product::where('id',$product_id)->value('product_id');
                $product_name = Product::where('id',$product_id)->value('product_name');
                $price = Product::where('id',$product_id)->value('price');
                $description = Product::where('id',$product_id)->value('description');
                $total_budget = $price * $quantity;
                $digited_price = number_format($total_budget,2);
//                $name = User_profile::where('user_id',Auth::user()->id)->select('firstname','lastname')->get();
//                $fullname = $name[0]['firstname']." ".$name[0]['lastname'];
                $fullname = "Guest";
                $orders = ['customername'=>$fullname,
                    'partnumber'=>$product_ID,
                    'product_name'=>$product_name,
                    'price'=>$price,
                    'quantity'=>$quantity,
                    'description'=>$description,
                    'total_price'=>$digited_price];
                return view('buyer/guest_paymentpage',['order'=>$orders]);
//                return $orders;
            }
        }

    }

    public function payGuest($product_ID,$quantity,$amount)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $token = request('stripeToken');

        $charge = Charge::create([
            'amount' => $amount,
            'currency' => 'usd',
            'description' => 'Test Book',
            'source' => $token,
        ]);

        return $this->saveGuestTransaction($product_ID,$quantity,$amount);
    }

    public function saveGuestTransaction($product_ID,$quantity,$amount){
        $product_id = Product::where('product_id',$product_ID)->value('id');
        $exist_quantity = Product::where('id',$product_id)->value('quantity');
        $remain_quantity = $exist_quantity - $quantity;
        Product::where('id',$product_id)->update(['quantity'=>$remain_quantity]);

        $transaction = new Guesttransaction();
        $transaction->product_id = $product_id;
        $transaction->quantity = $quantity;
        $transaction->total_price = $amount/100;

        $transaction->save();
        return Redirect::to('/');
    }

}
