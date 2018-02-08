<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\InternalAdminMessages;

class AdminMessagingController extends Controller
{
    public function message_admin(Request $request)
    {
		

   $exists = boolval( InternalAdminMessages::where('message', $request->message)->count());
 
  if($exists){
  	echo "already exixst";

  	
  }else{

	InternalAdminMessages::create([

			'sender_id'=>Auth::user()->id,
			'message'=>$request->message,

		]);

    }

}

// return redirect()->route('home');

}
