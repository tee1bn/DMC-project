<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Subscription;
use App\Ewallet;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recruited_by','on_subscription_id','admin','username','firstname','lastname','phone','email', 'password',
        'email_verification_token', 'phone_verification_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


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



}
