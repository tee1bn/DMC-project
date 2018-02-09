<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManualPayment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference','user_id', 'amount', 'status', 'type',  
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function getUserFullname()
    {
        $user = User::where('id', $this->user_id)->get(['firstname','lastname'])->first();
        if ($user) return $user->firstname. ' '. $user->lastname;
        else return 'N/A';
    }
}
