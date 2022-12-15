import { useEffect, useState } from "react"
import Logout from "../AllUserComponents/Logout"
import axiosConfig from "./../AllUserComponents/axiosConfig"
import CustomerTopBar from "./CustomerTopBar"

const CustomerProfile=()=>{
    const [user,setUser] =useState([]);
    useEffect(()=>{
        axiosConfig.post("customer/account").then
        ((rsp)=>{
            setUser(rsp.data);
            debugger;
        },(err)=>{

        })
    },[])
    return(
        <div>
            <Logout/>
            <br/>
            <h3><CustomerTopBar/></h3>
                <div>
                    <button onClick={(e)=>{window.location.href=`/set/password/customer/${user.customer_email}`;}}>CHANGE PASSWORD</button>

                    <center>
                        <div>
                        <fieldset style={{width:"50%"}}>
                            <legend style={{textAlign:"center"}}><b>PROFILE INFORMATION</b></legend>
                            <img width="200" height="250" src={`http://localhost:8000/storage/profilepictures/${user.u_id}.jpg`}/> 
                            <br/><br/>
                            <h4>
                                USER ID : {user.u_id} <br/>
                                Customer ID : {user.customer_id} <br/>
                                Email : {user.customer_email} <br/>
                                Name : {user.customer_name}<br/><br/>
                            </h4>
                        </fieldset>
                        </div>
                        <br/>
                        <button onClick={(e)=>{window.location.href="/customer/profile/update"}}>Update Information</button>
                    </center>    
                </div>
                <br/>
        </div>
    )
}

export default CustomerProfile