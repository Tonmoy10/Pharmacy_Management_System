import { useEffect, useState } from "react";
import CustomerTopBar from "./CustomerTopBar";
import axiosConfig from "./../AllUserComponents/axiosConfig"
import Logout from "../AllUserComponents/Logout";

const CustomerOrders = () => {
    const [errs,setErrs] = useState({});
    const [orders,setOrder] = useState([]);
    const [ViewItem,setViewItem] = useState(false);
    const [order_id,setOrder_id] = useState();
    const [items,setItems] = useState([]);
    useEffect(()=>{
        axiosConfig.post("customer/orders").then
        ((rsp)=>{
            setOrder(rsp.data);
            debugger;
        },(err)=>{
            console.log("NO ORDERS HAS BEEN PLACED");
            setErrs(err.response.data);
            debugger;
        }
        )
    },[])
    const view=(event)=>{ 
        event.preventDefault();
        axiosConfig.get(`customer/${order_id}`).then
        ((succ)=>{
            setItems(succ.data);
            setViewItem(true);
            debugger;
        },(error)=>{
            debugger;
        })
    }
    const cancel=(event)=>{ 
        debugger
        event.preventDefault();
        axiosConfig.get(`customer/order/cancel/${order_id}`).then
        ((response)=>{
            window.location.href="/customer/orders";
            debugger;
        },(errors)=>{
            debugger;
        })
    }
    return (
        <div>
            <Logout/>
            <br/>
            <h3><CustomerTopBar/></h3>
            <h3>ORDERS</h3>
            <span><br/><br/>{
            errs.msg
            ?   <h3>{errs.msg}</h3>
            :   <div>
                    <table border="1">
                    <tr>
                        <th></th>
                        <th>Order ID</th>
                        <th>ORDER STATUS</th>
                        <th>BILL(D.C inclusive)</th>
                        <th>ACCEPTED TIME</th>
                        <th>DELIVERY TIME</th>
                        <th>ITEMS</th>
                    </tr>
                    {
                        orders.map((order)=>
                        <tr key={order.order_id}>
                            {
                                order.order_status=='pending' 
                                ?<td>
                                    {
                                        <form onSubmit={cancel}>
                                            <input type="submit" onClick={(e)=>{setOrder_id(order.order_id)}} value="CANCEL"/>
                                         </form>
                                    }
                                </td>
                                :<td></td>
                            }
                            <td>{order.order_id}</td>
                            <td>{order.order_status}</td>
                            <td>{order.totalbill}</td>
                            <td>{order.accepted_time}</td>
                            <td>{order.delivery_time}</td>
                            <td>
                                {
                                    <form onSubmit={view}>
                                        <input type="submit" onClick={(e)=>{setOrder_id(order.order_id)}} value="View Items"/>
                                    </form>                              
                                }
                               
                            </td>
                        </tr>
                        )
                    }
                  
                    </table>
                    </div>
            }</span>
            <br/><br/>
            <div>
            {
                ViewItem
                ?   <div>
                        <fieldset style={{width:"10%"}}>
                            <b>ORDER ID : {order_id} </b><br/>
                            {
                                items.map((item)=>
                                <l key={item.med_id}>
                                    {item.items}&nbsp;{item.quantity}pc <br/>
                                </l>
                                )
                            }
                        </fieldset>
                    </div>
                : ""
            }  
            </div>
            <br/><br/>
        </div>
    )
}

export default CustomerOrders;