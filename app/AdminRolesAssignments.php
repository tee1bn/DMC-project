<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminRolesAssignments extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */   
     protected $fillable = ['subadmin_id', 'roles_id'];
    protected $table = 'roles_assignments';
}
