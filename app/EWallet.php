<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EWallet extends Model
{
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'user_id',	'amount',	'lock_status'
    ];


    protected $table = 'e_wallet';

}
