<?php

namespace App\Http\Controllers;

use App\Mail\OTPCode;
use Illuminate\Support\Facades\Validator;
use App\Models\users;
use Illuminate\Http\Request;
use App\Models\customer;
use App\Models\manager;
use App\Models\carts;
use App\Models\vendor;
use App\Models\courier;
use App\Models\Token;
use App\Models\users_otp;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class APIAllUserController extends Controller
{
    //
    function getUsers()
    {
        $data = users::all();
        return response()->json($data);
    }

    //LOGIN

    function login(Request $req)
    {
        $validator = Validator::make($req->all(),[
            "u_pass"=>"required",
            "u_email"=>"required"
        ]);
        if ($validator->fails())
        {
            return response()->json($validator->errors(),404);
        }
        $email=$req->u_email;
        $password=$req->u_pass;
        $user=users::where('u_email',$email)
                    ->where('u_pass',$password)->first();

        if($user!=NULL)
        {
            $token=Token::where('u_id',$user->u_id)
                    ->where('role',$user->u_type)
                    ->whereNull('expired_at')->first();
            if($token!=NULL)
            {
                return response()->json($token,200);
            }
            $key=Str::random(67);  
            $token = new Token();
            $token->token=$key;
            $token->u_id=$user->u_id;
            $token->role=$user->u_type;
            $token->created_at=new DateTime();
            $token->save();
            return response()->json($token,200);
        }
        else
        {
            return response()->json(["msg"=>"Invalid user"],404);
        }
        
    }

    function getUser($email)
    {
        $data = users::where('u_email',$email)->first();
        return response()->json($data);
    }

    //logout
    public function logout(Request $req)
    {
        $key = $req->header("Authorization");
        // return response()->json($key,200);
        
        $tk = Token::where("token",$key)->first();
        $tk->expired_at = new Datetime();
        $tk->save();
        carts::truncate();
        return response()->json(["msg"=>"logged out"],200);
    }

    //Create User
    function createUser(Request $req)
    {
        $validator = Validator::make($req->all(),[
            "email"=>"required|unique:users,u_email",    
            "name"=> "required|regex:/^[A-Za-z- .,]+$/i",
            "password"=>"required|min:8|regex:/^.*(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$ %^&*~><.,:;]).*$/i",   
            "confirmpassword"=>"required|same:password",
            "type"=>"required"
            // "confirmpassword"=>"required"
            
        ],[
            "confirmpassword.required"=>"Confirm password is required"
        ]);
        
        if ($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }

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
        

        return response()->json([
            "msg"=>"User created successfully",
            "user"=>$user
        ]);
        
    }

    function sendOTP(Request $req)
    {
        $user=users_otp::where('u_email',$req->u_email)->first();
        $validator = Validator::make($req->all(),[
            "u_email"=>"required|exists:users,u_email"
        ]);
        if ($validator->fails())
        {
            return response()->json($validator->errors(),404);
        }
        $OTP=rand('100000','999999');
        if ($user==NULL)
        {
            $user=new users_otp();
            $user->u_email=$req->u_email;
            $user->OTP=Hash::make($OTP);
            $user->OTP=$OTP;
            $user->save();
        }
        else
        {
            users_otp::where('u_email',$req->u_email)->update(['OTP'=>Hash::make($OTP)]);
            // users_otp::where('u_email',$req->u_email)->update(['OTP'=>$OTP]);
        }
        // session()->put('email',$req->u_email);
        Mail::to($req->u_email)->send(new OTPCode("OTP Code",$req->u_email,$OTP));
        // return redirect()->route('user.otp',['email'=>$req->u_email]);
        return response()->json(["msg"=>"otp sent"],200);
        
    }

    //Verify OTP
    function OTPVerify(Request $req)
    {
        // $user=users_otp::where('u_email',$req->u_email)->first();
        $validator = Validator::make($req->all(),[
            "code"=>"required"
        ]);
        if ($validator->fails())
        {
            return response()->json($validator->errors(),404);
        }
        
        $user=users_otp::where('u_email',$req->email)->first();
        
        if(Hash::check($req->code,$user->OTP))
        {
            return response()->json(["msg"=>"otp matched"],200);
            
        }
        else
        {
            return response()->json(["msg"=>"OTP does not match, Try again!"],404);
        }
       
    }

    function ChangePassword(Request $req)
    {
        $validator = Validator::make($req->all(),[
            "password"=>"required|min:8|regex:/^.*(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$ %^&*~><.,:;]).*$/i",   
            "confirmpassword"=>"required|same:password"
            
            
        ],[
            "confirmpassword.required"=>"Confirm password is required",
            "password.regex"=>"Password must contain minimum 1 special character and minimum 1 upper case letter."
        ]);
        if ($validator->fails())
        {
            return response()->json($validator->errors(),404);
        }
        users::where('u_email',$req->email)->update(['u_pass'=>$req->password]);
        users_otp::where('u_email',$req->email)->update(['OTP'=>NULL,'last_changed_at'=>Carbon::now()]);
        return response()->json(["msg"=>"password changed"],200);
         
    }

    function clearOTP(Request $req)
    {
        $bool=users_otp::where('u_email',$req->email)->update(['OTP'=>NULL]);
        // return response()->json($bool,200);
        return response()->json(["msg"=>"OTP has been cleared"],200);
    }
}