<?php

namespace App\Http\Controllers;

use App\Mail\SupplyOrder;
use App\Models\contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\supply;
use App\Models\medicine;
use App\Models\users;
use App\Models\order;
use App\Models\supply_cart;
use App\Models\orders_cart;
use App\Models\account;
use App\Models\users_otp;
use App\Models\Token;
use App\Models\manager;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DateTime;

class ApiManagerController extends Controller
{
    //homepage
    function homepage()
    {
        return response()->json(200);
    }

    //search
    function searchView()
    {
        return response()->json(200);
    }

    //view medicine table
    function viewMed()
    {
        $val=medicine::all();
        return response()->json($val,200);
    }

    //view user table
    function viewUser()
    {
        $val=users::all();
        return response()->json($val,200);
    }

    //view order table
    function viewOrders()
    {
        $val=order::all();
        return response()->json($val,200);
    }

    //delete medicine
    function deleteMed(Request $req)
    {
        medicine::where('med_id',$req->m_id)->delete();
        return response()->json(["msg"=>"Medicine deleted successfully!"],200);
    }

    //show supply table
    function showSupply()
    {
        $val=supply::all();
        return response()->json($val,200);
    }

    //ADD TO CART
    function addItem(Request $req)
    {
        $validator = Validator::make($req->all(),
        [
            'quantity' => 'gt:0'
        ],
        [
            'quantity.gt' => 'Quantity must be atleast 1'
        ]);
        if ($validator->fails())
        {
            return response()->json($validator->errors(),404);
        }
        $val=supply::where("supply_id",$req->supply_id)->first();
        if($req->quantity>$val->stock) //stock check
        {
            return response()->json(['msg'=>'Sorry, we are currently low on stock!'],422);
        }
        $total=$req->quantity*$val->price_perUnit;
        $dat=supply_cart::all();
        for ($i=0; $i < count($dat); $i++) //checking if item already added
        { 
            if($val->med_id==$dat[$i]->med_id)
            {
                $cart=supply_cart::where('med_id',$val->med_id)
                ->update(
                    ['quantity'=>$req->quantity+$dat[$i]->quantity,
                    'total_price'=>$total+$dat[$i]->total_price]
                );
                supply::where('supply_id',$req->supply_id)->update(['stock'=>$val->stock-$req->quantity]);
                return response()->json($cart,200);
            }
        }
        $item = new supply_cart();
        $item->med_name=$val->med_name;
        $item->med_id=$val->med_id;
        $item->vendor_id=$val->vendor_id;
        $item->price_perUnit=$val->price_perUnit;
        $item->quantity=$req->quantity;
        $item->total_price=$total;
        $item->save();

        supply::where('supply_id',$req->supply_id)->update(['stock'=>$val->stock-$req->quantity]);
        return response()->json($item,200);

    }

    //final cart
    function finalCart()
    {
        $dat=supply_cart::all();
        $tot=0;
        foreach($dat as $d)
        {
            $tot+=$d->total_price;
        }
        return response()->json($tot,200);
    }

    //view cart
    function viewCart()
    {
        $val=supply_cart::all();
        return response()->json($val,200);
    }

    //confirm order
    public function confirm(Request $req)
    {
        $id=0;
        $v=supply_cart::all();
        $dat=contract::orderby('order_id','DESC')->first();
        //$vend=vendor::where('vendor_id',$v[0]->vendor_id)->first();
        if($dat==NULL)
        {
            $id=1;
        }
        else
        {
           $id=$dat->contract_id+1;
        }

        foreach($v as $val)
        {
            $item = new contract();

            $item->contract_id=$id;
            $item->vendor_id=$val->vendor_id;
            $item->manager_id=1;
            $item->med_name=$val->med_name;
            $item->quantity=$val->quantity;
            $item->total_price=$val->total_price;
            $item->save();
        }
        // $name=users::where('u_id',session()->get('logged.manager'))->first();

        mail::to('faiyazkhondakar@gmail.com')->send(new SupplyOrder("Suppy Order Placement","Hi","tonmoy",$v));
        supply_cart::truncate();
        return response()->json(["msg"=>"Order Confirmed"],200);
    }

    //show contract table
    function showContract()
    {
        //$val=contract::select("contract_id","vendor_id","contract_status","med_name","price_perUnit")->distinct("contract_id")->get();
        $val=contract::all();
        $v=array();
        for ($i = count($val)-1; $i >=1; $i--)
        {
            for ($j = $i-1; $j >= 0; $j--)
            {
                if ($val[$i]->contract_id==$val[$j]->contract_id)
                {
                    $val[$j]->med_name=$val[$j]->med_name.",".$val[$i]->med_name;
                    unset($val[$i]);
                    $i--;
                }
            }
        }
        foreach($val as $t)
        {
            if($t!=null)
            {
                $v[]=$t;
            }
        }
        
        //$val=array_values($val)
        return response()->json($v,200);
    }

    //delete contract
    function deleteContract(Request $req)
    {
        contract::where('contract_id',$req->c_id)->delete();
        return response()->json(["msg"=>"Contract deleted successfully!"],200);
    }

    //shpw query
    function showQuery()
    {
        $val=orders_cart::all();
        return response()->json($val,200);
    }

    //accept query
    function acceptQuery(Request $req)
    {
        $quan=orders_cart::where('id',$req->id)->first();
        $med=medicine::where('med_id',$quan->med_id)->first();
        $stock=$quan->quantity+$med->Stock;
        orders_cart::where('id',$req->id)
        ->update(['return_status'=>'accepted']);
        medicine::where('med_id',$quan->med_id)
        ->update(['Stock'=>$stock]);
        $date=Carbon::today()->toDateString();
        $rev=account::where('date',$date)->first();
        $price= $quan->quantity*$med->price_perUnit;
        if($rev)
        {
            $temp= $rev->revenue-$price;
            account::where('date',$date)
            ->update(['revenue'=> $temp]);
        }
        else
        {
            $item= new account();
            $item->date= Carbon::today()->toDateString();
            $item->revenue= 0-$price;
            $item->save();
        }
        return response()->json(["msg="=>"Accepted"],200);
    }

    //decline query
    function declineQuery(Request $req)
    {
        orders_cart::where('id',$req->id)
        ->update(['return_status'=>'declined']);
        return response()->json(["msg"=>"declined"],200);
    }

    //show account table
    function showAccount()
    {
        $val=account::all();
        return response()->json($val,200);
    }

    //med detail
    function medDetail(Request $req,$id)
    {
        //$val=array();
        $val=medicine::where("med_id",$id)->get();
        if($val[0]!=NULL)
        {
            return response()->json($val,200);    
        }
        return response()->json(["msg"=>"Medicine does not exist"],404);
    }

    //order detail
    function ordersDetail(Request $req,$id)
    {
        $val=order::where("order_id",$id)->get();
        if($val[0]!=NULL)
        {
            return response()->json($val,200);    
        }
        return response()->json(["msg"=>"Order does not exist"],404);
    }

    //contract detail
    function contractDetail(Request $req,$id)
    {
        $val=contract::where("contract_id",$id)->get();
        if($val[0]!=NULL)
        {
            return response()->json($val,200);    
        }
        return response()->json(["msg"=>"Contract does not exist"],404);
    }

    //supply detail
    function supplyDetail(Request $req,$id)
    {
        $val=supply::where("supply_id",$id)->get();
        if($val[0]!=NULL)
        {
            return response()->json($val,200);    
        }
        return response()->json(["msg"=>"Supply does not exist"],404);
    }

    //user detail
    function userDetail(Request $req,$id)
    {
        $val=users::where("u_id",$id)->get();
        if($val[0]!=NULL)
        {
            return response()->json($val,200);    
        }
        return response()->json(["msg"=>"User does not exist"],404);
    }

    //delete user
    function deleteUser(Request $req)
    {
        users::where('u_id',$req->u_id)->delete();
        return response()->json(["msg"=>"User deleted successfully!"],200);
    }

    //sort account by month
    // function sortMonth()
    // {
    //     $val=account::all();

    // }

    //password change
    function passChange(Request $req)
    {
        $val=$this->getID($req->header("Authorization"));
        $validator = Validator::make($req->all(),[
            "pass"=>"required",
            "new"=>"required|min:8|regex:/^.*(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$ %^&*~><.,:;]).*$/i",   
            "con"=>"required|same:new"
            
            
        ],[
            "pass.required"=>"You must enter your current password!",
            "con.required"=>"Confirm password is required",
            "new.regex"=>"Password must contain minimum 1 special character and minimum 1 upper case letter.",
            "con.same"=>"Sorry the new passowrd does not match!"
        ]);
        if ($validator->fails())
        {
            return response()->json($validator->errors(),404);
        }
        if($req->pass==$val->u_pass)
        {
            users::where('u_email',$val->u_email)->update(['u_pass'=>$req->new]);
            return response()->json(["msg"=>"hi"]);
        }
        users_otp::where('u_email',$val->u_email)->update(['OTP'=>NULL,'last_changed_at'=>Carbon::now()]);
        return response()->json(["msg"=>"password changed"],200);
    }

    //get id of current user
    public function getID($token)
    {
        $u_id=Token::where('token',$token)->first();
        if($u_id->role=="MANAGER")
        {
        $info=users::where('u_id',$u_id->u_id)->first();
        return $info;
        }
    }

    //get Pro Pic
    function getProPic(Request $req)
    {
        $val=$this->getID($req->header("Authorization"));
        return response()->json(['u_id'=>$val->u_id]);
    }

    //change profile picture
    function changeProPic(Request $req)
    {
        $validator = Validator::make($req->all(),
            [
                "profilepic"=>"mimes:jpg,png,jpeg"
            ]);
        if ($validator->fails())
        {
            return response()->json($validator->errors(),404);
        }
        $val=$this->getID($req->header("Authorization"));
        $img =$val->u_id.".jpg";
        $req->file('profilepic')->storeAs('public/propics',$img);
        manager::where('u_id',$val->u_id)
                ->update(
                    ['image'=>$img],
                );
        return response()->json(["msg"=>"Profile updated"],200);
    }

    //view profile
    function viewProfile(Request $req)
    {
        $val=$this->getID($req->header("Authorization"));
        return response()->json($val,200);
    }

    //monthly account chart
    function monthlyChart()
    {
        $i=account::select(DB::raw("(SUM(revenue)) as sum"),DB::raw("(SUM(expenses)) as sum1"),DB::raw("DATE_FORMAT(date,'%M %Y') as monthname"))
                ->orderBy('date','ASC')
                ->groupBy('monthname')
                ->whereNotNull('date')
                ->get();
        $revenue=array();
        $expense=array();
        $month=array();
        foreach($i as $o)
        {  
            $revenue[]=$o->sum;
            $expense[]=$o->sum1;
            $month[]=$o->monthname;
        }
        return response()->json(["bill"=>$revenue,"exp"=>$expense,"month"=>$month],200);
    }

    //myearly account chart
    function yearlyChart()
    {
        $i=account::select(DB::raw("(SUM(revenue)) as sum"),DB::raw("(SUM(expenses)) as sum1"),DB::raw("YEAR(date) as year"))
                ->orderBy('date','ASC')
                ->groupBy('year')
                ->whereNotNull('date')
                ->get();
        $revenue=array();
        $expense=array();
        $year=array();
        foreach($i as $o)
        {  
            $revenue[]=$o->sum;
            $expense[]=$o->sum1;
            $year[]=$o->year;
        }
        return response()->json(["bill"=>$revenue,"exp"=>$expense,"year"=>$year],200);
    }

    //remove item from cart
    function removeItem(Request $req)
    {
        $val=supply_cart::where('cart_id',$req->c_id)->first();
        $val2=supply::where('med_id',$val->med_id)->first();
        $quantity=$val->quantity+$val2->stock;
        supply::where('med_id',$val->med_id)
            ->update(
                ['stock'=>$quantity]
            );
        //     return back();
        supply_cart::where("cart_id",$req->c_id)->delete();
        return response()->json(["msg"=>"Successfully removed"],200);
    }
}