import { useParams } from 'react-router-dom'
import React,{useState,useEffect} from 'react'
import axiosConfig from "./../AllUserComponents/axiosConfig"
import ManagerHome from "./../ManagerComponents/ManagerHome"

function ViewCart(){
    const [val,getVal]=useState([])
    const [id,setId]=useState('')


    useEffect(()=>{
        axiosConfig.get("manager/cart/table")
        .then((res) =>{
            // debugger
            getVal(res.data);
        },
        (err) =>{
            debugger;
            console.log(err);
        })

    },[])

    const placeOrder=(event)=>{
        debugger;
        axiosConfig.post("manager/confirm").then
        ((rsp)=>{
            debugger;
            window.location.href="/manager/home";
        },(err)=>{

        })
    }

    const removeItem=(event)=>{
        event.preventDefault();
        const data={c_id:id};
        debugger;
        axiosConfig.post("manager/remove",data).then(
            (succ)=>{
                debugger;
                window.location.href="/manager/cart/table";

            },(err)=>{
                debugger;
                console.log(err);
            }
        )}

    return(
        <div>
            <ManagerHome/>
            <h3>Cart List</h3>
            <table border="1">
                <tbody>
                <tr>
                    <th>Vendor Id</th>
                    <th>Medicine Id</th>
                    <th>Medicine Name</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
                    {
                        val.map((v) =>
                            <tr key={v.med_id}>
                                <td>{v.vendor_id}</td>
                                <td>{v.med_id}</td>
                                <td>{v.med_name}</td>
                                <td>{v.price_perUnit}</td>
                                <td>{v.quantity}</td>
                                <td>{v.total_price}</td>
                                <td>
                                    {
                                    <form onSubmit={removeItem}>
                                        <input type="submit" onClick={(e)=>{setId(v.cart_id)}} name="delete" value="Remove"/>
                                    </form>
                                    }
                                </td>
                            </tr>
                        )
                    }
                </tbody>
            </table>
            <div>
                <br/><br/>
                <button onClick={placeOrder}> Confirm Order</button>
            </div>   
        </div>
    )
}
export default ViewCart;