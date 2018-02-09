<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Support\Facades\Mail;
use App\Mail\AccountVerificationEmail;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/participant-dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:191|unique:users',
            'firstname' => 'required|string|max:191',
            'lastname' => 'required|string|max:191',
            'phone' => 'required|string|max:191|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
            $email_verification_token = md5($data['email']);
            $phone_verification_token = rand(100000, 999999) ;
try {

        $user = User::create([
            'username' => $data['username'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'email_verification_token' => $email_verification_token,
            'phone_verification_token' => $phone_verification_token,
            'password' => bcrypt($data['password']),
        ]);

Mail::to($data['email'])->send(new AccountVerificationEmail($email_verification_token));
$this->beginPhoneVerification($user->id);

return $user ;
    
} catch (Exception $e) {
    
}





    }


public function beginPhoneVerification( $user_id )
{
    $user = User::where($user_id);

    $phone_verification_token = urlencode($user->phone_verification_token);
    $phone = urlencode($user->phone) ;
    $firstname = urlencode($user->firstname);

   $message = urlencode("Hello $firstname, kindly enter this code on the form to verify your phone. Code: $phone_verification_token");
    $gateway_username ='nsv9-dmc1';
    $gateway_password ='dmc1234';
    $gateway_sender   ='DMC';


    try {
                //Smpp http Url to send sms.
                $live_url = "http://rslr.connectbind.com:8080/bulksms/bulksms?username=$gateway_username&password=$gateway_password&type=0&dlr=0&destination=$phone&source=$gateway_sender&message=$message";
                $parse_url = file($live_url);
                //echo $parse_url[0];
            } catch (Exception $e) {
                echo 'Message:' . $e->getMessage();
            }

}






}