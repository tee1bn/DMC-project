<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','firstname', 'lastname', 'phone','on_subscription_id', 'recruited_by','email', 'password',  
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getUplines()
    {
        $first = User::where('id', $this->recruited_by)->get()->first();

        if ($first)
        {
            // if theres a direct ref
            $second = User::where('id', $first->recruited_by)->get()->first();
            if ($second)
            {
                $third = User::where('id', $second->recruited_by)->get()->first(); 

                if ($third)
                {
                    return [$first, $second, $third];
                }

                return [$first, $second];
            }

            return [$first];
        }
        
        return [];
    }
    public function hasPaidLastMonthDue()
    {
        // return false;
        $dt = Carbon::now();
        $last_month_timestamp = $dt->subMonth();
        // if user is Elite
        if ($this->isElite())
            return true;
        // check regular payments table for user on last month
        $current_month = date('F');
        $current_year = date('Y');
        $last_month = date('F',strtotime($last_month_timestamp));
        $payment = Payment::where('user_id', $this->id)->where('type','pro_sub')->where('month', $last_month)->where('year', $current_year)->get();
        if ($payment->count() == 1)
        
            return true;

        return false;
    }
    public function isElite()
    {
        if ($this->on_subscription_id == 3)
            return true;
        else
            return false;
    }
    public function isPro()
    {
        if ($this->on_subscription_id == 2)
            return true;
        else
            return false;
    }
    public function registeredThisMonth()
    {
        // return true;
        $dt = Carbon::now();
        $this_month = date('F');
        $registered_month = date('F', strtotime($this->created_at));

        if ($registered_month == $this_month)
            return true;
            
        return false;
    }
    public function registeredLastMonth()
    {
        $dt = Carbon::now();
        $last_month_timestamp = $dt->subMonth();
        $last_month = date('F',strtotime($last_month_timestamp));
        $registered_month = date('F', strtotime($this->created_at));
        exit('registerd:'.$registered_month.'lastmonth:'.$last_month);

        if ($registered_month == $last_month)
            return true;
            
        return false;
    }
    public function downgrade($grade)
    {
        switch ($grade)
        {
            case 'basic':
                $this->on_subscription_id = 1;
                return $this->save();
            break;
            case 'pro':
                $this->on_subscription_id = 2;                
                return $this->save();
            break;
            default:
                return false;
            break;
        }

        return false;
    }
    public function upgrade($grade)
    {
        switch ($grade)
        {
            case 'pro':
                $this->on_subscription_id = 2;
                return $this->save();
            break;
            case 'elite':
                $this->on_subscription_id = 3;                
                return $this->save();
            break;
            default:
                return false;
            break;
        }

        return false;
    }
    public function approveUnconfirmedReferralBonus()
    {
        // check if theres is an unconfirmed referral bonus due to usere intially being a BASIC user
        // maybe more than one
        $credits = CreditDebit::where('lock', '1')->where('user_id', $this->id)->where('status','valid')->where('form','referral')->where('disbursed','0')->get();
        if ($credits->count()>0)
        {
            foreach($credits as $credit)
            {
                // exit('yo');
                $amount = $credit->amount;
                $credit->lock = '0';
                $credit->disbursed = '1';
                if ($credit->save())
                {
                    // check if already exist
                    // if yes, Update
                    $wallet = EWallet::where('user_id', $this->id)->get()->first();
                    if ($wallet)
                    {
                        // update
                        $wallet->available_balance = (!$this->isPro() && !$this->isElite()) ? $wallet->available_balance : $wallet->available_balance + $amount;
                        // $wallet->balance = $wallet->balance + $amount; <-- add only to available balance as it had been added to 'balance' initially
                        $wallet->save();
                    }
                    else
                    {
                        // create new entry
                        $wallet = new EWallet([
                            'user_id' => $this->id,
                            'available_balance' => (!$this->isPro() && !$this->isElite()) ? 0 : $amount,
                            'balance' => $amount,  
                        ]);
                        $wallet->save();
                    }
                }
            }
        }
    }

    public function allocateReferralBonusToUpline($transaction_id, $plan)
    {
        // get the 3 uplines
        $uplines = $this->getUplines();

        // allocate referrer commission and earnings based on referral level
        $amount = '';
        for ($i = 0; $i < count($uplines);$i++)
        {
            $upline = $uplines[$i];
            if ($i == 0 && $plan == 'Pro') // give 30% bonus = #12,000 // credit $upline #12000
                $amount = 12000;
            if ($i == 0 && $plan == 'Elite') // give 30% bonus = #30,000 // credit $upline #30,000
                $amount = 30000;
            if ($i == 1 && $plan == 'Pro') // give 5% bonus = #2,000 // credit $upline #2000
                $amount = 2000;
            if ($i == 1 && $plan == 'Elite') // give 10% bonus = #10,000 // credit $upline #10,000
                $amount = 10000;
            if ($i == 2 && $plan == 'Elite') // give 5% bonus = #10,000 // credit $upline #10,000
                $amount = 10000;

            if (isset($amount) & !empty($amount))
            {
                //exit('bk');
                $time = time();
                $credit = new CreditDebit([
                        'type' => 'credit',
                        'form' => 'referral',
                        'transaction_id' => $transaction_id,
                        'user_id' => $upline->id,
                        // lock credit only if user is basic
                        'lock' => (!$upline->isPro() && !$upline->isElite()) ? '1' : '0',
                        'lock_date' => Carbon::now(),
                        'status' => 'valid',
                        // dont disburse to available balance if user is basic
                        'disbursed' => (!$upline->isPro() && !$upline->isElite()) ? '0' : '1',
                        'amount' => $amount,    
                ]);
                if ($credit->save())
                {
                    // check if already exist
                    // if yes, Update
                    $wallet = EWallet::where('user_id', $upline->id)->get()->first();
                    if ($wallet)
                    {
                        // update
                        $wallet->available_balance = (!$upline->isPro() && !$upline->isElite()) ? $wallet->available_balance : $wallet->available_balance + $amount;
                        $wallet->balance = $wallet->balance + $amount;
                        $wallet->save();
                    }
                    else
                    {
                        // create new entry
                        $wallet = new EWallet([
                            'user_id' => $upline->id,
                            'available_balance' => (!$upline->isPro() && !$upline->isElite()) ? 0 : $amount,
                            'balance' => $amount,  
                        ]);
                        $wallet->save();
                    }

                }
            } 
        }
    }

    public function allocateRankingPerksToUpline($transaction_id)
    {
        // get the 3 uplines
        $uplines = $this->getUplines();

        // upgrade done.
        // now lets see the users UPLINE who are eligible for ranking perks
        // Must have signed up at least 10 DMC Elite affiliates (directly) and above
        if ($uplines && (count($uplines)>0))
        {
            $amount = '';
            foreach ($uplines as $upline)
            {
                // referrals have to be ELITE
                $first_referrals = User::where('recruited_by', $upline->id)->where('on_subscription_id', 3)->get();
                $direct_referrals = $first_referrals;
            
                foreach ($first_referrals as $first_referral)
                {
                    $second_referrals = User::where('recruited_by', $first_referral->id)->where('on_subscription_id', 3)->get();
        
                    if ($second_referrals->count()>0)
                    {
                        foreach($second_referrals as $second_referral)
                        {
                            // get 3rd level referrals 
                            $third_referrals = User::where('recruited_by', $second_referral->id)->where('on_subscription_id', 3)->get();
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
                // $ss = true;
                if ($direct_referrals->count() == 10)
                    $amount = 50000;
                if ($direct_referrals->count() >= 10 && $first_referrals->count() == 100)
                    $amount = 100000;
                if ($direct_referrals->count() >= 10 && $first_referrals->count() == 500)
                    $amount = 150000;
                if ($direct_referrals->count() >= 20 && $first_referrals->count() == 1500)
                    $amount = 300000;
                if ($direct_referrals->count() >= 30 && $first_referrals->count() == 5000)
                    $amount = 1000000;
                if ($direct_referrals->count() >= 50 && $first_referrals->count() == 10000)
                {
                    // credit 10% profit sharing
                }
                if ($direct_referrals->count() >= 100 && $first_referrals->count() == 20000)
                {
                    // credit 10% profit sharing
                }
                if (isset($amount) & !empty($amount))
                {
                    $time = time();
                    $credit = new CreditDebit([
                            'type' => 'credit',
                            'form' => 'bonus',
                            'transaction_id' => $transaction_id,
                            'user_id' => $upline->id,       
                            'lock' => '0',
                            'lock_date' => Carbon::now(),
                            'status' => 'valid',
                            'disbursed' => '1',
                            'amount' => $amount,       
                        ]);
                    if ($credit->save())
                    {
                        // check if already exist
                        // if yes, Update
                        $wallet = EWallet::where('user_id', $upline->id)->get()->first();
                        if ($wallet)
                        {
                            // update
                            $wallet->available_balance = $wallet->available_balance + $amount;
                            $wallet->balance = $wallet->balance + $amount;
                            $wallet->save();
                            
                        }
                        else
                        {
                            // create new entry
                            $wallet = new EWallet([
                                'user_id' => $upline->id,
                                'available_balance' => $amount,
                                'balance' => $amount,  
                            ]);
                            $wallet->save();
                        }

                    }
                }
            }
        }
    }



    /**
    *Check if instance user is an admin
    *
    *@return boolean
    */
    public function isAdmin()
    {
        if($this->admin){
            return true;
        }else{
            return false;
        }

    }



public function recruitedBy()
    {
     return   $this->belongsTo('App\User', 'recruited_by');
      }


    /**
    *Create one to one relationship between a user and subscription
    *
    *@return 
    */

    public function subscription()
    {
     return   $this->belongsTo('App\Subscription', 'on_subscription_id');
      }

 /**
    *Create one to one relationship between a user and ewallet
    *
    *@return 
    */
    public function ewallet()
    {
     return   $this->hasOne('App\Ewallet', 'user_id');
    }

    /**
    *Create one to many relationship between a user and InternalAdminMessages
    *
    *@return 
    */

    public function internalAdminMessages()
    {
     return   $this->hasMany('App\InternalAdminMessages', 'sender_id');
    }


 /**
    *Create one to one relationship between a user and ewallet
    *
    *@return 
    */


    public function userProfile()
    {

       (  $personal_information = $this->first()->toArray());

       (  $wallet = $this->ewallet->toArray());

       (  $recruited_by = $this->recruitedBy->toArray());



      return array(
            'personal_information' => $personal_information,
            'wallet' => $wallet,
            'recruited_by' => $recruited_by,
             );

      }

 /**
    *Create many to many relationship between a user and admin_roles
    *
    *@return 
    */

 
      public function adminRoles()
      {
        return $this->belongsToMany('App\AdminRoles', 'roles_assignments', 'subadmin_id', 'roles_id');
      }


 /**
    *Create many to many relationship between a user and admin_roles
    *
    *@return 
    */
      public function hasRole($role)
      {




        //grant access if superadmin
        if($this->type_of_user_id == 3 ){

            return true;

        }


        //ensure user is an admin
        if($this->type_of_user_id == 1 ){

            return false;

        }

       foreach ( $this->adminRoles()->get() as $key => $value) {

            $roles[] = $value['action_at_controller'];

        }

        if(in_array($role, $roles)){

          return true;
        }

          return false;


      }
public function notifications()
{
      return $this->hasMany('App\Notifications' , 'user_id')->orderBy('created_at', 'ASC');
}
    
}
