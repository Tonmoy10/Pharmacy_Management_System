import axiosConfig from './../AllUserComponents/axiosConfig';

import { useEffect, useState } from "react";
import CustomerTopBar from "./CustomerTopBar";
import Logout from "../AllUserComponents/Logout";

const CustomerProfileUp=()=>{
    const [name,setName] = useState("")
    const [user,setUser] =useState([]);

    useEffect(()=>{
        axiosConfig.post("customer/account").then
        ((rsp)=>{
            setUser(rsp.data);
            setName(rsp.data.customer_name);
            debugger;
        },(err)=>{

        })
    },[])

    const updateInfo=(event)=>{
        event.preventDefault();
        const data={name:name};

        axiosConfig.post("customer/modify/account",data).
        then((rsp)=>{
            console.log(rsp);
            debugger
        },(err)=>{
            debugger
        })
    }
    return(
        <div>
            <Logout/>
            <br/>
            <h3><CustomerTopBar/></h3>
            <center>
            <form onSubmit={updateInfo}>
                <fieldset style={{width:"50%"}}>
                <legend style={{textAlign:"center"}}><b>PROFILE INFORMATION</b></legend>
                        <center>
                        USER ID : <input type="text" name="u_id" value={user.u_id} readOnly/> <br/> <br/>
                        Customer ID : <input type="text" name="c_id" value={user.customer_id} readOnly/> <br/> <br/>
                        Email : <input type="text" name="email" size={30} value={user.customer_email} readOnly/> <br/><br/>
                        Name: <input type="text" onChange={(e)=>{setName(e.target.value)}} name="name" value={name}/><br/><br/>
                        </center>
                </fieldset>
                <br/>
            <input type="submit" name="submit" value="Update Information"/>
            </form>
            
            </center>

        </div>
    )
}

export default CustomerProfileUp;