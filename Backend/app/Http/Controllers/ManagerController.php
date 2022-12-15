<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SupplyOrder;
use App\Models\manager;
use App\Models\customer;
use App\Models\vendor;
use App\Models\courier;
use App\Models\users;
use App\Models\medicine;
use App\Models\order;
use App\Models\contract;
use App\Models\supply;
use App\Models\supply_cart;
use App\Models\orders_cart;
use App\Models\account;
use Carbon\Carbon;

class ManagerController extends Controller
{

    //Homepage Methods

    public function managerHome() //view manager homepage
    {
        $id=session()->get('logged.manager');

        $manager=manager::where('u_id',$id)->first();
        session()->put('manager_id',$manager->manager_id);
        $val=manager::where('u_id',$id)->first();
        session()->put('name',$val->manager_name);
        return view('ManagerView.Homepage')->with('manager',$val);
    }

    public function HomeAction(Request $req) // selecting button actions
    {
        if($req->action=='View Users')
        {
            return redirect()->route("manager.tableSelect");
        }
        elseif($req->action=='View Medicine')
        {
            return redirect()->route("manager.tableMedicine");
        }
        elseif($req->action=='View Orders')
        {
            return redirect()->route("manager.tableOrder");
        }
        elseif($req->action=='View Contracts')
        {
            return redirect()->route("manager.tableContracts");
        }
        elseif($req->action=='View Supply')
        {
            return redirect()->route("manager.tableSupply");
        }
        elseif($req->action=='Go to Cart')
        {
            return redirect()->route("manager.tableSupplyOrder");
        }
        else if($req->action=='View Query')
        {
            return redirect()->route("manager.tableViewQuery");
        }
        else if($req->action=='View Account')
        {
            return redirect()->route("manager.tableViewAccount");
        }
        else if($req->action=='Search')
        {
            //return redirect()->route('manager.search');
            $this->validate($req,
            [
                'searchBar' => 'required'
            ],
            [
                'searchBar.required' => 'Please enter id'
            ]);

            session()->put('searchID',$req->searchBar);
            //return session()->get('searchID');

            if($req->search=="user")
            {
                return redirect()->route('search.user');
            }
            else if($req->search=="medicine")
            {
                return redirect()->route('search.medicine');
            }
            else if($req->search=="contract")
            {
                return redirect()->route('search.contract');
            }
            else if($req->search=="order")
            {
                // session()->put('search')
                return redirect()->route('search.order');
            }
            else if($req->search=="supply")
            {
                return redirect()->route('search.supply');
            }
        }

    } 

    //TableSelect methods

    public function tableSelect() //view table selecting form
    {
        return view("ManagerView.TableSelect");
    }

    public function viewTable(Request $req) // table selecting for users
    {
        if($req->user=='Manager')
        {
            return redirect()->route("manager.tableManager");
        }
        else if($req->user=='Vendor')
        {
            return redirect()->route("manager.tableVendor");
        }
        else if($req->user=='Courier')
        {
            return redirect()->route("manager.tableCourier");
        }
        else if($req->user=='Customer')
        {
            return redirect()->route("manager.tableCustomer");
        }
    }

    //ViewTable methods

    public function viewCustomer() //view customer table
    {
        $val=users::where('u_type',"CUSTOMER")->paginate(10);
        return view("ManagerView.ViewTable")->with('Val',$val);
    }

    public function viewCourier() //view courier table
    {
        $val=users::where('u_type',"COURIER")->paginate(10);
        return view("ManagerView.ViewTable")->with('Val',$val);
    }

    public function viewVendor() //view vendor table
    {
        $val=users::where('u_type',"VENDOR")->paginate(10);
        return view("ManagerView.ViewTable")->with('Val',$val);
    }

    public function viewManager() //view manager table
    {
        $val=users::where('u_type',"MANAGER")->paginate(10);
        return view("ManagerView.ViewTable")->with('Val',$val);
    }

    //ViewDetails methods

    public function userInfo($id)
    {
        $val=users::where("u_id",$id)->first();
        return view('ManagerView.ViewDetails')->with('val',$val);
    }

    //Delete users methods

    public function userDelete($id)
    {
        $val=users::where("u_id",$id)->first();
        if($val->u_type=="CUSTOMER")
        {
            customer::where("u_id",$id)->delete();
        }
        if($val->u_type=="COURIER")
        {
            courier::where("u_id",$id)->delete();
        }
        if($val->u_type=="VENDOR")
        {
            vendor::where("u_id",$id)->delete();
        }
        if($val->u_type=="MANAGER")
        {
            manager::where("u_id",$id)->delete();
        }
        users::where("u_id",$id)->delete();
        return back();
    }

    //View Medicine

    public function viewMed() //view medicine table
    {
        $val=medicine::paginate(10);
        return view("ManagerView.ViewMed")->with('data',$val);
    }

    //Delete Medicine

    public function medDelete($id)
    {
        medicine::where("med_id",$id)->delete();
        return back();
    }

    //view med info

    public function medInfo($id)
    {
        $val=medicine::where("med_id",$id)->first();
        return view('ManagerView.MedDetails')->with('val',$val);
    }

    //View Order

    public function viewOrder() //view order table
    {
        $val=order::paginate(10);
        return view("ManagerView.ViewOrders")->with('data',$val);
    }

    //view order info

    public function orderInfo($id)
    {
        $val=order::where("order_id",$id)->first();
        return view('ManagerView.OrderDetails')->with('val',$val);
    }

    //View Contracts

    public function viewContract() //view contract table
    {
        $val=contract::paginate(10);
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
        //return $val;
        return view("ManagerView.ViewContracts")->with('data',$val);
    }

    //Delete contracts

    public function contractDelete($id)
    {

        contract::where("contract_id",$id)->delete();
        return back();
    }

    //view contract info

    public function contractInfo($id)
    {
        $val=contract::where("contract_id",$id)->first();
        return view('ManagerView.ContractDetails')->with('val',$val);
    }

    //View supply

    public function viewSupply() //view supply table
    {
        $val=supply::paginate(10);
        return view("ManagerView.ViewSupply")->with('data',$val);
    }

    //view supply info

    public function supplyInfo($id)
    {
        $val=supply::where("supply_id",$id)->first();
        return view('ManagerView.SupplyDetails')->with('val',$val);
    }

    //view supply order

    public function supplyOrder()
    {
        $val=supply::paginate(10);
        return view('ManagerView.SupplyOrder')->with('val',$val);
    }

    //Add to cart

    public function addCart(Request $req)
    {
        $this->validate($req,
        [
            'amount' => 'gt:0'
        ],
        [
            'amount.gt' => 'Quantity must be atleast 1'
        ]);
        if($req->add=="Add to Cart")
        {
            $val=supply::where("supply_id",$req->id)->first();
            if($req->amount>$val->stock) //stock check
            {
                session()->flash('message','Sorry, we are currently low on stock!');
                return back();
            }
            $stock=$val->stock;
            $amount=$req->amount;
            $new=$stock-$amount;
            session()->put('newStock',$new);

            supply::where('supply_id',$req->id)  //stock update
            ->update(
                ['stock'=>$new]
            );

            $unit=$val->price_perUnit;
            $total=$unit*$amount;

            $dat=supply_cart::all();
            for ($i=0; $i < count($dat); $i++) //checking if item already added
            { 
                if($val->med_id==$dat[$i]->med_id)
                {
                    supply_cart::where('med_id',$val->med_id)
                    ->update(
                        ['quantity'=>$req->amount+$dat[$i]->quantity,
                        'total_price'=>$total+$dat[$i]->total_price]
                    );
                    return back();
                }
            }

            $item = new supply_cart();
            // return $val->name;
            $item->med_name=$val->med_name;
            $item->med_id=$val->med_id;
            $item->vendor_id=$val->vendor_id;
            $item->price_perUnit=$val->price_perUnit;
            $item->quantity=$req->amount;
            $item->total_price=$total;
            $item->save();
            // supply::where('supply_id',$req->id)
            // ->update(
            //     ['stock'=>$new]
            // );
            return back();
        }
        elseif($req->add=="View Items")
        {
            return redirect()->route("manager.tableSupplyCart");
        }
    }

    //view supply cart

    public function viewSupplyCart()
    {
        $dat=supply_cart::all();
        $tot=0;
        foreach($dat as $d)
        {
            $tot+=$d->total_price;
        }
        //$price=$dat->total_price;
        $val=supply_cart::paginate(10);
        return view("ManagerView.ViewSupplyCart")->with("data",$val)->with("total",$tot);
    }

    //Remove from cart

    public function removeCart($id)
    {
        $val=supply_cart::where('cart_id',$id)->first();
        $val2=supply::where('med_id',$val->med_id)->first();
        $quantity=$val->quantity+$val2->stock;
        supply::where('med_id',$val->med_id)
            ->update(
                ['stock'=>$quantity]
            );
        //     return back();
        supply_cart::where("cart_id",$id)->delete();

        return back();
    }

    //Confirm Order

    public function confirm(Request $req)
    {
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
            $item->manager_id=session()->get('manager_id');
            $item->med_name=$val->med_name;
            $item->quantity=$val->quantity;
            $item->total_price=$val->total_price;
            $item->save();
        }
        // $name=users::where('u_id',session()->get('logged.manager'))->first();

        mail::to('faiyazkhondakar@gmail.com')->send(new SupplyOrder("Suppy Order Placement","Hi",session()->get('logged.manager'),$v));
        supply_cart::truncate();
        return redirect()->route("manager.tableSupplyOrder");
    }

    //View Profile

    public function viewProfile()
    {
        $id=session()->get('logged.manager');
        $val=users::where('u_id',$id)->first();
        $man=manager::where('u_id',$id)->first();
        session()->put('manager.name',$man->manager_name);
        session()->put('manager.id',$man->manager_id);
        session()->put('manager.email',$man->manager_email);
        session()->put('type','MANAGER');
        session()->put('manager.password',$val->u_pass);
        return view("ManagerView.viewProfile")->with("val",$val);
    }
    
    public function editProfile(Request $req)
    {
        return redirect()->route("manager.editPage");
    }

    //Edit Profile
    public function viewEdit()
    {
        return view("ManagerView.editProfile");
    }

    //Confirm Profile

    public function confirmEdit(Request $req)
    {
        // if($req->password==session()->get('manager.password'))
        // {
        //     if($req->newPassword==$req->confirmPassword)
        //     {
        //         users::where('u_id',session()->get('logged.manager'))
        //         ->update(
        //             ['u_pass'=>$req->newPassword]
        //         );
        //     }
        // }
        //$val=session()->get('manager.password');
        $pWord=users::where('u_id',session()->get('logged.manager'))->first();
        if($req->password==null)
        {
            if ($req->hasFile('propics'))
            {
                $img = session()->get('logged.manager').".jpg";
                $req->file('propics')->storeAs('public/propics',$img);
                if($req->pass==null )
                
                manager::where('manager_id',session()->get('manager.id'))
                            ->update(
                                ['image'=>$img],
                            );
            }
            else
            {
                session()->flash('ms','Nothing to update!');
                return back();
            }
            return redirect()->route('manager.profile');
        }
        //return session()->get('logged.manager');
        //return $pWord;
        else if($req->password!=$pWord->u_pass)
        {
            session()->flash('ms','Current Password does not match!');
            return back();
        }
        $this->validate($req,
        [
            'newPassword' => "required|min:8|regex:/^.*(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$ %^&*~><.,:;]).*$/i",
            'confirmPassword' => "required|same:newPassword"
        ],
        [
            'newPassword.required' => "Please enter new password!",
            'confirmPassword.required' => "Please confirm new password!",
            'confirmPassword.same' => "The new password does not match!"
        ]);

        if ($req->hasFile('propics'))
        {
            $img = session()->get('logged.manager').".jpg";
            $req->file('propics')->storeAs('public/propics',$img);
            //if($req->pass==null )
            
            manager::where('manager_id',session()->get('manager.id'))
                        ->update(
                            ['image'=>$img],
                            ['u_pass'=>$req->newPassword]
                        );
        }
        else
        {
            users::where('u_id',session()->get('logged.manager'))
            ->update(
                ['u_pass'=>$req->newPassword]
            );
        }
        return redirect()->route('manager.profile');
    }

    //view query table

    public function viewQuery()
    {
        $val=orders_cart::paginate(10);
        return view("ManagerView.ViewQuery")->with('data',$val);
    }

    //accept query

    public function queryAcc($id)
    {
        $quan=orders_cart::where('id',$id)->first();
        $med=medicine::where('med_id',$quan->med_id)->first();
        $stock=$quan->quantity+$med->Stock;
        orders_cart::where('id',$id)
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
        return back();
    }

    //reject query

    public function queryDec($id)
    {
        orders_cart::where('id',$id)
        ->update(['return_status'=>'declined']);
        return back();
    }

    //search user

    public function searchUser()
    {
        $val=users::where('u_id',session()->get('searchID'))->paginate(5);
        return view("ManagerView.ViewTable")->with('Val',$val);
    }

    //search medicine

    public function searchMedicine()
    {
        $val=medicine::where('med_id',session()->get('searchID'))->paginate(5);
        return view("ManagerView.ViewMed")->with('data',$val);
    }

    //search contract

    public function searchContract()
    {
        $val=contract::where('contract_id',session()->get('searchID'))->paginate(5);
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
        return view("ManagerView.ViewContracts")->with('data',$val);
    }
    
    //search order

    public function searchOrder()
    {
        $val=order::where('order_id',session()->get('searchID'))->paginate(5);
        return view("ManagerView.ViewOrders")->with('data',$val);
    }
    
    //search supply

    public function searchSupply()
    {
        $val=supply::where('supply_id',session()->get('searchID'))->paginate(5);
        return view("ManagerView.ViewSupply")->with('data',$val);
    }

    //view account table

    public function viewAccount()
    {
        $val=account::paginate(10);
        return view("ManagerView.ViewAcc")->with('data',$val);
    }

}
