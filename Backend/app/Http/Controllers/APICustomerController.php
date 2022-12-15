<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use App\Mail\sendComplain;
use App\Models\carts;
use App\Models\customer;
use App\Models\medicine;
use App\Models\order;
use App\Models\orders_cart;
use App\Models\Token;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class APICustomerController extends Controller
{
    function getInfo(Request $req)
    {
        $customer_id=$this->getID($req->header("Authorization"));
        $data = customer::where('customer_id',$customer_id)->first();
        return response()->json($data);
    }
    public function getID($token)
    {
        $u_id=Token::where('token',$token)->first();
        $info=users::where('u_id',$u_id->u_id)->first();
        if ($info->u_type=='CUSTOMER')
        {
            $customer_id=customer::where('u_id',$info->u_id)->first();
            // return "hello";
            return $customer_id->customer_id;
        }
    }
    //
    function home()
    {
        return response()->json(200);
    }

    //SHOW MEDICINE
    function showMed()
    {
        $med=medicine::all();
        return response()->json($med,200);
    }

    //ADD TO CART
    function addToCart(Request $req)
    {
        $validator = Validator::make($req->all(),
            [
                'quantity'=> 'required|numeric|max:'.$req->Stock.'|gt:0'
            ],
            [
                'quantity.required'=>'You did not specify the amount!',
                'quantity.gt'=>'Minimum order quantity must be atleast 1',
                'quantity.max'=>'The requested amount is not available'
            ]);

        if ($validator->fails())
        {
            return response()->json($validator->errors(),404);
        }
        //find cart_id
        $customer_id=$this->getID($req->header("Authorization"));
        $med=medicine::where('med_id',$req->med_id)->first();
        $carts=carts::where('med_id',$req->med_id)->first();
        if ($carts==NULL)
        {
            $info=order::orderBy('cart_id','DESC')->first();
        
            $cart= new carts();
            if ($info==NULL)
            {
                $cart->cart_id=1;
            }
            else
            {
                $cart->cart_id=$info->cart_id+1;
            }  
            $cart->customer_id=$customer_id;
            $cart->med_id= $req->med_id;
            $cart->price_perUnit=$med->price_perUnit;
            $cart->med_name=$med->med_name;
            $cart->quantity=$req->quantity;
            $cart->total=$req->quantity*$med->price_perUnit;
            $cart->save();

            
        }
        else
        {
            $cart=carts::where('med_id',$req->med_id)
                ->update(['quantity'=>$carts->quantity+$req->quantity,'total'=>$carts->total+$req->quantity*$med->price_perUnit]);
        }

        medicine::where('med_id',$req->med_id)->update(['Stock'=>$req->Stock-$req->quantity]);
        return response()->json($cart,200);

    }

    // SHOW CART
    function showCart()
    {
        $cart=carts::all();
        $total=0;
        if (count($cart)>0)
        {
            foreach($cart as $item)
            {
                $total=$total+$item->total;
            }
            // return response()->json(["total"=>$total],200);         
            return response()->json($cart,200);         
        }
        
        return response()->json(["msg"=>"EMPTY CART"],404);         
        
    }

    function getGrandTotal()
    {
        $cart=carts::all();
        $total=0;
        if (count($cart)>0)
        {
            foreach($cart as $item)
            {
                $total=$total+$item->total;
            }
            // return response()->json(["total"=>$total],200);         
            return response()->json(["total"=>$total],200);         
        }
    }

    //GET GRAND TOTAL
    function getTotal()
    {
        $cart=carts::all();
        $total=0;
        if (count($cart)>0)
        {
            foreach($cart as $item)
            {
                $total=$total+$item->total;
            }
            // return response()->json(["total"=>$total],200);         
            return $total;         
        }
    }
    
    //REMOVE FROM CART

    function deleteItem(Request $req)
    {
        $total=carts::where('item_id',$req->item_id)->first();
        $info=medicine::where('med_id',$total->med_id)->first();
        // return $info;
        medicine::where('med_id',$total->med_id)->update(['Stock'=>$info->Stock+$total->quantity]);
        carts::where('item_id',$req->item_id)->delete();
        // $subtotal=session()->get('subtotal')-$total->total;
        // session()->put('subtotal',$subtotal);
        return response()->json(["msg"=>"Item removed successfully"],200);
        

    }

    //CONFIRM ORDER

    public function confirmOrder(Request $req)
    {
        $user=customer::where('customer_id',$this->getID($req->header("Authorization")))->first();
        $info=order::orderBy('cart_id','DESC')->first();
        $order=new order();
        $order->customer_id=$user->customer_id;
        $order->totalbill=$this->getTotal()+15;
        if ($info==NULL)
        {
            $order->cart_id=1;
        }
        else
        {
            $order->cart_id=$info->cart_id+1;
        }  
        $order->save();

        $information=order::orderBy('order_id','DESC')->first();


        $it=carts::all();

        // return $items;
        
        foreach($it as $item)
        {
            $add=new orders_cart();
            $add->order_id=$information->order_id;
            $add->cart_id=$information->cart_id;
            $add->items=$item->med_name;
            $add->quantity=$item->quantity;
            $add->med_id=$item->med_id;
            $add->save();
        }
        carts::truncate();
        mail::to($user->customer_email)->send(new OrderConfirmation("ORDER CONFIRMATION MAIL",$user->customer_id,
                                                                               $user->customer_name,$information->cart_id));
        return response()->json($order,200);
    }

    //SHOW ORDERS

    function showOrders(Request $req)
    {
        $customer_id=$this->getID($req->header("Authorization"));
        $orders=order::where('customer_id',$customer_id)->orderBy('order_id','DESC')->get();
        return response()->json($orders,200);
    }

    // SHOW ITEMS FROM ORDER
    function showItems($order_id)
    {
        $items=orders_cart::where('order_id',$order_id)->get();
        return response()->json($items,200);
        
    }

    //CANCEL ORDER

    function cancelOrder($order_id)
    {
        $orders=order::where('order_id',$order_id)->get();
        foreach ($orders as $order)
        {
            foreach($order->orders_cart as $item)
            {
                $med=medicine::where('med_id',$item->med_id)->first();
                medicine::where('med_id',$item->med_id)->update(['Stock'=>$med->Stock+$item->quantity]);   
            }
        }
        order::where('order_id',$order_id)->update(['order_status'=>'Cancelled']);
        return response()->json(["msg"=>"order cancelled"],200);
    }

    //RETURN ITEMS

    function returnItems(Request $req)
    {
        $or= array();
        $customer_id=$this->getID($req->header("Authorization"));
        $order=order::where('customer_id',$customer_id)
                    ->where('order_status','delivered')->get();
        foreach($order as $o)
        {
            foreach($o->orders_cart as $o)
            {
                $or[]=$o;
            }
            // return $o;
            
        }
        return response()->json($or,200);
    }

    function return($id)
    {
        orders_cart::where('id',$id)->update(['return_status'=>'true']);
        return response()->json([],200);
    }
    
    //PROFILE UPDATE

    public function customerModify(Request $req)
    {
        // return response()->json($req);
        $customer_id=$this->getID($req->header("Authorization"));
        $info=Token::where('token',$req->header("Authorization"))->first();
        $u_id=$info->u_id;
        $validator = Validator::make($req->all(),
            [
                "name"=> "required|regex:/^[A-Za-z- .,]+$/i",
                "profilepic"=>"mimes:jpg,png,jpeg"
            ]);
        if ($validator->fails())
        {
            return response()->json($validator->errors(),404);
        }
        if ($req->hasFile('profilepic'))
        {
            // return response()->json($req);

            $imgname =$u_id.".jpg";
            $req->file('profilepic')->storeAs('public/profilepictures',$imgname);
            //
            users::where('u_id',$u_id)
                        ->update(
                            [
                                'u_name'=>$req->name,
                            ]
                        );
            customer::where('customer_id',$customer_id)
                        ->update(
                            [
                                'customer_name'=>$req->name,
                                'img'=>$imgname
                            ]
                        );
        }
        else
        {
            users::where('u_id',$u_id)
                        ->update(
                            [
                                'u_name'=>$req->name,
                            ]
                        );
            customer::where('customer_id',$customer_id)
            ->update(
                [
                    'customer_name'=>$req->name,
                ]
            );
        }
        return response()->json(["msg"=>"Profile updated"],200);

    }

    //SEARCH MEDICINE USING NAME
    function search(Request $req)
    {
        if($req->filter=="ORDER BY PRICE HIGHEST TO LOWEST")
        {
            $meds=medicine::where('med_name','LIKE','%'.$req->search.'%')->orderBy('price_perUnit','DESC')->get();
        }

        else if($req->filter=="ORDER BY PRICE LOWEST TO HIGHEST")
        {
            $meds=medicine::where('med_name','LIKE','%'.$req->search.'%')->orderBy('price_perUnit','ASC')->get();
        }

        else
        {
            $meds=medicine::where('med_name','LIKE','%'.$req->search.'%')->get();
        }

        return response()->json($meds,200);
    }

    // FILE A COMPLAIN
    function complainEmail(Request $req)
    {
        mail::to('ayesha.akhtar.1999@gmail.com')->send(new sendComplain("Complain from Customer#".$req->customer_id,$req->customer_id,
                                                                               $req->msg));
        return response()->json(["msg"=>"MAIL SENT SUCCESSFULLY"],200);                                                                        
    }

    function showChart(Request $req)
    {
        $customer=$this->getID($req->header("Authorization"));
        $bill=array();
        $day=array();
        $order=order::where("delivery_time","!=",NULL)
                    ->orderBy('delivery_time','ASC')
                    ->where("customer_id",$customer)->get();
        foreach($order as $o)
        {  
            $bill[]=$o->totalbill;
            $day[]=date("j F, Y, g:i a", strtotime($o->delivery_time));
        }
        return response()->json(["bill"=>$bill,"day"=>$day],200);
        
    }


    function showChartMonthly(Request $req)
    {
        // $info=order::where("order_status","delivered")->sum("totalbill");
        $i=order::select(DB::raw("(SUM(totalbill)) as sum"),DB::raw("DATE_FORMAT(delivery_time,'%M %Y') as monthname"))
                ->orderBy('delivery_time','ASC')
                ->groupBy('monthname')
                ->whereNotNull('delivery_time')
                ->get();
        $bill=array();
        $month=array();
        foreach($i as $o)
        {  
            $bill[]=$o->sum;
            $month[]=$o->monthname;
        }
        return response()->json(["bill"=>$bill,"month"=>$month],200);
        
    }

    function showChartYearly(Request $req)
    {
        // $info=order::where("order_status","delivered")->sum("totalbill");
        $i=order::select(DB::raw("(SUM(totalbill)) as sum"),DB::raw("YEAR(delivery_time) as year"))
                ->whereNotNull('delivery_time')
                ->orderBy('delivery_time','ASC')
                ->groupBy('year')
                ->get();
        $bill=array();
        $year=array();
        foreach($i as $o)
        {  
            $bill[]=$o->sum;
            $year[]=$o->year;
        }
        // return response()->json($i,200);

        return response()->json(["bill"=>$bill,"year"=>$year],200);
        
    }
}
    