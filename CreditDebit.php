<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditDebit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id','user_id', 'type', 'status','amount', 'lock_date','form', 'lock', 'disbursed',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function getReferralUsername()
    {
        $transaction = Transaction::where('id',$this->transaction_id)->get(['user_id'])->first();
        if ($transaction)
        {
            $user = User::where('id',$transaction->user_id)->get(['username'])->first();
            return $user->username;
        }
        else
        {
            // lets check if referral bonus was initiatad by a user ugrade that was paid for offline
            // we will do this by checking the ManualPayment table
            $transaction = ManualPayment::where('reference',$this->transaction_id)->get(['user_id'])->first();
            $user = User::where('id',$transaction->user_id)->get(['username'])->first();
            return $user->username;
        }
    }
}
