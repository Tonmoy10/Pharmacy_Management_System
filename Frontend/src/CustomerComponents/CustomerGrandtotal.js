import { useEffect, useState } from "react";
import axiosConfig from "./../AllUserComponents/axiosConfig"


const CustomerGrandtotal=()=>{
    const [grandtotal,setGrandtotal]=useState([]);
    useEffect(()=>{
        axiosConfig.get("customer/grandtotal").then
        ((rsp)=>{
            setGrandtotal(rsp.data.total);
            debugger
        },(err)=>{
            debugger
        }
        )

    },[])
    return(
        <div>
            GrandTotal : ${grandtotal} + $15 (delivery charge)
        </div>
    )
}

export default CustomerGrandtotal;