<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

use App\User;
use  Auth;


class LoginController extends Controller
{
    
    public function verify_phone(Request $request)
    {
        print_r($phone =$request->phone_verification_code);

        if(Auth::user()->phone_verification_token == $phone){

            echo "owns phone";
        }else{
            echo "do not owns phone";
    return redirect()->back()->withErrors(['Your Phone Could not be verified with the provided code']);

        }
  

    }

  public function verify_email($email)
    {

    $user = User::where('email_verification_token', $email)->firstOrFail();
    $user->update(['email_verification_token' => 'verified' ]);


 if(Auth::attempt([

                'email'     => $user->email,
                'password'  => $user->password

            ])){

               return redirect()->route('home');

 }else{

                return redirect()->route('home');

 }


    }



    public function custom_login(Request $request)
    {


            $user = User::where('username', $request->email)
            		->orWhere('email', $request->email)
            		->orWhere('phone',$request->email)
            		->first();

           ($user != '')? $email = $user->email : $email ='';
            		
            if(Auth::attempt([

            	'email'		=> $email,
            	'password' 	=> $request->password

            ])){


                switch ($user->type_of_user_id) {
                    case '1':  #participant user

                return redirect()->route('participant-dashboard');
                       break;

                      case '2':  #subadmin user

                return redirect()->route('admin-dashboard');
                        break;

                     case '3':  #super admin user

                return redirect()->route('admin-dashboard');
                        break;
                    
                   
                }




            	

            }else{

				return back()->withInput();

            }


        }


 }
