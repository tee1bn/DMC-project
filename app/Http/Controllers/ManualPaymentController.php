<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ManualPayment;
use Auth;
use App\Payment;

class ManualPaymentController extends Controller
{
    public function index(Request $request)
    {
        $manualPayment = new ManualPayment([
            'user_id' => Auth::user()->id,
            'amount' => $request->get('amount'),
            'type' => $request->get('type'),
            'status' => 'unapproved',
            'reference' => bin2hex(openssl_random_pseudo_bytes(8)),
        ]);
        $manualPayment->save();
        return view('subscription.manual', compact('manualPayment'));
    }

    public function approve($reference)
    {
        $manualPayment = ManualPayment::where('reference', $reference)->get()->first();
        $manualPayment->status = 'approved';
        if ($manualPayment->save())
        {
            switch ($manualPayment->type)
            {
                case 'pro_sub':
                    $current_month = date('F');
                    $current_year = date('Y');
                    $payment = new Payment([
                            'type' => 'pro_sub',
                            'user_id' => $manualPayment->user_id,
                            'transaction_ref' => $reference,
                            'status' => 'success',
                            'month' => $current_month,
                            'year' => $current_year,
                        ]);
                    $payment->save();
                    
                break;
                case 'elite_payment':
                    Auth::user()->upgrade('elite');

                    Auth::user()->approveUnconfirmedReferralBonus();
                    Auth::user()->allocateReferralBonusToUpline($reference, 'Elite');
                    Auth::user()->allocateRankingPerksToUpline($reference);
                break;
                case 'pro_payment':
                    Auth::user()->upgrade('pro');

                    Auth::user()->approveUnconfirmedReferralBonus();
                    Auth::user()->allocateReferralBonusToUpline($reference,'Pro');
                    Auth::user()->allocateRankingPerksToUpline($reference);
                break;
                default:

                break;
            }
        }
        echo 'approved!';
    }
}
