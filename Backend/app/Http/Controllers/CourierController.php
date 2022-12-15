<?php

namespace App\Http\Controllers;

use App\Mail\orderAccepted;
use App\Models\courier;
use App\Models\customer;
use App\Models\order;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDO;
use App\Models\account;
use Carbon\Carbon;


class CourierController extends Controller
{
    public function courierHome()
        {
            $u_id=session()->get('logged.courier');
            $courier=courier::where('u_id',$u_id)->first();
            session()->put('name',$courier->courier_name);
            return view('CourierView.home')->with('name',$courier->courier_name);
        }

    public function orderView(){
        $orders=order::paginate(5);
        return view ('CourierView.orders')->with('orders',$orders);
    }

    public function AcceptedOrderView(){
        $status="accepted";
        $AcceptedOrders=order::where('order_status',$status)->get();
        return view ('CourierView.AcceptedOrders')->with('AcceptedOrders',$AcceptedOrders);
    }

    public function acceptOrder($order_id){
        $dateNtime=Carbon::now();
        $modified = order::where('order_id',$order_id)
        ->update(
            [
                'order_status'=>'accepted',
                'accepted_time'=>$dateNtime
            ]
            );
        return redirect()->route('courier.mail',['order_id'=>$order_id]);
    }

    public function deliveredOrder($order_id){
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
        $u_id=session()->get('logged.courier');
        $courier=courier::where('u_id',$u_id)->first();
        $modified1=courier::where('u_id',$u_id)
        // ->increment('due_delivery_fee',15);
        ->update(
            [
                'due_delivery_fee'=>$courier->due_delivery_fee+15
            ]
            );
        return redirect()->route('courier.AcceptedOrder');
    }

    public function sendMail($order_id){
        $order=order::where('order_id',$order_id)->first();
        $customer=customer::where('customer_id',$order->customer_id)->first();
        // Mail::to($customer->customer_email)->send(new orderAccepted($order));
        Mail::to('tahmidislam73@gmail.com')->send(new orderAccepted($order));
        return redirect()->route('courier.order');
    }

    public function courierProfile(){
        $u_id=session()->get('logged.courier');
        $courier=courier::where('u_id',$u_id)->first();
        return view('CourierView.profileView',['id',$u_id])->with('courier',$courier);
    }

    public function courierProfileEdit(Request $req,$u_id)
    {
        $name=$req->name;
        $u_id=$req->u_id;
        $this->validate($req,
        [
             "name"=> "required|regex:/^[A-Za-z- .,]+$/i",
             "password"=>"required", //a|min:8|regex:/^.*(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$ %^&*~><.,:;]).*$/i",
             "confirmPassword"=>"required|same:password",
             "email"=>"required",
             //"profilepic"=>"mimes:jpg,png,jpeg"
        ]);
////////////////


if ($req->hasFile('profilepic'))
        {
            $img = session()->get('logged.courier').".jpg";
            $req->file('profilepic')->storeAs('public/profilepictures/courier/',$img);
            //
            users::where('u_id',$u_id)
                        ->update(
                            [
                                'u_name'=>$req->name,
                                'u_pass'=>$req->password
                            ]
                        );
            courier::where('courier_id',$req->courier_id)
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
            courier::where('courier_id',$req->courier_id)
            ->update(
                [
                    'courier_name'=>$req->name,
                ]
            );
        }
        
///////////////


        session()->put('name',$name);
        return redirect()->route('courier.profile',['id'=>$u_id]);
    }

    public function cashoutView(){
        $u_id=session()->get('logged.courier');
        $courier=courier::where('u_id',$u_id)->first();
        return view('CourierView.cashout',['id',$u_id])->with('courier',$courier);
    }

    public function cashout(Request $req,$u_id)
    {
        $name=$req->name;
        $u_id=$req->u_id;
        $availableAmount=$req->availableAmount;
        $amount=$req->amount;
        //return $availableAmount;
        $this->validate($req,
        [
            "amount"=> "lte:availableAmount"
        ]);

        courier::where('courier_id',$req->courier_id)
        ->update(
            [
                'due_delivery_fee'=>$req->availableAmount-$req->amount
            ]
        );

        session()->put('name',$name);
        return redirect()->route('courier.profile',['id'=>$u_id]);
    }

}
