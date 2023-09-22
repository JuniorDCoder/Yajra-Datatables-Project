<?php

namespace App\Http\Controllers\Gateway;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class FlutterwaveController extends Controller
{
    //
    public function initialize(Request $request){
        $reference = Flutterwave::generateReference();

        // Enter the details of the payment
        $data = [
            'payment_options' => 'mobilemoneyfranco,banktransfer',
            'amount' => $request->product_price,
            'email' => auth()->user()->email,
            'tx_ref' => $reference,
            'currency' => "XAF",
            'redirect_url' => route('callback'),
            'customer' => [
                'email' => auth()->user()->email,
                "phone_number" => '237677802114',
                "name" => auth()->user()->name
            ],

            "customizations" => [
                "title" => 'FemsBuy Product Purchase',
                "description" => "Test Payment"
            ]
        ];

        $payment = Flutterwave::initializePayment($data);

        if ($payment['status'] !== 'success') {
            // notify something went wrong
            return;
        }

        return redirect($payment['data']['link']);
    }
    public function callback()
    {

        $status = request()->status;

        //if payment is successful
        if ($status ==  'successful') {

        $transactionID = Flutterwave::getTransactionIDFromCallback();
        $data = Flutterwave::verifyTransaction($transactionID);
        return 'Paid Successfully';
        // dd($data);
        }
        elseif ($status ==  'cancelled'){

            return redirect()->route('cart.cart');
            //Put desired action/code after transaction has been cancelled here
        }
        else{
            //Put desired action/code after transaction has failed here
        }
        // Get the transaction from your DB using the transaction reference (txref)
        // Check if you have previously given value for the transaction. If you have, redirect to your successpage else, continue
        // Confirm that the currency on your db transaction is equal to the returned currency
        // Confirm that the db transaction amount is equal to the returned amount
        // Update the db transaction record (including parameters that didn't exist before the transaction is completed. for audit purpose)
        // Give value for the transaction
        // Update the transaction to note that you have given value for the transaction
        // You can also redirect to your success page from here

    }
}
