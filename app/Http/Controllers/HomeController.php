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

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // check if PRO User has paid last month's due,
        // downgrade if not 
        $user_id = Auth::user()->id;
        $user = User::whereId($user_id)->firstOrFail();
        $wallet = EWallet::where('user_id', $user->id)->get()->first();
        $uplines = $user->getUplines();
        

        if ($user->isPro() && !$user->hasPaidLastMonthDue() && !$user->registeredThisMonth()) // not paid last month due and didnt registered this month
                $user->downgrade('basic');

        $ranks = Rank::all();
        $transactions = CreditDebit::where('user_id', $user->id)->get();


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
        //print_r($first_referrals);exit();
        return view('home', compact('ranks','first_referrals', 'second_referrals','transactions','wallet'));
        
    }

}
