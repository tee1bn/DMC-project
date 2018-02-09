<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\User;
use App\EWallet;
use App\Notification;




class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;




 /**
     * Subscribe user to a Subscription either upgrade or downgrade.
     * @param user_id, subscription_id 
     * 
     */

public function subscribe($user_id, $new_subscription_id)
{	
	User::where('id', $user_id)->update([
			'on_subscription_id' => $new_subscription_id
	]);		
}



 /**
     * Fetch user profile attributes from all asscociated models.
     * @param user_id  
     * @return array   
     * 
     */

public function create_notification($user_id, $notification_body, $notification_title, $url)
{



Notification::create([
                    'user_id'=> $user_id,
                    'notification_body'=> $notification_body,
                    'notification_title'=> $notification_title,
                    'url' => $url
                    ]);







}









}
