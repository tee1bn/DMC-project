<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'notification_body','notification_title','notification_url' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];




}
