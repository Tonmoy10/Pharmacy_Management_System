<?php

namespace App\Http\Controllers;

use App\Mail\OTPCode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\users;
use App\Models\customer;
use App\Models\manager;
use App\Models\vendor;
use App\Models\courier;
use App\Models\carts;
use App\Models\users_otp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


use function PHPUnit\Framework\isNull;

class AllUserController extends Controller
{
    //

    public function welcome()
    { 
        return redirect()->route('user.login');
    }

    //REGISTRATION FOR ALL USERS 

    //SELECTING USER-TYPE
    public function registration()
    {
        return view('AllUserView.Registration');
    }

    public function registrationSubmit(Request $req)
    {
        return redirect()->route('user.register',['type'=>$req->type]);
    }

    //REGISTRATION PAGE FOR SPECIFIC USER

    public function register($type)
    {
        return view('AllUserView.Register')->with('type',$type);
    }
    
    public function registerSubmit($type, Request $req)
    {

        $this->validate($req,
        [
            "name"=> "required|regex:/^[A-Za-z- .,]+$/i",
            "password"=>"required|min:8|regex:/^.*(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$ %^&*~><.,:;]).*$/i",
            "confirmPassword"=>"required|same:password",
            "email"=>"required|unique:users,u_email"
        ],
        [
            "password.regex"=>"Password must contain minimum 1 special character and minimum 1 upper case letter."

        ]);

        $user= new users();
        $user->u_name = $req->name;
        $user->u_email =$req->email;
        $user->u_pass =$req->password;
        $user->u_type = $req->type;
        $user->save();

        $user=users::where('u_email',$req->email)
                    ->where('u_pass',$req->password)
                    ->first();

        //user table to customer table
        if ($req->type == 'CUSTOMER')
        {
            $customer= new customer();
            $customer->u_id=$user->u_id;
            $customer->customer_name = $req->name;
            $customer->customer_email =$req->email;
            $customer->save();
        }
        
        //user table to vendor table
        if ($req->type == 'VENDOR')
        {
            $vendor= new vendor();
            $vendor->u_id=$user->u_id;
            $vendor->vendor_name = $req->name;
            $vendor->vendor_email =$req->email;
            $vendor->save();
        }
        //user table to manager table
        if ($req->type == 'MANAGER')
        {
            $manager= new manager();
            $manager->u_id=$user->u_id;
            $manager->manager_name = $req->name;
            $manager->manager_email =$req->email;
            $manager->save();
        }
        //user table to courier table
        if ($req->type == 'COURIER')
        {
            $courier= new courier();
            $courier->u_id=$user->u_id;
            $courier->courier_name = $req->name;
            $courier->courier_email =$req->email;
            $courier->save();
        }

        
        return redirect()->route('user.login');
    }

    // LOGIN 

    public function login()
    {
        // session()->flush();
        return view('AllUserView.Login');
    }
    
    public function loginSubmit(Request $req)
    {
        $this->validate($req,
        [
            "email"=>"required",
            "password"=>"required"
        ]);

        $user=users::where('u_email',$req->email)
                    ->where('u_pass',$req->password)
                    ->first();
        
        if($user)
        {
            if($user->u_type=="VENDOR")
            {
                session()->put('logged.vendor',$user->u_id);
                return redirect()->route('vendor.home');
            }
            else if($user->u_type=="MANAGER")
            {
                session()->put('logged.manager',$user->u_id);
                return redirect()->route('manager.home');
            }

            else if($user->u_type=="COURIER")
            {
                session()->put('logged.courier',$user->u_id);
                return redirect()->route('courier.home');
            }
            else if($user->u_type=="CUSTOMER")
            {
                session()->put('logged.customer',$user->u_id);
                return redirect()->route('customer.home');
            }
        }

        else
        {
            session()->flash('msg','User not valid');
            return back();
        }

    }

    //LOGOUT

    public function logout()
    {
        session()->flush();
        carts::truncate();
        session()->flash('msg','Sucessfully Logged out');
        return redirect()->route('user.login');
    }

    //FORGOT PASSWORD

    public function forgotPassword()
    {
        return view('AllUserView.ForgotPass');
    }

    public function forgotPasswordVerify(Request $req)
    {
        $user=users_otp::where('u_email',$req->u_email)->first();
        $this->validate($req,
        [
            'u_email'=>'required|exists:users,u_email'
        ],
        [
            'u_email.exists'=>'This email does not exist! Please enter an existing email.',
            'u_email.required'=>'Please write your email.'
        ]);
        $OTP=rand('100000','999999');
        if ($user==NULL)
        {
            $user=new users_otp();
            $user->u_email=$req->u_email;
            $user->OTP=Hash::make($OTP);
            $user->save();
        }
        else
        {
            users_otp::where('u_email',$req->u_email)->update(['OTP'=>Hash::make($OTP)]);
        }
        session()->put('email',$req->u_email);
        mail::to($req->u_email)->send(new OTPCode("OTP Code",$req->u_email,$OTP));
        return redirect()->route('user.otp',['email'=>$req->u_email]);
    }

    //OTP CODE VERIFY

    function OTP($email)
    {
        if($email==session()->get('email'))
        {
            return view('AllUserView.OtpVerify')->with('email',$email);
        }

        else
        {
            users_otp::where('u_email',session()->get('email'))->update(['OTP'=>NULL]);
            session()->flush();
            return redirect()->route('user.login');
        }
    }

    function OTPVerify($email,Request $req)
    {
        $this->validate($req,
        [
            'code'=>'required'
        ]);
        if($email==session()->get('email'))
        {
            $user=users_otp::where('u_email',$email)->first();
            if(Hash::check($req->code,$user->OTP))
            {
                return redirect()->route('user.change.password',['email'=>$email]);
            }
            else
            {
                session()->flash('msg','OTP does not match, Try again!');
                return back();
            }
        }

        //IF USER DOES NOT MATCH SESSION CLEAR ALL SESSION AND GO TO LOGIN
        else
        {
            users_otp::where('u_email',session()->get('email'))->update(['OTP'=>NULL]);
            session()->flush();
            return redirect()->route('user.login');
        }
       
    }

    //CHANGE PASSWORD

    function ChangePassword($email)
    {
        if($email==session()->get('email'))
        {
            return view('AllUserView.ChangePassword',['email'=>$email]);
        }
        else
        {
            users_otp::where('u_email',session()->get('email'))->update(['OTP'=>NULL]);
            session()->flush();
            return redirect()->route('user.login');
        }

    }

    function ChangedPassword($email,Request $req)
    {
        
        if($email==session()->get('email'))
        {
            $this->validate($req,
            [
                "password"=>"required|min:8|regex:/^.*(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$ %^&*~><.,:;]).*$/i",
                "confirmPassword"=>"required|same:password"
            ],
            [
                "password.regex"=>"Password must contain minimum 1 special character and minimum 1 upper case letter."
    
            ]);

            users::where('u_email',$email)->update(['u_pass'=>$req->password]);
            users_otp::where('u_email',$email)->update(['OTP'=>NULL,'last_changed_at'=>Carbon::now()]);
            session()->flush();
            return redirect()->route('user.login');
        }
        else
        {
            users_otp::where('u_email',session()->get('email'))->update(['OTP'=>NULL]);
            session()->flush();
            return redirect()->route('user.login');
        }
    }
}