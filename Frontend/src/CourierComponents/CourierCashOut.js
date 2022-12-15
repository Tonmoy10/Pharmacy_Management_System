import LoggedCourierTop from "./LoggedCourierTop";
import axiosConfig from "./../AllUserComponents/axiosConfig"
import { useEffect, useState } from "react";
import "../index.css"

const CourierCashOut=()=>{
    const [data,setData]=useState([]);
    const [amount,setAmount]=useState("");
    const [availableAmount,setAvailableAmount]=useState("");
    useEffect(()=>{
        axiosConfig.post("courier/cashoutView").then((rsp)=>{
        setData(rsp.data);
        setAvailableAmount(rsp.data.due_delivery_fee);
        debugger;
        },(err)=>{})
    },[]);
    const cashout=(event)=>{
        event.preventDefault();
        var data ={amount:amount,availableAmount:availableAmount};
        axiosConfig.post("courier/cashout",data).
        then((rsp)=>{
            console.log(rsp);
            window.location.href="/courier/cashout"
        },(err)=>{
            debugger
            // setErrs(err.response.data);
        })
    }
    return(
        <div className="">
            <LoggedCourierTop/>
            <form onSubmit={cashout}>
            Available amout : <input type="text" name="availableAmount" value={availableAmount} readOnly/> <br/> <br/>
            Cashout amount : <input type="text" name="amount" value={amount} onChange={(e)=>{setAmount(e.target.value)}}/> <br/> <br/>
            <input type="submit" value="Cashout"></input>
            </form>          
        </div>
    )
}

export default CourierCashOut;