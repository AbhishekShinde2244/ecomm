<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Payments;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;

class RazorpayController extends Controller
{
    public function razorpay()
    {
        return view('payment_page');
    }
    public function payment(Request $request)
    {
        if (Session::has('user')) {
            $input = $request->all();
            $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
            $payment = $api->payment->fetch($input['razorpay_payment_id']);

            if (count($input) && !empty($input['razorpay_payment_id'])) {
                try {
                    /*$response = $api->payment
                    ->fetch($input['razorpay_payment_id'])
                    ->capture(['amount' => $payment['amount']]);*/
                    $randomNumber = mt_rand(1000, 9999);

                    // Construct the order receipt ID with the random number
                    $orderReceipt = 'laracom_#' . $randomNumber;
                    // You can access the payment details in the $payment variable
                    $status = $payment->status;
                    $amount = $payment->amount / 100;
                    $order_id = $orderReceipt;
                    $payment_methods = $payment->method;
                    $payment_name = $payment->wallet;

                    // Here, you can construct a JSON response with the desired information

                    $userId = $request->session()->get('user')['id'];
                    $cart = Cart::where('user_id', $userId);
                    $cart->update([
                        'status' => 1,
                    ]);

                    $order_details = new Payments();
                    $order_details->user_id = $userId;
                    $order_details->order_id = $order_id;
                    $order_details->payment_id = $input['razorpay_payment_id'];
                    $order_details->amount = $amount;
                    $order_details->status = $status;
                    $order_details->method = $payment_methods;
                    $order_details->payment_name = $payment_name;
                    $order_details->save();

                    return view('payment_done', ['order_id' => $order_id]);
                    // Optionally, you can return the JSON response
                    return response()->json($response);
                } catch (\Exception $e) {
                    return $e->getMessage();
                    \Session::put('error', $e->getMessage());
                    return redirect()->back();
                }
            }

            \Session::put(
                'success',
                'Payment successful, your order will be despatched in the next 48 hours.'
            );
            return redirect()->back();
        }
    }
}
