import LoggedCourierTop from "./LoggedCourierTop";
import axiosConfig from "./../AllUserComponents/axiosConfig"
import { useEffect, useState } from "react";
import "../index.css"

const AcceptedOrders=()=>{
    const [orders,setOrders]=useState([]);
    const [errs,setErrs] = useState({});
    const [id,setId] = useState("");
    useEffect(()=>{
        axiosConfig.get("courier/acceptedOrders").then((rsp)=>{
            setOrders(rsp.data);   
        },(err)=>{})
    },[]);


    const deliveredOrder=(event)=>{
        event.preventDefault();
        //const data={med_id:med_id,item_id:item_id};
        debugger;
        axiosConfig.get(`/courier/deliveredOrder/${id}`).then(
            (succ)=>{
                debugger;
                window.location.href="/courier/ViewOrders";

            },(err)=>{
                debugger;

            }

        )
    }

    return(
<div>
            <h3><LoggedCourierTop/></h3>
            <span><br/><br/>{
            errs.msg
            ?   <h3>{errs.msg}</h3>
            :   <div>
                <table border="1">
                    <tr>
                        <th>Order Id</th>
                        <th>Cart Id</th>
                        <th>Customer Id</th>
                        <th>Order Status</th>
                        <th>Delivery Time</th>
                        <th>Accept</th>
                    </tr>
                    {
                        orders.map((order)=>
                        <tr key={order.order_id}>
                        <td>{ order.cart_id }</td>
                        <td>{ order.customer_id }</td>
                        <td>{ order.totalbill }</td>
                        <td> { order.order_status } </td>
                        <td>{ order.delivery_time }</td>
                        <td>
                        {
                                order.order_status=="accepted" && 
                                <form onSubmit={deliveredOrder}>
                                    <input type="submit" onClick={(e)=>{setId(order.order_id)}} name="Deliver" value="Deliver"/>
                                </form>
                        }
                        </td>
                        </tr>
                        )
                    }

                        
                </table>
                <br/>
                <br/>
                </div>
                }
            </span><br/>
            <br/>

        </div>
    )
}


export default AcceptedOrders;