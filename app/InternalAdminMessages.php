<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InternalAdminMessages extends Model
{
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['sender_id',	'message'	,'response',	'response_by'];
    protected $table = 'internal_admin_messaging';


 }
