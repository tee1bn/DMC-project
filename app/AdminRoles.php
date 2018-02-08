<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminRoles extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['role_title',	'action_at_controller'];
    protected $table = 'admin_roles';
}
