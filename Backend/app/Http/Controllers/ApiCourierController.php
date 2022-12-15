<?php


namespace App\Http\Controllers;

use App\Mail\orderAccepted;
use App\Models\courier;
use App\Models\customer;
use App\Models\order;
use App\Models\users;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDO;
use App\Models\account;
use Carbon\Carbon;


class ApiCourierController extends Controller
{
    public function getID($token)
    {
        $u_id=Token::where('token',$token)->first();
        $info=users::where('u_id',$u_id->u_id)->first();
        if ($info->u_type=='COURIER')
        {
            $courier_id=courier::where('u_id',$info->u_id)->first();
            // return "hello";
            return $courier_id->courier_id;
        }
    }

    public function getUID($token)
    {
        $u_id=Token::where('token',$token)->first();
        return $u_id->u_id;
    }

    public function orderView(){
        $data = order::all();
        return response()->json($data);
    }


    //accepted orders view
    public function AcceptedOrderView(){
        $status="accepted";
        $AcceptedOrders=order::where('order_status',$status)->get();
        return response()->json($AcceptedOrders);
    }

    //accepting orders
    public function acceptOrder($order_id){
        $dateNtime=Carbon::now();
        $modified = order::where('order_id',$order_id)
        ->update(
            [
                'order_status'=>'accepted',
                'accepted_time'=>$dateNtime
            ]
            );
        $order=order::where('order_id',$order_id)->first();
        $customer=customer::where('customer_id',$order->customer_id)->first();
        // Mail::to($customer->customer_email)->send(new orderAccepted($order));
        Mail::to('tahmidislam73@gmail.com')->send(new orderAccepted($order));
        return response()->json("done");
    }

    //delivery order
    


    //profile view 

    function getProfile(Request $req)
    {
        $courier_id=$this->getID($req->header("Authorization"));
        $data = courier::where('courier_id',$courier_id)->first();
        return response()->json($data);
    }

    //delivered orders
    public function deliveredOrder(Request $req,$order_id){
        $dateNtime=Carbon::now();
        $modified = order::where('order_id',$order_id)
        ->update(
            [
                'order_status'=>'delivered',
                'delivery_time'=>$dateNtime,
            ]
        );

        
        $date=Carbon::today()->toDateString();
        $new= order::where('order_id',$order_id)->first();
        $rev=account::where('date',$date)->first();
        if($rev)
        {
            $temp=$rev->revenue+$new->totalbill;
            account::where('date',$date)
            ->update(['revenue'=> $temp]);
        }
        else
        {
            $item= new account();
            
            $item->date= $date;
            $item->revenue= $new->totalbill;
            $item->save();
        }

        //$order=order::where('order_id',$order_id);
        $u_id=$this->getUID($req->header("Authorization"));
        $courier=courier::where('u_id',$u_id)->first();
        $modified1=courier::where('u_id',$u_id)
        // ->increment('due_delivery_fee',15);
        ->update(
            [
                'due_delivery_fee'=>$courier->due_delivery_fee+15
            ]
            );
        return response()->json("done");
    }

    //send mail 
    public function sendMail($order_id){
        $order=order::where('order_id',$order_id)->first();
        $customer=customer::where('customer_id',$order->customer_id)->first();
        // Mail::to($customer->customer_email)->send(new orderAccepted($order));
        Mail::to('tahmidislam73@gmail.com')->send(new orderAccepted($order));
        return redirect()->route('courier.order');
    }
     
    //profile edit
    public function courierProfileEdit(Request $req)
    {
        $courier_id=$this->getID($req->header("Authorization"));
        $info=Token::where('token',$req->header("Authorization"))->first();
        $u_id=$info->u_id;
        $this->validate($req,
        [
            //  "name"=> "required|regex:/^[A-Za-z- .,]+$/i",
            //  "password"=>"required", //a|min:8|regex:/^.*(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$ %^&*~><.,:;]).*$/i",
            //  "confirmPassword"=>"required|same:password",
            //  "email"=>"required",
             //"profilepic"=>"mimes:jpg,png,jpeg"
        ]);
////////////////


if ($req->hasFile('profilepic'))
        {
            $img = $u_id.".jpg";
            $req->file('profilepic')->storeAs('public/profilepictures/courier/',$img);
            //
            users::where('u_id',$u_id)
                        ->update(
                            [
                                'u_name'=>$req->name,
                                'u_pass'=>$req->password
                            ]
                        );
            courier::where('courier_id',$courier_id)
            ->update(
                [
                    'courier_name'=>$req->name,
                    'img'=>$img
                ]
            );
        }
        else
        {
            users::where('u_id',$u_id)
            ->update(
                [
                'u_name'=>$req->name,
                'u_pass'=>$req->password
                ]
                        );
            courier::where('courier_id',$courier_id)
            ->update(
                [
                    'courier_name'=>$req->name,
                ]
            );
        }
        return response()->json(["msg"=>"Profile updated"], 200);
    }

    //cashout
    public function cashout(Request $req)
    {
        
        $courier_id=$this->getID($req->header("Authorization"));
        $info=Token::where('token',$req->header("Authorization"))->first();
        $u_id=$info->u_id;
        $availableAmount=$req->availableAmount;
        $amount=$req->amount;
        //return $availableAmount;
        $this->validate($req,
        [
            "amount"=> "lte:availableAmount"
        ]);
        $bool=courier::where('courier_id',$courier_id)
        ->update(
            [
                'due_delivery_fee'=>$req->availableAmount-$req->amount
            ]
        );

        //session()->put('name',$name);
        return response()->json(["courier_id"=>$courier_id,"bool"=>$bool,"msg"=>"Cash withdraw done","amount"=>$req->availableAmount-$req->amount],200);
    }

    

    //CASHOUT VIEW 
    public function cashoutView(Request $req){
        $courier_id=$this->getID($req->header("Authorization"));
        $info=Token::where('token',$req->header("Authorization"))->first();
        $u_id=$info->u_id;
        $courier=courier::where('u_id',$u_id)->first();
        return response()->json($courier,200);
    }
}
