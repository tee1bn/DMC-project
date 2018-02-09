<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rank;
use App\User;
use Auth;
use App\Payment;
use App\Transaction;
use App\CreditDebit;
use Carbon\Carbon;
use App\Ewallet;

class ReferralController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $first_referrals = User::where('recruited_by', $user->id)->get();
        
        foreach ($first_referrals as $first_referral)
        {
            $second_referrals = User::where('recruited_by', $first_referral->id)->get();

            if ($second_referrals->count()>0)
            {
                foreach($second_referrals as $second_referral)
                {
                    // get 3rd level referrals 
                    $third_referrals = User::where('recruited_by', $second_referral->id)->get();
                    if ($third_referrals->count()>0)
                    {
                        foreach($third_referrals as $third_referral)
                        {
                            $first_referrals->push($third_referral);
                        }
                    }


                    $first_referrals->push($second_referral);
                }
            } 
        }

        return view('referrals.index', compact('first_referrals','second_referrals'));
    }

    public function downline()
    {
        $user = Auth::user();

        $first_referrals = User::where('recruited_by', $user->id)->get();
        
        foreach ($first_referrals as $first_referral)
        {
            $second_referrals = User::where('recruited_by', $first_referral->id)->get();

            if ($second_referrals->count()>0)
            {
                foreach($second_referrals as $second_referral)
                {
                    // get 3rd level referrals 
                    $third_referrals = User::where('recruited_by', $second_referral->id)->get();
                    if ($third_referrals->count()>0)
                    {
                        foreach($third_referrals as $third_referral)
                        {
                            $first_referrals->push($third_referral);
                        }
                    }


                    $first_referrals->push($second_referral);
                }
            } 
        }

        return view('referrals.tree', compact('first_referrals','second_referrals'));
    }
}
