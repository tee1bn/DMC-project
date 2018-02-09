<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Paystack;
use Auth;
use App\Transaction;
use App\Payment;
use Carbon\Carbon;

class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
        //return Paystack::getAuthorizationUrl();
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        //dd($paymentDetails);
        if ($paymentDetails['status'] && $paymentDetails['data']['status'] == 'success')
        {
            $user = Auth::user();
            // upgrade user            
            $upgrade = false;
            if ($paymentDetails['data']['amount'] == '12000000')
            {
                $user->upgrade('elite');
                $plan = 'Elite';
                $upgrade = true;
            }
            elseif ($paymentDetails['data']['amount'] == '4000000')
            {
                $user->upgrade('pro');
                $plan = 'Pro';
                $upgrade = true;                      
            }
            elseif ($paymentDetails['data']['amount'] == '1000000')
            {
                $current_month = date('F');
                $current_year = date('Y');
                $payment = new Payment([
                        'type' => 'pro_sub',
                        'user_id' => $user->id,
                        'transaction_ref' => $paymentDetails['data']['reference'],
                        'status' => 'success',
                        'month' => $current_month,
                        'year' => $current_year,
                    ]);
                $payment->save();
                return redirect()->route('home')->with('status', 'PRO Monthly due paid');
            }

            if ($upgrade)
            {
                $user->approveUnconfirmedReferralBonus();
                // save transaction details to database
                $user = Auth::user();
                $transaction = new Transaction([
                        'transaction_id' => $paymentDetails['data']['id'],
                        'user_id' => $user->id, 
                        'plan_id' => $user->on_subscription_id, 
                        'status' => $paymentDetails['data']['status'],
                        'amount' => $paymentDetails['data']['amount'], 
                        'ip_address' => $paymentDetails['data']['ip_address'],
                        'transaction_ref' => $paymentDetails['data']['reference'],
                    ]);
                $transaction->save();
                $transaction = Transaction::where('transaction_id', $paymentDetails['data']['id'])->get()->first();

                $user->allocateReferralBonusToUpline($transaction->id, $plan);
                $user->allocateRankingPerksToUpline($transaction->id);

                return redirect()->route('home')->with('status', 'You have successfully been upgraded to '.$plan);
            }
        }
        else
            return redirect()->route('home')->with('status', 'Error Occured or transaction was cancelled');
    }
}